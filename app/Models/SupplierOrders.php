<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierOrders extends Model
{
    use HasFactory,Articles;

    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product()
    {
        return $this->morphTo(__FUNCTION__, "article_type", "article_id");
    }

    public function supplier_price(){
        return $this->belongsTo(PricingSuplier::class,"pricing_id");
    }

    public function getSubAmountAttribute()
    {
        $sub_amount =0;

        if($this->supplier_price){
            $sub_amount= $this->supplier_price->buying_price * $this->quantity;
        }
      
        return $this->isWithEmballage ? -$sub_amount : $sub_amount;
    }

    public function scopePreArticlesSum($q)
    {
        $orders = $q->where("user_id",auth()->user()->id)->whereNull("invoice_number")->get();

        $articleAndConsignation = $orders->filter(function ($sale) {
            return $sale->isWithEmballage == 0;
        })
        ->sum(function ($order) {
            return $order->supplier_price->buying_price * $order->quantity;
        });
        
        $deconsignation = $orders->filter(function ($order) {
            return $order->isWithEmballage == 1;
        })->sum(function ($order) {
            return $order->supplier_price->buying_price * $order->quantity;
        });

        return $articleAndConsignation - $deconsignation;
    }
}
