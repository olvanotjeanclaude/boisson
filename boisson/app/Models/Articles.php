<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory;

    protected $guarded = [];

    const UNITS = [
        "1" => "pcs",
        "2" => "litre"
    ];

    const PACKAGE_TYPES = [
        "1" => "cageot",
        "2" => "carton",
        "3" => "pack",
        "4" => "fut",
    ];

    const ARTICLE_TYPES = [
        "article" => 1,
        "consignation" => 2,
        "deconsignation" => 3
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getProductUnityAttribute()
    {
        return array_search($this->unity, self::UNITS);
    }

    public function getProductQuantityTypeAttribute()
    {
        return array_search($this->quantity_type, self::UNITS);
    }

    public function getProductTypeAttribute()
    {
        return array_search($this->article_type, self::ARTICLE_TYPES);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_update()
    {
        return $this->belongsTo(User::class, "user_update_id");
    }

    public function suplier()
    {
        return $this->belongsTo(suplier::class);
    }

    public static function PackageTypes()
    {
        return self::PACKAGE_TYPES;
    }
}
