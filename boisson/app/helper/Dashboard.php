<?php

namespace App\helper;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Emballage;
use App\Models\DocumentVente;

class Dashboard
{
    public function getRecaps($between, $filterType = "all")
    {
        $solds =  $this->getSolds($between, $filterType);
        $articles = Filter::querySales($solds, "article");
        $consignations = Filter::querySales($solds, "consignation");
        $deconsignations = Filter::querySales($solds, "deconsignation");
        $wholesale = $this->getSolds($between, "wholesale");
        $details = $this->getSolds($between, "detail");
        $reqFilterType = request()->get("filter_type");

        $datas =  [
            "article" => $articles->sum("quantity"),
            "consignation" => $consignations->sum("quantity"),
            "avoir" => $deconsignations->sum("quantity"),
            "en gros" => $wholesale->sum("quantity"),
            "en detail" => $details->sum("quantity"),
        ];
        
        if (in_array($reqFilterType, array_keys(Filter::TYPES))) {
            switch ($reqFilterType) {
                case 'article':
                    $datas =  ["article" => $datas["article"]];
                    break;
                case 'consignation':
                    $datas =  ["consignation" => $datas["consignation"]];
                    break;
                case 'deconsignation':
                    $datas =  ["avoir" => $datas["avoir"]];
                    break;
                case 'wholesale':
                    $datas =  ["en gros" => $datas["en gros"]];
                    break;
                case 'detail':
                    $datas =  ["en detail" => $datas["en detail"]];
                    break;
            }
        }

        return $datas;
    }

    public function getPaymentTypes(): array
    {
        $startDate = request()->get("start_date") ?? date("Y-m-d");
        $endDate = request()->get("end_date") ?? date("Y-m-d");
        $between = [$startDate, $endDate];
        $paymentTypes = [];

        $docVente = $this->getDocVente($between);
        $payments = $docVente->get()->groupBy("payment_type");

        foreach (DocumentVente::PAYMENT_TYPES as $key => $name) {
            if (isset($payments[$key])) {
                $payment = $payments[$key];
                $paymentTypes[$name] = [
                    "paid" =>  $payment->sum("paid"),
                    "checkout" => $payment->sum("checkout")
                ];
            }
        }

        return $paymentTypes;
    }

    public function getSolds($between, $articleType = "all")
    {
        $responses = [];

        $sales = Sale::GetSolds($between, $articleType);
        $sales = $sales->groupBy("article_reference");

        $sales = $sales->map(function ($sale) {
            $datas = [];
            $article = $sale[0]->saleable;
            $articles = Filter::querySales($sale, "article");
            $consis = Filter::querySales($sale, "consignation");
            $decos = Filter::querySales($sale, "deconsignation");

            if (count($articles)) {
                $datas[] = $this->formatSale($article, $articles);
            }

            if (count($consis)) {
                $datas[] = $this->formatSale($article, $consis);
            }

            if (count($decos)) {
                $datas[] = $this->formatSale($article, $decos);
            }

            return $datas;
        });

        foreach ($sales as  $values) {
            foreach ($values as  $sale) {
                $responses[] = (object)$sale;
            }
        }

        return in_array($articleType, array_keys(Filter::TYPES)) ? collect($responses) : collect([]);
    }

    private function formatSale($article, $sales)
    {
        $sale = $sales->first();

        return [
            "designation" => $article->designation,
            "pricing" => $sale->pricing,
            "received_at" => $sale->received_at,
            "quantity" => $sales->sum("quantity"),
            "sub_amount" => $sales->sum("amount"),
            "saleable" => (object)$article->toArray(),
            "saleable_type" => get_class($article),
            "isWithEmballage" => $sale->isWithEmballage
        ];
    }

    public function getRecettes($solds, $docVente, $between = [])
    {
        // $docVente = $docVente->get();
        $sum_amount = $solds->sum("sub_amount");
        $sum_paid = $docVente->sum("paid");
        $sum_checkout = $docVente->sum("checkout");
        $all = Sale::whereHasMorph(
            'saleable',
            [Product::class, Emballage::class],
        )
            ->where(fn ($query) => Filter::queryBetween($query, $between))
            ->get();
        return  [
            "sum_amount" => $sum_amount,
            "sum_paid" => $sum_paid,
            "sum_checkout" => $sum_checkout,
            "sum_caisse" => $sum_paid - $sum_checkout,
            "sum_rest" => $all->sum("sub_amount") - $sum_paid + $sum_checkout
        ];
    }

    public function getDocVente($between)
    {
        return DocumentVente::where(fn ($query) => Filter::queryBetween($query, $between));
    }
}
