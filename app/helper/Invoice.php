<?php

namespace App\helper;

use App\Models\Articles;
use Illuminate\Support\Collection;

class Invoice{
    const PAYMENT_TYPES = [
        "1" => "Chèque",
        "2" => "espèce",
        "3" => "Mvola",
        "4" => "orange money",
        "5" => "airtel",
    ];

    const STATUS = [
        "printed" => 1,
        "no_printed" => 2,
        "deleted" => 3,
        "modified" => 4,
        "valid" => 5,
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