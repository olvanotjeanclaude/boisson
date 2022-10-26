<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_number");
            $table->string("reference")->nullable();
            $table->integer("article_type")->nullable();
            $table->unsignedBigInteger("category_id")->nullable();
            $table->text("designation");
            $table->integer("quantity_type")->nullable();
            $table->integer("quantity_type_value")->nullable();
            $table->integer("contenance")->nullable();
            $table->integer("quantity_bottle")->nullable();
            $table->integer("unity")->nullable();
            $table->decimal("unit_price")->nullable();
            $table->decimal("buying_price")->nullable();
            $table->decimal("detail_price")->nullable()->comment("prix detail");
            $table->decimal("wholesale_price")->nullable()->comment("Prix de gros");
            $table->unsignedBigInteger("supplier_id")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("user_update_id")->nullable();
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
        Schema::dropIfExists('articles');
    }
}
