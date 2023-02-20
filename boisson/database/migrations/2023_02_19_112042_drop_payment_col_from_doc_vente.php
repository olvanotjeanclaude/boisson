<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPaymentColFromDocVente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_ventes', function (Blueprint $table) {
            $table->dropColumn("status");
            $table->dropColumn("paid");
            $table->dropColumn("checkout");
            $table->dropColumn("payment_type");
            $table->dropColumn("comment");
            $table->dropColumn("update_user_id");
            $table->date("received_at")->nullable()->after("user_id")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_ventes', function (Blueprint $table) {
            $table->integer("status");
            $table->decimal("paid")->nullable();
            $table->decimal("checkout")->nullable();
            $table->integer("payment_type")->nullable();
            $table->longText("comment")->nullable();
            $table->unsignedBigInteger("update_user_id")->nullable();
            $table->dateTime("reveived_at")->after("user_id")->nullable()->change();
        });
    }
}
