<?php

namespace Database\Seeders;

use App\Models\DocumentVente;
use App\Models\SalePayment;
use Illuminate\Database\Seeder;

class SyncSalePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentVente::all()->each(function($doc){
            SalePayment::create([
                "invoice_number" =>$doc->number,
                "paid" =>$doc->paid,
                "checkout" =>$doc->checkout,
                "payment_type" =>$doc->payment_type,
                "comment" =>$doc->comment,
                "user_id" =>$doc->user_id,
                "received_at" =>date("Y-m-d",strtotime($doc->received_at))
            ]);
        });
    }
}
