<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return  $this->belongsTo(Category::class);
    }

    public function stock(){
        return $this->morphOne(Stock::class,"stockable");
    }

    public function supplier_prices(){
        return $this->morphMany(PricingSuplier::class,"product","article_type","article_id");
    }
}
