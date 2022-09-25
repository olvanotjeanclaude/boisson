<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingSupliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_supliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("supplier_id");
            $table->string("article_reference");
            $table->unsignedBigInteger("article_id");
            $table->string("article_type");
            $table->decimal("buying_price")->comment("prix d'achat");
            $table->longText("note")->nullable();
            $table->unsignedInteger("user_id");
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
        Schema::dropIfExists('pricing_supliers');
    }
}
