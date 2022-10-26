<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string("reference");
            $table->string("designation");
            $table->unsignedBigInteger("product_id");
            $table->integer("contenance");
            $table->decimal("price")->comment("Prix de vente, pris de gros");
            $table->unsignedBigInteger("category_id");
            $table->longText("note")->nullable();
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
        Schema::dropIfExists('packages');
    }
}
