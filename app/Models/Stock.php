<?php

namespace App\Models;

use App\helper\Invoice;
use App\Traits\Articles;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getFinalAttribute()
    {
        return $this->initial + $this->entry - $this->out;
    }

    public function getAmountAttribute()
    {
        return $this->final * $this->stockable->price;
    }


    public static function getDefaultBetween()
    {
        return [self::MinDate(), now()->toDateString()];
    }

    public static function MinDate($date = null)
    {
        if (is_null($date)) {
            $date = date("Y-m-d");
        }

        $date = new Carbon($date);
        $setting = Settings::first();
        $n = is_null($setting) ? 7 : $setting->min_stock_day;

        return $date->subDays($n)->toDateString();
    }

    public function scopeBetween($query, $between = [])
    {
        if (empty($between)) {
            $between = self::getDefaultBetween();
        } else if ($between[0] == $between[1]) {
            $between = [self::MinDate($between[0]), $between[0]];
        }

        $sales = DB::table('document_ventes')
            ->select([
                "document_ventes.status as status",
                "document_ventes.number as invoice_number",
                "sales.saleable_id as article_id",
                "sales.saleable_type as article_type",
                "sales.article_reference as article_ref",
                DB::raw("SUM(sales.quantity) AS sum_out"),
            ])
            ->join("sales", function ($join) use ($between) {
                $join->on("sales.invoice_number", "document_ventes.number")
                    ->whereBetween("sales.received_at", $between);
            })
            ->groupBy("sales.article_reference");
            
        $stocks = DB::table("stocks")
            ->whereBetween("date", $between)
            ->select([
                "stocks.article_reference as article_ref",
                "stocks.stockable_id as article_id",
                "stocks.stockable_type as article_type",
                "stocks.date as date",
                DB::raw("SUM(stocks.entry) AS sum_entry"),
                "sales.sum_out",
            ])
            ->leftJoinSub($sales, "sales", function ($join) {
                $join->on("stocks.article_reference", "sales.article_ref");
            });

        return $stocks->groupBy("stocks.article_reference")
            ->get()
            ->map(function ($stock) {
                $stock->sum_out = $stock->sum_out ?? 0;
                $stock->final = $stock->sum_entry - $stock->sum_out;
                $article = self::getArticleByReference($stock->article_ref);

                if ($article) {
                    $stock->designation = $article->designation;
                }
                return $stock;
            });
    }
}
