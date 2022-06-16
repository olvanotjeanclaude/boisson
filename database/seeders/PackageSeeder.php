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
        // $table->id();
        // $table->string("reference");
        // $table->string("designation");
        // $table->unsignedBigInteger("product_id");
        // $table->integer("contenance");
        // $table->decimal("price")->comment("Prix de vente, pris de gros");
        // $table->unsignedBigInteger("category_id");
        // $table->longText("note")->nullable();
        // $table->unsignedBigInteger("user_id");
        // $table->unsignedBigInteger("update_user_id")->nullable();
        // $table->timestamps();

        $total = 15;
        $type = ["cageot", "carton"];
        for ($i = 1; $i <= $total; $i++) {
            $data = [
                "reference" => generateInteger(4),
                "designation" => $type[rand(0,1)].  " d'article $i",
                "product_id" => Product::inRandomOrder()->first()->id,
                "contenance" => rand(20, 25),
                "price" => rand(5000, 10000),
                "category_id" => Category::inRandomOrder()->first()->id,
                "note" => "note $i",
                "user_id" => User::inRandomOrder()->first()->id
            ];
            Package::create($data);
        }

    }
}
