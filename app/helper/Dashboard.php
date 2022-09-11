<?php

namespace App\helper;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Emballage;
use App\Models\DocumentVente;
use Illuminate\Support\Facades\DB;

class Dashboard
{
    public function getSaleDetail($between)
    {
        return DB::table("sales")->select([
            "invoice_number", "article_reference", "saleable_id", "saleable_type", "received_at",
            DB::raw("SUM(sales.quantity) as sum_quantity")
        ])
            ->where("saleable_type", "App\Models\Product")
            ->where(fn ($query) => Filter::queryBetween($query, $between))
            ->groupBy("sales.invoice_number");
    }

    public function getSaleAndPaymentDetails($between)
    {
        return DB::table("document_ventes")
            ->rightJoinSub($this->getSaleDetail($between), "sales", function ($join) {
                $join->on("document_ventes.number", "sales.invoice_number");
            })
            ->select([
                "sales.article_reference",  "sales.saleable_id", "sales.saleable_type",
                "sales.received_at",
                "sales.sum_quantity",
                "document_ventes.payment_type as payment_type",
                DB::raw("SUM(document_ventes.paid) as sum_paid"),
                DB::raw("SUM(document_ventes.checkout) as sum_checkout"),
            ])
            ->where(fn ($query) => Filter::queryBetween($query, $between, "document_ventes.received_at"))
            // ->whereBetween("document_ventes.received_at", $between)
            ->whereNotNull("document_ventes.payment_type")
            ->groupBy("sales.article_reference", "document_ventes.received_at")
            ->get();
    }

    public function getRecaps($between)
    {
        $sales =  Sale::whereBetween("received_at", $between);

        return  [
            "Vendu" => Sale::withSumQuantity($between)->sum("sum_sale"),
            "Consignation" => $sales->bottles("consignation")->sum("quantity"),
            "Deconsignation" => $sales->bottles("deconsignation")->sum("quantity"),
        ];
    }

    public function mapSalePayment($sale)
    {
        $article = DocumentVente::getArticleByReference($sale->article_reference);

        if ($article) {
            $sale->designation = $article->designation;
            $sale->payment_name = DocumentVente::PAYMENT_TYPES[$sale->payment_type] ?? "-";
        }

        return $sale;
    }

    public function getPaymentTypes($payments)
    {
        $paymentTypes = [];
        foreach (DocumentVente::PAYMENT_TYPES as $key => $name) {
            if (isset($payments[$key])) {
                $payment = $payments[$key];
                $price = $payment->sum("sum_paid");
                $paymentTypes[$name] = formatPrice($price);
            }
        }

        return $paymentTypes;
    }

    public function getSolds($between)
    {
        $sales = Sale::with("saleable")
            ->whereHasMorph('saleable', [Product::class, Emballage::class])
            ->whereBetween("received_at", $between)
            ->orderBy("saleable_type")
            ->get();
        // ->groupBy(fn($sale) =>$sale->article_reference);
        // ->map(function($sale,$article_ref){
        //     dd($sale);
        //     return (object)[
        //         "article_reference" =>$sale->article_reference,
        //         "saleable_type" =>$sale->saleable_type,
        //         "saleable_id" =>$sale->saleable_id,
        //         "designation" =>$sale->designation,
        //         "sum_quantity" =>$sale->sum("quantity"),
        //     ];
        // });

        return $sales;
        dd($sales);
    }

    public function getRecettes($sales, $between)
    {
        $solds = $this->getSolds($between);
        return  [
            "sum_amount" => $solds->sum("sub_amount"),
            "sum_paid" => $sales->sum("paid"),
            "sum_checkout" => $sales->sum("checkout"),
            "sum_caisse" => $sales->sum("paid") - $sales->sum("checkout")
        ];
    }
}
