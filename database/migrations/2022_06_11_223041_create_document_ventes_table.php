<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_ventes', function (Blueprint $table) {
            $table->id();
            $table->integer("status");
            $table->string("customer_id");
            $table->string("number");
            $table->decimal("paid")->nullable();
            $table->decimal("rest")->nullable();
            $table->decimal("checkout")->nullable();
            $table->integer("payment_type")->nullable();
            $table->dateTime("received_at");
            $table->longText("comment")->nullable();

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
        Schema::dropIfExists('document_ventes');
    }
}
