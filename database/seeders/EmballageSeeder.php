<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Emballage;
use App\Models\Package;
use Illuminate\Database\Seeder;

class EmballageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Product::all() as $key => $value) {
            $data =  [
                "reference" => generateInteger(5),
                "designation" => "tavoangy " . $value->designation . " vide",
                "content_id" => $value->id,
                "simpleOrGroup" => 1,
                "quantity" => 1,
                "price" => rand(3000, 4000),
                "user_id" => User::inRandomOrder()->first()->id
            ];
            Emballage::create($data);
        }

        foreach (Package::all() as $key => $value) {
            $data =  [
                "reference" => generateInteger(5),
                "designation" => "cageot " . $value->designation . " vide",
                "content_id" => $value->id,
                "simpleOrGroup" => 2,
                "quantity" => rand(15,30),
                "price" => rand(3000, 4000),
                "user_id" => User::inRandomOrder()->first()->id
            ];
            Emballage::create($data);
        }
    }
}
