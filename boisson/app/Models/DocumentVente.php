<?php

namespace App\Models;

use App\helper\Invoice;
use App\Traits\Articles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentVente extends Model
{
    use HasFactory, Articles;

    protected $guarded = [];

    const FILTER_TYPE = [
        "jour" => "Date",
        "hebdomadaire" => "Semaine De L'Année",
        "mois" => "mois",
        "annuel" => "Année"
    ];

    const PAYMENT_TYPES = [
        "1" => "Chèque",
        "2" => "Espèce",
        "3" => "Mvola",
        "4" => "Orange Money",
        "5" => "Airtel Money",
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, "invoice_number", "number");
    }

    public function sumPaid()
    {
        $payments =  $this->sale_payments;

        return $payments->sum("paid") - $payments->sum("checkout");
    }

    public function sumCheckout()
    {
        return $this->sale_payments->sum("checkout");
    }

    public  function rest()
    {
        $rest = $this->totalAmount() -  $this->sumPaid();

        return round($rest, 2);
    }

    public function totalAmount()
    {
        return $this->sales->sum("amount");
    }

    public function getStatusAttribute($value)
    {
        $rest = self::Rest($this->number);

        if ($rest > 0 && $value == Invoice::STATUS["paid"]) {
            $value = Invoice::STATUS["incomplete"];
        }

        return $value;
    }


    public function sale_payments()
    {
        return $this->hasMany(SalePayment::class, "invoice_number","number");
    }
}
