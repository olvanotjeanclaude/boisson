<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SupplierOrders extends Model
{
    use HasFactory, Articles;

    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product()
    {
        return $this->morphTo(__FUNCTION__, "article_type", "article_id");
    }

    public function supplier_price()
    {
        return $this->belongsTo(PricingSuplier::class, "pricing_id");
    }

    public function getSubAmountAttribute()
    {
        $sub_amount = 0;

        if ($this->supplier_price) {
            $sub_amount = $this->supplier_price->buying_price * $this->quantity;
        }

        return $this->isWithEmballage ? -$sub_amount : $sub_amount;
    }

    public function scopePreArticlesSum($q)
    {
        $orders = $q->where("user_id", auth()->user()->id)->whereNull("invoice_number")->get();

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

    public function scopeArticles($query, $type, $supplier_id = null)
    {
        $datas = $pricings = [];

        switch ($type) {
            case 'products':
                $typeArray = [Product::class];
                break;
            case 'emballages':
                $typeArray = [Emballage::class];
                break;
            case 'packages':
                $typeArray = [Package::class];
                break;
            case 'productAndPackages':
                $typeArray = [Product::class, Package::class];
                break;
            case 'all':
                $typeArray = ["*"];
                break;
            default:
                $typeArray = [];
                break;
        }

        if (count($typeArray)) {
            $pricings = self::whereHas("supplier")
                ->when($supplier_id != null, function ($query) use ($supplier_id) {
                    return $query->where("supplier_id", $supplier_id);
                })
                ->whereHasMorph(
                    'product',
                    $typeArray
                )->groupBy("article_reference")->get();
        }

        if (count($pricings)) {
            foreach ($pricings as $pricing) {
                $datas[] = $pricing->product;
            }
        }

        return $datas;
    }

    public  function scopeBetween($query, $between = [])
    {
        if (empty($between)) {
            $between = [now()->subMonth()->toDateString(), now()->subDay()->toDateString()];
        }

        return DB::table("supplier_orders")
            ->whereNotNull("invoice_number")
            ->whereBetween("received_at", $between)
            ->selectRaw('SUM(quantity) as sum_initial,article_reference,article_id,article_type, received_at')
            ->groupBy('article_reference')

            ->get();
    }
    public  function scopeByDate($query, $date = null)
    {
        if (is_null($date)) {
            $date = date("Y-m-d");
        }

        return DB::table("supplier_orders")->where("received_at", $date)
            ->whereNotNull("invoice_number")
            ->selectRaw('SUM(quantity) as sum_entry,article_reference,article_id,article_type, received_at')
            ->groupBy('article_reference')
            ->get();
    }
}
