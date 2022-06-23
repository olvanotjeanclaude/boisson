<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_orders', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_number")->nullable();
            $table->unsignedBigInteger("supplier_id");
            $table->string("article_reference");
            
            $table->unsignedBigInteger("article_id")->nullable();
            $table->string("article_type")->nullable();
    
            $table->integer("quantity")->comment("quantité d'article");
             $table->boolean("isWithEmballage")->default(false);
            
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
        Schema::dropIfExists('supplier_orders');
    }
}
