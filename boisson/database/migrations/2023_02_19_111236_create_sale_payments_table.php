<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("invoice_number")->nullable();
            $table->decimal("paid")->nullable();
            $table->decimal("checkout")->nullable();
            $table->integer("payment_type")->nullable();
            $table->longText("comment")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->date("received_at");
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
        Schema::dropIfExists('sale_payments');
    }
}
