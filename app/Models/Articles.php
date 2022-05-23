<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $guarded = [];

    const UNITS = [
        "pcs" => 1,
        "cageot" => 2,
        "carton" => 3
    ];

    const ARTICLE_TYPES = [
        "article" => 1,
        "consignation" => 2,
        "deconsignation" => 3
    ];
}
