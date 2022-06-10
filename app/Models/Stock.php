<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    const ARTICLE_TYPES = [
        "1" => "article",
        "2" => "emballage",
        "3" => "groupe d'article",
        "4" => "deconsignation"
    ];

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

    public function scopePreArticlesSum($q)
    {
        $article = $q->where("user_id",auth()->user()->id)->whereNull("invoice_number")->get();

        $articleAndConsignation = $article->filter(function ($article) {
            return $article->article_type != 4;
        })->sum(function ($article) {
            return $article->buying_price * $article->quantity;
        });

        $deconsignation = $article->filter(function ($article) {
            return $article->article_type == 4;
        })->sum(function ($article) {
            return $article->buying_price * $article->quantity;
        });

        return $articleAndConsignation - $deconsignation;
    }

    public function scopePreInvoiceAmount($q)
    {
        return $q->whereNull("invoice_number")->sum($this->quantity * $this->buying_price);
    }

    public function getPreSubAmountAttribute()
    {
        $result = $this->buying_price * $this->quantity;

        return $this->article_type != 4 ? $result : -$result;
    }

    public function stockable()
    {
        return $this->morphTo();
    }

    public function getArticleTypeAttribute($value){
        return self::ARTICLE_TYPES[$value];
    }
}
