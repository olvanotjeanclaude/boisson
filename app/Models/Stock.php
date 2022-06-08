<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    const ARTICLE_TYPES = [
        "1" => "article",
        "2" => "emballage",
        "3" => "groupe d'article",
        "4" => "deconsignation"
    ];
}
