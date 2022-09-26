<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaseOrderColToStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->string("invoice_number")->after("id")->nullable();

            $table->unsignedBigInteger("supplier_id")->after("stockable_type")->nullable();
            $table->unsignedBigInteger("pricing_id")->after("supplier_id")->nullable();
            $table->boolean("isWithEmballage")->after("pricing_id")->nullable();

            $table->integer("out")->after("entry")->comment("quantité a sorti");
            $table->integer("action_type")->after("inventory_id")->comment("type d'action");
            $table->boolean("is_pending")->after("action_type")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn("invoice_number");
            $table->dropColumn("supplier_id");
            $table->dropColumn("pricing_id");
            $table->dropColumn("out");
            $table->dropColumn("isWithEmballage");
            $table->dropColumn("action_type");
            $table->dropColumn("is_pending");
        });
    }
}
