<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory, Articles;

    protected $guarded = [];

    const ARTICLE_TYPES = [
        "1" => "en détail",
        "2" => "emballage",
        "3" => "en gros",
        "4" => "deconsignation",
    ];

    const TYPES = [
        "1" => "article",
        "2" => "consignation",
        "3" => "deconsignation",
        "4" => "sans consignation"
    ];

    public function scopePreArticlesSum($q)
    {
        $article = $q->where("user_id", auth()->user()->id)->whereNull("invoice_number")->get();

        $articleAndConsignation = $article->filter(function ($article) {
            return $article->article_type != "deconsignation";
        })->sum(function ($article) {
            return $article->buying_price * $article->quantity;
        });

        $deconsignation = $article->filter(function ($article) {
            return $article->article_type == "deconsignation";
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
}
