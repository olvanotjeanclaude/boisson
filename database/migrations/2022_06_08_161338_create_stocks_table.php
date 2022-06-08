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
            $table->string("invoice_number");
            $table->unsignedBigInteger("article_type");
            $table->unsignedBigInteger("article_id");
            $table->unsignedBigInteger("category_id");
            $table->integer("quantity")->comment("quantité produit");
            $table->decimal("buying_price")->comment("prix d'achat");
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
