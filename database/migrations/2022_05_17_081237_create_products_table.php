<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("reference");
            $table->unsignedBigInteger("supplier_id");
            $table->string("name");
            $table->decimal("wholesale_price")->comment("Prix de gros");
            $table->decimal("retail_price")->comment("Prix detail");
            $table->integer("type")->nullable()->comment("type");
            $table->decimal("consignment_price");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("update_user_id");
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
        Schema::dropIfExists('products');
    }
}
