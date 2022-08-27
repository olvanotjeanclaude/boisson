<?php

use App\Models\Inventory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string("unique_id");
            $table->integer("status")->default(Inventory::STATUS["pending"]);
            $table->unsignedBigInteger("article_reference");
            $table->unsignedBigInteger("inventorieable_id");
            $table->string("inventorieable_type");

            $table->date("date");
            $table->integer("real_quantity")->comment("quantité réelle");
            $table->bigInteger("difference");
            $table->longText("motif")->nullable();

            $table->unsignedBigInteger("user_id");
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
        Schema::dropIfExists('inventories');
    }
}
