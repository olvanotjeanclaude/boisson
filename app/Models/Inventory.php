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

    const STATUS_TEXT = [
        "accepted" => "Accepté",
        "pending" => "En attente",
        "canceled" => "Annulé",
    ];

    public function article()
    {
        return $this->morphTo(__FUNCTION__, "article_type", "article_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stock(){
        return $this->hasOne(Stock::class);
    }

    public function getProductAttribute()
    {
        return Articles::getArticleByReference($this->article_reference);
    }

    public function getStatusHtmlAttribute()
    {
        switch ($this->status) {
            case self::STATUS["accepted"]:
                $html = "<span class='badge badge-success'>" . self::STATUS_TEXT["accepted"] . "</span>";
                break;
            case self::STATUS["pending"]:
                $html = "<span class='badge badge-primary'>" . self::STATUS_TEXT["pending"] . "</span>";
                break;
            case self::STATUS["canceled"]:
                $html = "<span class='badge badge-danger'>" . self::STATUS_TEXT["canceled"] . "</span>";
                break;
            default:
                $html = "<span class='badge badge-dark'>Inconnu</span>";
                break;
        }

        return $html;
    }
    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case self::STATUS["accepted"]:
                $text = self::STATUS_TEXT["accepted"];
                break;
            case self::STATUS["pending"]:
                $text = self::STATUS_TEXT["pending"];
                break;
            case self::STATUS["canceled"]:
                $text = self::STATUS_TEXT["canceled"];
                break;
            default:
                $text = 'Inconnu';
                break;
        }

        return $text;
    }
}
