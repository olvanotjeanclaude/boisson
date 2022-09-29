<?php

namespace App\Models;

use App\helper\Filter;
use App\Traits\Articles;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Route;

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

    const STATUS_TEXT = [
        "accepted" => "Accepté",
        "pending" => "En attente",
        "canceled" => "Annulé",
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePreInvoices($q)
    {
        return $q->where("status", self::STATUS["pending"])
            ->where("action_type", self::ACTION_TYPES["new_stock"])
            ->where("user_id", auth()->id())->get();
    }

    public function getSubAmountAttribute()
    {
        $sub_amount = 0;

        $route = Route::currentRouteName();
        if (str_contains($route, "achat-fournisseurs")) {
            $price =  $this->stockable->buying_price;
        } else {
            $price =  $this->stockable->price;
        }

        if ($this->entry > 0) {
            $quantity = $this->entry;
        } else if ($this->out > 0) {
            $quantity = $this->out;
        } else {
            $quantity = 0;
        }
        
        if ($this->stockable) {
            $sub_amount = $price * $quantity;
        }

        return $sub_amount;
    }

    public function stockable()
    {
        return $this->morphTo();
    }

    public function getAmountAttribute()
    {
        return $this->final * $this->stockable->price;
    }

    public function getStatusHtmlAttribute()
    {
        switch ($this->status) {
            case self::STATUS["accepted"]:
                $html = '<span class="badge badge-success">Accepté</span>';
                break;
            case self::STATUS["pending"]:
                $html = '<span class="badge badge-primary">En attente</span>';
                break;
            case self::STATUS["canceled"]:
                $html = '<span class="badge badge-danger">Annulé</span>';
                break;
            default:
                $html = '<span class="badge badge-dark">Inconnu</span>';
                break;
        }

        return $html;
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

    public static function EntriesOuts($between = [])
    {
        if (empty($between)) {
            $between = self::getDefaultBetween();
        }

        $sales = DB::table('sales')
            ->select([
                "article_reference", "saleable_type as article_type",
                DB::raw("CASE WHEN (isWithEmballage=1 AND saleable_type='App\\\\Models\\\\Emballage')
                THEN (SELECT quantity) ELSE 0 END AS 'entry'"),
                DB::raw("CASE WHEN ((isWithEmballage=0 AND saleable_type='App\\\\Models\\\\Emballage') OR 
                (saleable_type='App\\\\Models\\\\Product'))
                THEN (SELECT quantity) ELSE 0 END AS 'out'"),
            ])
            ->where(function ($query) use ($between) {
                $query->where(fn ($query) => Filter::queryBetween($query, $between));
            });

        $stocks = DB::table("stocks")
            ->select(["article_reference", "stockable_type as article_type", "entry", "out"])
            ->where("status", self::STATUS["accepted"])
            ->where(function ($query) use ($between) {
                $query->where(fn ($query) => Filter::queryBetween($query, $between, "date"));
            });

        $entriesOuts = $stocks->unionAll($sales)
            ->get()
            ->groupBy("article_reference")
            ->map(function ($data) {
                $response = [];
                $first = $data->first();
                $article = null;

                if ($first) {
                    $article = Stock::getArticleByReference($first->article_reference);
                    if ($article) {
                        $response = (object)[
                            "reference" =>  $article->reference,
                            "designation" => $article->designation,
                            "article_reference" => $article->reference,
                            "type" => get_class($article) == "App\Models\Product" ? "article" : "emballage",
                            "article_type" => get_class($article),
                            "sum_entry" => $data->sum("entry"),
                            "sum_out" => $data->sum("out"),
                            "final" => $data->sum("entry") - $data->sum("out")
                        ];
                    }
                }

                return $response;
            })
            ->sortByDesc("final")
            ->filter(fn ($article) => isset($article->designation));

        return $entriesOuts;
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
            ->orderBy("id", "desc")
            ->get();

        return $entries;
    }

    public function scopeOuts($query)
    {
        $entries = $query->whereNotNull("invoice_number")
            ->where("action_type", self::ACTION_TYPES["sample_out"])
            ->groupBy("invoice_number", "date")
            ->orderBy("id", "desc")
            ->get();

        return $entries;
    }

    public function scopeEntryByInvoiceNumber($query, $invoiceNumber)
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
