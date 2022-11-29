<?php

namespace App\Articles;

use App\Models\Articles;

class Pricing
{
    public function formatPrice()
    {
        return  number_format($this->amount, 2, ',', ' ') . " Ariary";
    }

    public function priceToAriary()
    {
        return  number_format($this->amount * 5, 2, ',', ' ') . " Ariary";
    }

    public static function getPrice($article, $quantity)
    {
        $price = $article->price;

        $articleType = $article ? get_class($article) : null;

        $unity = Articles::UNITS[$article->unity] ?? "";

        if ($articleType == "App\Models\Product") {
            $divider = $article->contenance ?? $article->condition ?? null;

            if ($quantity >= $divider) {
                $price = $article->wholesale_price;
            }
        }

        return getNumberDecimal($price);
    }
}