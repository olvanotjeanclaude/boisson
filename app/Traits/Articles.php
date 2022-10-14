<?php

namespace App\Traits;

use App\helper\Invoice;
use App\Models\Package;
use App\Models\Product;
use App\Models\Emballage;
use App\Models\Stock;
use App\Models\User;

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
        return $q->where("user_id", auth()->user()->id)
            ->where("status", false)
            ->orderBy("saleable_type", "desc");
    }

    public function getArticleTypeAttribute($value)
    {
        return Stock::ARTICLE_TYPES[$value] ?? 0;
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
        return self::getStatusHtml($this->status);
    }

    public static function getStatusHtml($status){
        switch ($status) {
            case Invoice::STATUS["paid"]:
                $html = '<span class="badge badge-success">Payé</span>';
                break;
            case Invoice::STATUS["no_printed"]:
                $html = '<span class="badge badge-warning">En cours</span>';
                break;
            case Invoice::STATUS["incomplete"]:
                $html = '<span class="badge badge-info">Incomplet</span>';
                break;
            case Invoice::STATUS["pending"]:
                $html = '<span class="badge badge-primary">En attente</span>';
                break;
            case Invoice::STATUS["deleted"]:
                $html = '<span class="badge badge-danger">Supprimer</span>';
                break;
            case Invoice::STATUS["canceled"]:
                $html = '<span class="badge badge-danger">Annulé</span>';
                break;
            default:
                $html = '<span class="badge badge-dark">Inconnu</span>';
                break;
        }

        return $html;
    }

    public function getInvoiceStatusAttribute()
    {
        return array_search($this->status, Invoice::STATUS);
    }

    public static function search($query,$relation, $keyword)
    {
        return $query->whereHasMorph(
            $relation,
            [Product::class, Emballage::class],
            function ($query) use ($keyword) {
                return $query->where("designation", "LIKE", "%$keyword%")
                ->orWhere("reference","LIKE","%$keyword%");
            }
        );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
