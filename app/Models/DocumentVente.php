<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentVente extends Model
{
    use HasFactory,Articles;

    protected $guarded = [];

    public function customer(){
        return $this->belongsTo(Customers::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class,"invoice_number","number");
    }
}

