<?php

namespace Database\Seeders;

use App\Articles\Pricing;
use App\Models\DocumentVente;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class SyncSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::all()->each(function ($sale) {
            $article = Stock::getArticleByReference($sale->article_reference);
            $docSale = DocumentVente::where("number", $sale->invoice_number)->first();
            if ($article && $docSale) {
                $price = Pricing::getPrice($article, $sale->quantity);
                $amount = $sale->quantity * $price;

                if ($sale->isWithEmballage && get_class($article) == "App\Models\Emballage") {
                    $amount = -$amount;
                }

                $sale->update([
                    "price" => $price,
                    "customer_id" => $docSale->customer_id,
                    "amount" =>$amount
                ]);
            }
        });
    }
}
