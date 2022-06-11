<?php

namespace App\Traits;

use App\Models\Package;
use App\Models\Product;
use App\Models\Emballage;
use App\Models\Stock;

trait Articles
{
    public static function getArticleByReference($reference)
    {
        $articleDigit = strlen($reference);

        switch ($articleDigit) {
            case '6':
                $article = Product::orderBy("designation")->where("reference", $reference)->first();
                break;
            case '5':
                $article = Emballage::orderBy("designation")->where("reference", $reference)->first();
                break;
            case '4':
                $article = Package::orderBy("designation")->where("reference", $reference)->first();
                break;
            default:
                $article = null;
                break;
        }

        return $article;
    }

    public function scopePreInvoices($q)
    {
        return $q->where("user_id",auth()->user()->id)->whereNull("invoice_number");
    }

    public function getArticleTypeAttribute($value){
        return Stock::ARTICLE_TYPES[$value];
    }
}
