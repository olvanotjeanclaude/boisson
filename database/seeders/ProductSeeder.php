<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                "reference" => generateInteger(),
                "designation" => "coca",
                "price" => rand(3000, 4000),
                "category_id" => Category::inRandomOrder()->first()->id,
                "note" => "note simple produit",
                "user_id" => User::inRandomOrder()->first()->id
            ],
            [
                "reference" => generateInteger(),
                "designation" => "limonade",
                "price" => rand(3000, 4000),
                "category_id" => Category::inRandomOrder()->first()->id,
                "note" => "note simple produit",
                "user_id" => User::inRandomOrder()->first()->id
            ],
            [
                "reference" => generateInteger(),
                "designation" => "fraise",
                "price" => rand(3000, 4000),
                "category_id" => Category::inRandomOrder()->first()->id,
                "note" => "note simple produit",
                "user_id" => User::inRandomOrder()->first()->id
            ],
            [
                "reference" => generateInteger(),
                "designation" => "Sprite",
                "price" => rand(3000, 4000),
                "category_id" => Category::inRandomOrder()->first()->id,
                "note" => "note simple produit",
                "user_id" => User::inRandomOrder()->first()->id
            ],
        ];

        foreach ($products as $key => $data) {
            Product::create($data);
        }
    }
}
