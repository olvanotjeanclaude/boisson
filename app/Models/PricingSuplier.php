<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingSuplier extends Model
{
    use HasFactory, Articles;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product()
    {
        return $this->morphTo(__FUNCTION__, "article_type", "article_id");
    }

    public function scopeEmballages($query, $supplier_id = null)
    {
        $emballages = [];

        $pricings = self::whereHas("supplier")
            ->when($supplier_id != null, function ($query) use ($supplier_id) {
                return $query->where("supplier_id", $supplier_id);
            })
            ->whereHasMorph(
                'product',
                [Emballage::class]
            )->get();


        if (count($pricings)) {
            foreach ($pricings as $pricing) {
                $emballages[] = $pricing->product;
            }
        }

        return $emballages;
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
                )
                ->groupBy("article_type","article_id")
                ->get();
        }

        if (count($pricings)) {
            foreach ($pricings as $pricing) {
                $datas[] = $pricing->product;
            }
        }

        return $datas;
    }
}
