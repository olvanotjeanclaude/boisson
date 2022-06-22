<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        "code",
        "identification",
        "name",
        "email",
        "phone",
        "address",
        "note",
        "user_id",
        "bank_number"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateUniqueId()
    {
        return (string) random_int(111111, 999999);
    }

    public function getCodeIdentificationAttribute(){
        return "{$this->code}-{$this->identification}";
    }

    public function pricings(){
        return $this->hasMany(PricingSuplier::class);
    }
}
