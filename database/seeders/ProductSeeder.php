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
        $total = 15;

        for ($i = 1; $i <= $total; $i++) {
            $data = [
                "reference" =>generateInteger(),
                "designation" => "article $i",
                "price" => rand(3000, 4000),
                "category_id" => Category::inRandomOrder()->first()->id,
                "note" => "note $i",
                "user_id" => User::inRandomOrder()->first()->id
            ];
            Product::create($data);
        }

    }
}
