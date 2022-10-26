<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmballagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emballages', function (Blueprint $table) {
            $table->id();
            $table->string("reference");
            $table->string("designation");
            $table->decimal("price")->comment("Prix unitaire de vente");
            $table->unsignedBigInteger("content_id")->nullable();
            $table->unsignedBigInteger("quantity");
            $table->boolean("simpleOrGroup");
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
        Schema::dropIfExists('emballages');
    }
}
