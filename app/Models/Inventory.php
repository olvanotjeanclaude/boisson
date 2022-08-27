<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory, Articles;
    protected $guarded = [];

    const STATUS = [
        "accepted" => 1,
        "pending" => 2,
        "canceled" => 3,
    ];
    public function inventaireable()
    {
        return $this->morphTo();
    }

    public function getProductAttribute()
    {
        return Articles::getArticleByReference($this->article_reference);
    }

    public function getStatusHtmlAttribute()
    {
        switch ($this->status) {
            case self::STATUS["accepted"]:
                $html = '<span class="badge badge-success">Payé</span>';
                break;
            case self::STATUS["pending"]:
                $html = '<span class="badge badge-primary">En attente de validation</span>';
                break;
            case self::STATUS["canceled"]:
                $html = '<span class="badge badge-danger">Annulé</span>';
                break;
            default:
                $html = '<span class="badge badge-dark">Inconnu</span>';
                break;
        }

        return $html;
    }
}
