<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    use HasFactory;

    protected $fillable = ["invoice_number", "paid", "checkout", "payment_type", "comment", "user_id","received_at"];

    public function document_vente(){
        return $this->belongsTo(DocumentVente::class, "invoice_number","number");
    }
}
