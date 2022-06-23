<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAchat extends Model
{
    use HasFactory,Articles;

    protected $guarded = [];

    const PAYMENT_TYPES = [
        "1" => "Chèque",
        "2" => "Espèce",
        "3" => "Mvola",
        "4" => "Orange Money",
        "5" => "Airtel Money",
    ];

    const STATUS = [
        "invalid" => 1,
        "valid" => 2,
        "deleted" => 3,
        "modified" => 4,
        "pending" => 5
    ];

    public function supplier_orders(){
        return $this->hasMany(SupplierOrders::class,"invoice_number","number");
    }
}
