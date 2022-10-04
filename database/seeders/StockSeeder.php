<?php

namespace Database\Seeders;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Emballage;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = [...Product::all(), ...Emballage::all()];

        foreach ($articles as $article) {
            $data = [
                "status" => Stock::STATUS["pending"],
                "article_reference" => $article->reference,
                "stockable_id" => $article->id,
                "stockable_type" => get_class($article),
                "entry" =>0,
                "out" =>0,
                "user_id" => auth()->user()->id,
                "action_type" => Stock::ACTION_TYPES["new_stock"],
                "date" => now()->toDateString(),
            ];

            Stock::create($data);
        }
    }
}
