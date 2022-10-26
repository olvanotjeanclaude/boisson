<?php

namespace App\helper;

use App\Models\Articles;
use Illuminate\Support\Collection;

class Invoice
{
    const PAYMENT_TYPES = [
        "1" => "Chèque",
        "2" => "espèce",
        "3" => "Mvola",
        "4" => "orange money",
        "5" => "airtel",
    ];

    const STATUS = [
        "paid" => 1,//si reste ==0
        "no_printed" => 2,//no imprimé
        "incomplete" => 3, //si reste >0
        "pending" => 4, //Miandry validation avy @ caisse
        "valid" => 5, //payé et imprimé
        "deleted" => 6, //supprimé
        "modified" => 7, //modifié
        "canceled" => 8, //modifié
    ];

    public static function calculateAmount(Collection $articles)
    {
        $amount = 0;

        if ($articles->count()) {
            $sumArticle = $articles->filter(function ($item) {
                return $item["article_type"] != Articles::ARTICLE_TYPES["deconsignation"];
            })->sum("sub_amount");

            $sumDeconsignation = $articles->filter(function ($item) {
                return $item["article_type"] == Articles::ARTICLE_TYPES["deconsignation"];
            })->sum("sub_amount");

            $amount = $sumArticle - $sumDeconsignation;
        }

        return $amount;
    }
}
