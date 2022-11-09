<?php

namespace App\helper;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Emballage;
use App\Models\DocumentVente;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class Dashboard
{
    public function getRecaps($between, $filterType = "all")
    {
        $solds =  $this->getSolds($between, $filterType);
        $articles = $solds->where("saleable_type", "App\Models\Product");
        $consignations = $solds->where("saleable_type", "App\Models\Emballage")
            ->where("isWithEmballage", false);
        $deconsignations = $solds->where("saleable_type", "App\Models\Emballage")
            ->where("isWithEmballage", true);

        // dd($solds);
        if($filterType=="wholesale"){
        }
        else if($filterType=="detail"){
        }

        $wholesale= $solds->sum("quantity");
        $wholesaleOrDetail = $solds->sum("quantity");

        return  [
            "Article" => $articles->sum("quantity"),
            "Consignation" => $consignations->sum("quantity"),
            "Avoir" => $deconsignations->sum("quantity"),
            // "En Gros" => $wholesale->sum("quantity"),
            // "En Detail" => $details->sum("quantity"),
        ];
    }

    public function getPaymentTypes($payments)
    {
        $paymentTypes = [];
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
        $sales = Sale::whereHasMorph(
            'saleable',
            [Product::class, Emballage::class],
            function ($query) {
                $search = strtolower(request()->get("chercher"));
                $query->where('designation', 'like', "%$search%")
                    ->orWhere('reference', 'like', "%$search%");
            }
        )
            ->where(fn ($query) => Filter::queryBetween($query, $between))
            ->where(function ($query) use ($articleType) {
                switch ($articleType) {
                    case 'article':
                        $query = $query->where("saleable_type", "App\Models\Product");
                        break;
                    case 'consignation':
                        $query = $query->where("saleable_type", "App\Models\Emballage")
                            ->where("isWithEmballage", false);
                        break;
                    case 'deconsignation':
                        $query = $query->where("saleable_type", "App\Models\Emballage")
                            ->where("isWithEmballage", true);
                        break;
                    default:
                        # code...
                        break;
                }
            })
            ->orderBy("received_at", "desc")
            ->get();

        switch ($articleType) {
            case 'wholesale':
                $sales = $this->getWholesale($sales);
                break;
            case 'detail':
                $sales = $this->getDetailSale($sales);
                break;
        }
        // DD($sales);
        $sales = $sales->groupBy("article_reference");

        $sales = $sales->map(function ($sale) {
            $article = $sale[0]->saleable;

            return (object)[
                "designation" => $article->designation,
                "pricing" => $sale[0]->pricing,
                "received_at" => $sale[0]->received_at,
                "quantity" => $sale->sum("quantity"),
                "sub_amount" => $sale->sum("amount"),
                "saleable" => (object)$article->toArray(),
                "saleable_type" => get_class($article)
            ];
        });

        return in_array($articleType, array_keys(Filter::TYPES)) ? $sales : collect([]);
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

    private function getWholesale($sales)
    {
        return $sales->where("saleable_type", "App\Models\Product")
            ->filter(function ($sale) {
                $article = $sale->saleable;
                $divider = $article?->contenance ?? $article?->condition;
                // dd($divider,$sale);
                return $article && $sale->quantity >= $divider;
            });
    }

    private function getDetailSale($sales)
    {
        return $sales->where("saleable_type", "App\Models\Product")
            ->filter(function ($sale) {
                $article = $sale->saleable;
                $divider = $article?->contenance ?? $article?->condition;

                return $article && $sale->quantity < $divider;
            });
    }
}
