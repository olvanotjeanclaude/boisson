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
        "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
