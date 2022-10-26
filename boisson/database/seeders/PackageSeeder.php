<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Product::all() as $key => $data) {
            $data =  [
                "reference" => generateInteger(4),
                "designation" => $data->designation . " en gros",
                "product_id" => $data->id,
                "contenance" => rand(20, 25),
                "price" => rand(5000, 10000),
                "category_id" => Category::inRandomOrder()->first()->id,
                "note" => "note",
                "user_id" => User::inRandomOrder()->first()->id
            ];

            Package::create($data);
        }
    }
}
