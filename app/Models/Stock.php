<?php

namespace App\Models;

use App\Traits\Articles;
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

    public function scopePrev($query, $article_ref)
    {
        return $query->where("article_reference", $article_ref)
            ->where("date", "<=", date("Y-m-d"))
            ->orderBy("id", "desc")
            ->get();
    }

    public static function getDefaultBetween()
    {
        return [now()->subDays(7)->toDateString(), now()->toDateString()];
    }

    public function scopeBetween($query, $between = [])
    {
        if (empty($between)) {
            $between = self::getDefaultBetween();
        }
        // $between = ["2022-08-01","2022-08-01"];
        // dd($between);
        $stockOut = DB::table("sales")
            ->select([
                "article_reference",
                DB::raw("SUM(quantity) AS sum_out"),
                "saleable_id",
                "saleable_type"
            ])
            ->whereNotNull("invoice_number")
            ->whereNotNull("received_at")
            ->when($between[0] == $between[1], function ($query) use($between) {
                return $query->whereDate("received_at", $between[0]);
            })
            ->when($between[0] != $between[1], function ($query) use($between) {
                return $query->whereBetween("received_at", $between);
            })
            ->groupBy("article_reference");


        $stocks = DB::table("supplier_orders")
            ->select([
                DB::raw("supplier_orders.article_reference AS article_reference"),
                DB::raw("supplier_orders.article_id AS article_id"),
                DB::raw("supplier_orders.article_type AS article_type"),
                DB::raw("SUM(supplier_orders.quantity) AS sum_entry"),
                "stock_out.sum_out"
            ])
            // dd($stocks,$stockOut->get());
            ->leftJoinSub($stockOut, "stock_out", function ($join) use($stockOut) {
                $join->on("supplier_orders.article_reference", "=", "stock_out.article_reference");
            })
            ->whereNotNull("supplier_orders.invoice_number")
            ->whereNotNull("supplier_orders.received_at")
            ->when($between[0] == $between[1], function ($query) use($between) {
                return $query->whereDate("received_at", $between[0]);
            })
            ->when($between[0] != $between[1], function ($query) use($between) {
                return $query->whereBetween("received_at", $between);
            })
            ->groupBy("supplier_orders.article_reference")
            ->get()->map(function ($data) {
                $modelArticle = $data->article_type;
                $article = $modelArticle::find($data->article_id);
                if ($article) {
                    $data->designation = $article->designation;
                    $data->final = $data->sum_entry - $data->sum_out;
                }

                return $data;
            });

        return $stocks;
    }
}
