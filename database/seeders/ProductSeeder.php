<?php

namespace Database\Seeders;

use App\Models\Emballage;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = DB::table("prod_products")->get();
        $emballages = DB::table("prod_emballages")->get();

        foreach ($products as $key => $product) {
            $data = [
                "reference" => $product->reference,
                "designation" => $product->designation,
                "price" => $product->price,
                "wholesale_price" => $product->wholesale_price,
                "buying_price" => 0,
                "unity" => $product->unity,
                "package_type" => $product->package_type,
                "contenance" => $product->contenance,
                "condition" => $product->condition,
                "simple_package_id" => $product->simple_package_id,
                "big_package_id" => $product->big_package_id,
                "category_id" => $product->category_id,
                "note" => $product->note,
                "user_id" => $product->user_id,
                "update_user_id" => $product->update_user_id,
                "created_at" => $product->created_at,
                "updated_at" => $product->updated_at,
            ];

            Product::create($data);
        }

        foreach ($emballages as $key => $emballage) {
            $new = [
                "reference" => $emballage->reference,
                "designation" => $emballage->designation,
                "price" => $emballage->price,
                "buying_price" => 0,
                "content_id" => $emballage->content_id,
                "quantity" => $emballage->quantity,
                "simpleOrGroup" => $emballage->simpleOrGroup,
                "note" => $emballage->note,
                "user_id" => $emballage->user_id,
                "update_user_id" => $emballage->update_user_id,
                "created_at" => $emballage->created_at,
                "updated_at" => $emballage->updated_at,
            ];

            Emballage::create($new);
        }
    }
}
