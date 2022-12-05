<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResetDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [
            DB::table("document_achats"),
            DB::table("document_ventes"),
            DB::table("inventories"),
            DB::table("sales"),
            DB::table("stocks"),
            DB::table("supplier_orders"),
        ];

        foreach ($tables as  $table) {
            $table->truncate();
        }
    }
}
