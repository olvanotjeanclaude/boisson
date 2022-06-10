<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAchat extends Model
{
    use HasFactory;

    protected $guarded = [];

    const PAYMENT_TYPES = [
        "1" => "Chèque",
        "2" => "espèce",
        "3" => "Mvola",
        "4" => "orange money",
        "5" => "airtel",
    ];

    const STATUS = [
        "invalid" => 1,
        "valid" => 2,
        "deleted" => 3,
        "modified" => 4,
        "pending" => 5
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function articles(){
        return $this->hasMany(Stock::class,"invoice_number","number");
    }

    public function getStatusHtmlAttribute()
    {
        switch ($this->status) {
            case self::STATUS["invalid"]:
                $html = '<span class="badge badge-danger">Invalide</span>';
                break;
            case self::STATUS["valid"]:
                $html = '<span class="badge badge-success">Valide</span>';
                break;
            case self::STATUS["deleted"]:
                $html = '<span class="badge badge-danger">Supprimer</span>';
                break;
            case self::STATUS["invalid"]:
                $html = '<span class="badge badge-danger">Invalid</span>';
                break;
            case self::STATUS["invalid"]:
                $html = '<span class="badge badge-danger">Invalid</span>';
                break;
            case self::STATUS["invalid"]:
                $html = '<span class="badge badge-danger">Invalid</span>';
                break;

            default:
                $html = '<span class="badge badge-dark">Inconnu</span>';
                break;
        }

        return $html;
    }
}
