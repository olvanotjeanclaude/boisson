<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMoneyType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_ventes', function (Blueprint $table) {
            $table->decimal("paid",20,2)->change();
            $table->decimal("checkout",20,2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_ventes', function (Blueprint $table) {
            $table->decimal("paid")->change();
            $table->decimal("checkout")->change();
        });
    }
}
