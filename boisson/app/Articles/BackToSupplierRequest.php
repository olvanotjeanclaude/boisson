<?php

namespace App\Articles;

use App\Models\Stock;

class BackToSupplierRequest
{
    public function getData()
    {
        // dd($request->all());
        $request = request();
        $formatRequest = new FormatRequest();
        $articles  = $errorStocks = [];

        $articles = $formatRequest->getArticleAndConsignation(
            $request->article_reference,
            $request->quantity
        );

        $datas = $this->generateInvoiceNumberTo($articles);

        if (count($datas)) {
            $products = $this->getProductRequest($datas);
            $errorStocks = $this->getErrorStocks($products);
        }

        $datas = $this->formatData($datas);
        
        return [
            "datas" => $datas,
            "errorStocks" => $errorStocks,
        ];
    }

    private function generateInvoiceNumberTo(array $datas)
    {
        $datas = array_filter($datas, function ($data) {
            return count($data);
        });

        if (count($datas)) {
            $preInvoices = Stock::BackSupplierPreInvoices();
            $preInvoice = $preInvoices->first();

            if ($preInvoice) {
                $invoiceNumber = $preInvoice->invoice_number;
            } else {
                $invoiceNumber = generateInteger(7);
            }

            return array_map(function ($data) use ($invoiceNumber) {
                $data["invoice_number"] = $invoiceNumber;
                return $data;
            }, $datas);
        }

        return [];
    }

    private function getProductRequest(array $articles)
    {
        $products = collect($articles);

        return $products->groupBy("article_reference")->map(function ($product) {
            $product = collect($product);
            return [
                "article_reference" => $product[0]["article_reference"],
                "sum_quantity" => $product->sum("quantity")
            ];
        });
    }

    private function getErrorStocks($products)
    {
        $errorStocks = [];
      
        foreach ($products as  $product) {
            $checkStock = Stock::CheckStock(
                $product["article_reference"],
                $product["sum_quantity"]
            );
            $errorStocks[] = $checkStock["errors"];
        }

        return array_filter($errorStocks, function ($error) {
            return !is_null($error);
        });
    }

    private function formatData(array $articles=[]){
        $datas = [];
    
        foreach ($articles as  $article) {
            $datas[] = [
                "action_type" => Stock::ACTION_TYPES["out_to_supplier"],
                "article_reference" => $article["article_reference"],
                "stockable_id" => $article["saleable_id"],
                "stockable_type" => $article["saleable_type"],
                "out" => $article["quantity"],
                "user_id" => auth()->user()->id,
                "date" => now()->toDateString(),
                "status" => Stock::STATUS["pending"],
                "supplier_id" => request()->supplier_id,
                "invoice_number" =>$article["invoice_number"]
            ];
        }

        return $datas;
    }

    public function saveToStock(array $datas){
        if (count($datas)) {
            foreach ($datas as  $data) {
                Stock::create($data);
            }
        }

    }
}
