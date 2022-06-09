<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_number")->nullable();
            $table->unsignedBigInteger("article_type");
            $table->unsignedBigInteger("article_reference");
            $table->unsignedBigInteger("stockable_id")->nullable();
            $table->string("stockable_type")->nullable();
            $table->unsignedBigInteger("category_id");
            $table->integer("quantity")->comment("quantité produit");
            $table->decimal("buying_price")->comment("prix d'achat");
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
        Schema::dropIfExists('stocks');
    }
}
