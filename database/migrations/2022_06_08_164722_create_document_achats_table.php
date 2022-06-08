<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_achats', function (Blueprint $table) {
            $table->id();
            $table->integer("status");
            $table->string("reference");
            $table->string("number");
            $table->unsignedBigInteger("supplier_id");
            $table->decimal("paid");
            $table->decimal("rest");
            $table->integer("payment_type");
            $table->date("received_at");
            $table->longText("comment")->nullable();
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
        Schema::dropIfExists('document_achats');
    }
}
