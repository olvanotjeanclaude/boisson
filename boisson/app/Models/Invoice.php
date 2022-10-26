<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $primaryKey = "number";

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getIsValidBadgeAttribute()
    {
        switch ($this->is_valid) {
            case '0':
                $html = "<span class='badge badge-danger'>Invalide</span>";
                break;
            case '1':
                $html = "<span class='badge badge-success'>Valid</span>";
                break;
            default:
                $html = "<span class='badge badge-primary'>Inconnu</span>";
                break;
        }

        return $html;
    }

    const TYPE =  [
        "article" => 1,
        "vente" => 2
    ];

    public function articles(){
        return $this->hasMany(Articles::class);
    }

    public function supplier()
    {
    }
}
