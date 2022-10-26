<?php

namespace Database\Seeders;

use App\Models\Emballage;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BuyingPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::all()->each(function ($product) {
            $product->update(["buying_price" => $product->price - 200]);
        });

        Emballage::all()->each(function ($product) {
            $product->update(["buying_price" => $product->price - 70]);
        });
    }
}
