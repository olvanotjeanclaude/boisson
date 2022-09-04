<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory, Articles;

    protected $guarded = [];
    const ACTION_TYPES = ["avec-consignation","deconsignation"];

    public function saleable()
    {
        return $this->morphTo();
    }

    public function getArticleTypeAttribute()
    {
        switch ($this->saleable_type) {
            case 'App\Models\Product':
                $type = "En Detail";
                break;
            case 'App\Models\Package':
                $type = "En Gros";
                break;
            case 'App\Models\Emballage':
                if ($this->isWithEmballage) {
                    $type = "Deconsignation";
                } else {
                    $type = "Consignation";
                }
                break;
            default:
                $type = "Inconnu";
                break;
        }

        return $type;
    }

    public function getSubAmountAttribute()
    {
        $sub_amount = $this->saleable->price * $this->quantity;
        return $this->isWithEmballage ? -$sub_amount : $sub_amount;
    }

    public function scopePreArticlesSum($q)
    {
        $sales = $q->where("user_id", auth()->user()->id)->whereNull("invoice_number")->get();

        $articleAndConsignation = $sales->filter(function ($sale) {
            return $sale->isWithEmballage == 0;
        })->sum(function ($sale) {
            return $sale->saleable->price * $sale->quantity;
        });

        $deconsignation = $sales->filter(function ($sale) {
            return $sale->isWithEmballage == 1;
        })->sum(function ($sale) {
            return $sale->saleable->price * $sale->quantity;
        });

        return $articleAndConsignation - $deconsignation;
    }

    public  function scopeBetween($query, $between = [])
    {
        if (empty($between)) {
            $between = Stock::getDefaultBetween();
        }

        return DB::table("sales")
            ->whereNotNull("invoice_number")
            ->whereNotNull("received_at")
            ->whereBetween("received_at", $between)
            ->selectRaw('SUM(quantity) as sum_sale,article_reference,saleable_id,saleable_type')
            ->groupBy("article_reference")

            ->get();
    }

    public  function scopeByDate($query, $isWithEmballage = false, $date = null)
    {
        return DB::table("sales")
            ->whereNotNull("invoice_number")
            ->whereNotNull("received_at")
            ->where("isWithEmballage", $isWithEmballage)
            ->when(!is_null($date), function ($query) use ($date) {
                return $query->whereDate("received_at", $date);
            })
            ->selectRaw('SUM(quantity) as sum_sale,article_reference,saleable_id,saleable_type, received_at')
            ->groupBy("article_reference", "received_at")
            ->get();
    }

    public  function scopeCommercialState($query)
    {
        return self::whereNotNull("invoice_number")
            ->whereNotNull("received_at")
            ->selectRaw('SUM(quantity) as sum_sale,article_reference,saleable_id,saleable_type, received_at, isWithEmballage')
            ->groupBy("saleable_type", "saleable_id", "received_at", "isWithEmballage");
    }

    public  function scopeCommercialStateByDate($query, $date = null)
    {
        $sales = self::whereNotNull("invoice_number")
            ->whereNotNull("received_at");

        if (is_null($date)) {
            $date = date("Y-m-d");
        }

        return $sales->where("received_at", $date)
            ->selectRaw('SUM(quantity) as sum_sale,article_reference,saleable_id,saleable_type, received_at, isWithEmballage')
            ->groupBy("saleable_type", "saleable_id", "received_at", "isWithEmballage")
            ->get();
    }

    public  function scopeCommercialStateBetween($query, $between)
    {
        $sales = self::whereNotNull("invoice_number")
            ->whereNotNull("received_at");

        return $sales->whereBetween("received_at", $between)
            ->selectRaw('SUM(quantity) as sum_sale,article_reference,saleable_id,saleable_type, received_at, isWithEmballage')
            ->groupBy("saleable_type", "saleable_id", "received_at", "isWithEmballage")
            ->get();
    }

    public  function scopeFilterBy($query, $type, $criteria = [])
    {
        $sales = self::whereNotNull("invoice_number")
            ->whereNotNull("received_at");

        switch ($type) {
            case 'jour':
                $date = $criteria["date"];
                $sales = $sales->where("received_at", $date);
                break;
            case 'hebdomadaire':
                $between = $criteria["between"];
                $sales = $sales->whereBetween("received_at", $between);
                break;
            case 'mois':
                $monthYear = $criteria["monthYear"];
                $sales = $sales->whereMonth("received_at", $monthYear[0])
                    ->whereYear("received_at", $monthYear[1]);
                break;
            case 'annuel':
                $year = $criteria["year"];
                $sales =  $sales->whereYear("received_at", $year);
                break;
            default:
                $sales = $sales->where("received_at", date("Y-m-d"));
                break;
        }

        return $sales->selectRaw('SUM(quantity) as sum_sale,invoice_number,article_reference,saleable_id,saleable_type, received_at, isWithEmballage')
            ->groupBy("saleable_type", "saleable_id", "received_at", "isWithEmballage")
            ->get()
            ->map(function ($state) {
                $state->amount = $state->sum_sale * $state->saleable->price;
                $state->amount = $state->isWithEmballage ? -$state->amount : $state->amount;
                $state->amount = $state->isWithEmballage ? -$state->amount : $state->amount;
                return $state;
            });
    }
}
