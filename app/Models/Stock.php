<?php

namespace App\Models;

use App\helper\Filter;
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

    const ACTION_TYPES = [
        "new_stock" => 1,
        "sample_out" => 2,
        "out_to_supplier" => 3,
    ];

    const STATUS = [
        "pending" => 1,
        "accepted" => 2,
        "canceled" => 3
    ];
    
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function scopePreInvoices($q)
    {
        return $q->where("status", self::STATUS["pending"])->where("user_id", auth()->id())->get();
    }

    public function getSubAmountAttribute()
    {
        $sub_amount = 0;

        if ($this->stockable) {
            $sub_amount = $this->stockable->buying_price * $this->entry;
        }

        return $sub_amount;
    }

    private static function  defaultSelect()
    {
        return [
            "sale" => [
                "document_ventes.status as status",
                "document_ventes.number as invoice_number",
                "sales.saleable_id as article_id",
                "sales.saleable_type as article_type",
                "sales.article_reference as article_ref",
                "sales.isWithEmballage as isWithEmballage",
                DB::raw("SUM(sales.quantity) AS sum_out"),
            ],
            "stock" => [
                "stocks.article_reference as article_ref",
                "stocks.stockable_id as article_id",
                "stocks.stockable_type as article_type",
                "stocks.date as date",
                DB::raw("SUM(stocks.entry) AS sum_entry"),
                "sales.sum_out",
                // DB::raw("SUM(stocks.out) as sum_stock_out"),
                "sales.isWithEmballage",
                DB::raw("COALESCE(sales.isWithEmballage,0) as isWithEmballage")
            ]
        ];
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

        $n = self::minDateNumber();

        return $date->subDays($n)->toDateString();
    }

    public static function minDateNumber()
    {
        $setting = Settings::first();
        return is_null($setting) ? 7 : $setting->min_stock_day;
    }

    public function scopeBetween($query, $between = [])
    {
        if (empty($between)) {
            $between = self::getDefaultBetween();
        } else if ($between[0] == $between[1]) {
            $between = [self::MinDate($between[0]), $between[0]];
        }

        $sales = DB::table('document_ventes')
            ->select(self::defaultSelect()["sale"])->join("sales", function ($join) use ($between) {
                $join->on("sales.invoice_number", "document_ventes.number")
                    ->where(fn ($query) => Filter::queryBetween($query, $between, "sales.received_at"));
            })->groupBy("sales.article_reference", "sales.isWithEmballage");
        // dd($sales->get());
        $stocks = DB::table("stocks")
            ->where("stocks.status", self::STATUS["accepted"])
            ->where(fn ($query) => Filter::queryBetween($query, $between, "stocks.date"))
            ->select(self::defaultSelect()["stock"])
            ->leftJoinSub($sales, "sales", function ($join) {
                $join->on("stocks.article_reference", "sales.article_ref");
            })
            ->groupBy("stocks.article_reference", "sales.isWithEmballage")
            ->orderByDesc("id")
            ->get();
        // dd();
        $stocks = $stocks->map(fn ($stock) => $this->mapStock($stock))
            ->filter(fn ($stock) => isset($stock->type) && isset($stock));

        return $stocks;
    }

    public function scopefilterBetween($query, $between = null)
    {
        $stocks = $query->select([
            "article_reference", "stockable_id", "stockable_type",
            DB::raw("SUM(entry) as entry"),
        ])
            ->whereHasMorph(
                'stockable',
                [Product::class]
            );

        $stocks = Filter::queryBetween($query, $between, "date");

        return $stocks->groupBy("article_reference")
            ->get();
    }

    private function mapStock($stock)
    {
        $stock->sum_out = $stock->sum_out ?? 0;
        $article = self::getArticleByReference($stock->article_ref);
        // dd($stock);

        if ($article) {
            $stock->type = "article";
            if ($stock->article_type == "App\Models\Emballage") {
                if ($stock->isWithEmballage == 0) {
                    $stock->type = "consignation";
                } else {
                    $stock->type = "deconsignation";
                    $stock->sum_entry = $stock->sum_out;
                    $stock->sum_out = 0;
                }
            }
            $stock->designation = $article->designation;
        }
        // $stock->final = $stock->sum_entry - $stock->sum_out - $stock->sum_stock_out;
        $stock->final = $stock->sum_entry - $stock->sum_out;

        if (isset($stock->type) && $stock->type == "deconsignation") {
            // $stock->sum_stock_out =0;
            // $stock->final = null;
        }

        return $stock;
    }

    public function scopeEntries($query)
    {
        $entries = $query
            ->select([
                "*",
                DB::raw("COUNT(*) as sum_article"),
            ])
            ->where("status", self::STATUS["accepted"])
            ->whereNotNull("invoice_number")
            ->where("action_type", self::ACTION_TYPES["new_stock"])
            ->groupBy("invoice_number", "date")
            ->orderBy("id","desc")
            ->get();

        return $entries;
    }

    public function scopeEntryByInvoiceNumber($query,$invoiceNumber)
    {
        $entries = $query
            ->where("invoice_number", $invoiceNumber)
            ->where("status", self::STATUS["accepted"])
            ->whereNotNull("invoice_number")
            ->where("action_type", self::ACTION_TYPES["new_stock"])
            ->get();
        return $entries;
    }
}
