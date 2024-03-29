<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string("article_reference");
            $table->unsignedBigInteger("stockable_id");
            $table->string("stockable_type");
            // $table->unsignedBigInteger("initial");
            $table->bigInteger("entry")->default(0)->nullable();
            $table->unsignedBigInteger("user_id");
            $table->date("date")->default(date("Y-m-d"));
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
        Schema::dropIfExists('stocks');
    }
}
