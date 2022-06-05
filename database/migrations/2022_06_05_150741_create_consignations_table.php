<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignations', function (Blueprint $table) {
            $table->id();
            $table->string("reference");
            $table->string("designation");
            $table->decimal("unit_price")->comment("Prix unitaire d'achat");
            $table->decimal("price")->comment("Prix unitaire de vente");
            $table->unsignedBigInteger("category_id");
            $table->longText("note");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("update_user_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consignations');
    }
}
