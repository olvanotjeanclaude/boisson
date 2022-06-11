<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory,Articles;

    protected $guarded = [];

    public function saleable()
    {
        return $this->morphTo();
    }
}
