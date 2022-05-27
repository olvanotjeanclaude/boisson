<?php

namespace App\Pricing;

use App\Models\Articles;
use Illuminate\Support\Collection;

class Pricing
{
    private $amount=0;
    private $items;

    public function init(Collection $items)
    {
        $this->items = $items->map(function ($items) {
            if ($items["quantity_bottle"]) {
                $items["sub_amount"] = $items["quantity_bottle"] * $items["unit_price"];
            } else {    
                $items["sub_amount"] = $items["quantity_type_value"] * $items["unit_price"];
            }
            return $items;
        }, $items);

        $this->amount = $this->calculateAmount();

        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

    private function calculateAmount()
    {
        $result = 0;

        if ($this->items->count()) {
            $sumArticle = $this->items->filter(function ($item) {
                return $item["article_type"] != Articles::ARTICLE_TYPES["deconsignation"];
            })->sum("sub_amount");

            $sumDeconsignation = $this->items->filter(function ($item) {
                return $item["article_type"] == Articles::ARTICLE_TYPES["deconsignation"];
            })->sum("sub_amount");

            $result = $sumArticle - $sumDeconsignation;
        }

        return $result;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public  function getAmount()
    {
        return $this->amount;
    }

    public function formatPrice()
    {
        return  number_format($this->amount, 2, ',', ' ') . " Ariary";
    }

    public function priceToAriary()
    {
        return  number_format($this->amount * 5, 2, ',', ' ') . " Ariary";
    }
}
