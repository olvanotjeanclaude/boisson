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
        $articles = $solds->where("saleable_type", "App\Models\Product");
        $consignations = $solds->where("saleable_type", "App\Models\Emballage")
            ->where("isWithEmballage", false);;
        $deconsignations = $solds->where("saleable_type", "App\Models\Emballage")
            ->where("isWithEmballage", true);
        //    dd($consignations->toArray(),$deconsignations->toArray());
        return  [
            "Article" => $articles->sum("quantity"),
            "Consignation" => $consignations->sum("quantity"),
            "Deconsignation" => $deconsignations->sum("quantity"),
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
            ->orderBy("saleable_type")
            ->get();

        return in_array($articleType, Filter::TYPES) ? $sales : collect([]);
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
