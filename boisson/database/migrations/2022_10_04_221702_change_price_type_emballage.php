<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePriceTypeEmballage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emballages', function (Blueprint $table) {
            $table->decimal("price",20,2)->change();
            $table->decimal("buying_price",20,2)->change();
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
            $table->decimal("price")->change();
            $table->decimal("buying_price")->change();
        });
    }
}
