<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("number");
            $table->boolean("is_valid")->default(false);
            $table->unsignedBigInteger("customer_id")->nullable();
            $table->unsignedBigInteger("invoiceable_id");
            $table->unsignedBigInteger("invoiceable_type");
            $table->longText("note")->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
