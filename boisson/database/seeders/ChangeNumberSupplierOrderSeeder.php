<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class ChangeNumberSupplierOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 1;
        $stocks =  Stock::all()->groupBy("invoice_number");
        foreach ($stocks as $index => $stock) {
            foreach ($stock as  $value) {
                $value->update(["range" =>$count]);
            }
            $count++;
        }
    }
}
