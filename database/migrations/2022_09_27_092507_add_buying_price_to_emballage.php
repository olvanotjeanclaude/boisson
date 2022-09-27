<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuyingPriceToEmballage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emballages', function (Blueprint $table) {
            $table->decimal("buying_price")->after("price")->comment("prix d'achat");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emballages', function (Blueprint $table) {
            $table->dropColumn("buying_price");
        });
    }
}
