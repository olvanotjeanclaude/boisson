<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAchat extends Model
{
    use HasFactory;

    protected $guarded = [];

    const PAYMENT_TYPES = [
        "1" =>"Chèque",
        "2" =>"espèce",
        "3" =>"Mvola",
        "4" =>"orange money",
        "5" =>"airtel",
    ];
}
