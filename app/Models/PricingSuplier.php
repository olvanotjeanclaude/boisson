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
}
