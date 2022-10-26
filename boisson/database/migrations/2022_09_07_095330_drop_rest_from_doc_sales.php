<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRestFromDocSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_ventes', function (Blueprint $table) {
            $table->dropColumn("rest");
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
            $table->decimal("rest")->after("checkout")->nullable();
        });
    }
}
