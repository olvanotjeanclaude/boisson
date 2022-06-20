<?php

namespace App\Traits;

use App\helper\Invoice;
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
        return $q->where("user_id", auth()->user()->id)->whereNull("invoice_number");
    }

    public function getArticleTypeAttribute($value)
    {
        return Stock::ARTICLE_TYPES[$value]??0;
    }

    public function getTypeAttribute()
    {
        return array_search($this->article_type, Stock::ARTICLE_TYPES);
    }

    public function getSignAttribute()
    {
        return $this->article_type == "deconsignation" ? "-" : "+";
    }

    public function getStatusHtmlAttribute()
    {
        switch ($this->status) {
            case Invoice::STATUS["printed"]:
                $html = '<span class="badge badge-success">Imprimé</span>';
                break;
            case Invoice::STATUS["no_printed"]:
                $html = '<span class="badge badge-warning">Non Imprimée</span>';
                break;
            case Invoice::STATUS["deleted"]:
                $html = '<span class="badge badge-danger">Supprimer</span>';
                break;
            default:
                $html = '<span class="badge badge-dark">Inconnu</span>';
                break;
        }

        return $html;
    }
}
