<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_number")->nullable();
            $table->unsignedBigInteger("article_type");
            $table->unsignedBigInteger("article_reference");
            $table->unsignedBigInteger("saleable_id")->nullable();
            $table->string("saleable_type")->nullable();
            $table->unsignedBigInteger("category_id");
            $table->integer("quantity")->comment("quantité d'article");
             $table->boolean("isWithEmballage")->default(false);
            // $table->integer("consignation_id")->comment("produit a consigner");
            // $table->integer("consigned_bottle")->comment("quantité produit a consiger");
           
            // $table->boolean("withBottle");
            // $table->integer("deconsignation_id")->nullable()->comment("produit a deconsigner");
            //  $table->integer("received_bottle")->nullable()->comment("quantité emballge reçu");
            
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
        Schema::dropIfExists('sales');
    }
}
