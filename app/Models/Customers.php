<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getClCodeAttribute()
    {
        return "CL{$this->code}";
    }

    public function getBadgeAttribute()
    {
        switch ($this->status) {
            case '0':
                $html = '<span class="badge badge-pill badge-danger">Passif</span>';
                break;
            case '1':
                $html = '<span class="badge badge-pill badge-success">Actif</span>';
                break;
            case '2':
                $html = '<span class="badge badge-pill badge-warning">En attente</span>';
                break;
            default:
                $html = '<span class="badge badge-pill badge-primry">Non definie</span>';
                break;
        }

        return $html;
    }

    const STATUS = [
        "passif",
        "actif",
        "attente"
    ];

    public function getIdentificationAttribute($value){
        return strtoupper($value);
    }
}
