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

    public function saleable()
    {
        return $this->morphTo();
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
            $between = [now()->subMonth()->toDateString(), now()->subDay()->toDateString()];
        }

        return DB::table("sales")
            ->whereNotNull("invoice_number")
            ->whereNotNull("received_at")
            ->whereBetween("received_at", $between)
            ->selectRaw('SUM(quantity) as sum_initial,article_reference,saleable_id,saleable_type, received_at')
            ->groupBy('article_reference')

            ->get();
    }

    public  function scopeByDate($query,$isWithEmballage=false, $date = null)
    {
        return DB::table("sales")
            ->whereNotNull("invoice_number")
            ->whereNotNull("received_at")
            ->where("isWithEmballage",$isWithEmballage)
            ->when(!is_null($date), function ($query) use ($date) {
                return $query->whereDate("received_at", $date);
            })
            ->selectRaw('SUM(quantity) as sum_sale,article_reference,saleable_id,saleable_type, received_at')
            ->groupBy('article_reference')
            ->get();
    }
}
