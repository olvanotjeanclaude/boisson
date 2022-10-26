<?php

use App\Models\Stock;
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
            $table->integer("status")->default(Stock::STATUS["accepted"])->after("id");
            $table->string("invoice_number")->after("status")->nullable();

            $table->unsignedBigInteger("supplier_id")->after("stockable_type")->nullable();
            $table->string("reference_facture")->after("supplier_id")->nullable()->comment("N®Facture n'a Bl fournisseur");
          
            $table->bigInteger("out")->after("entry")->default(0)->comment("quantité a sorti");
            $table->integer("action_type")->after("inventory_id")->default(Stock::ACTION_TYPES["new_stock"])->comment("type d'action");
            $table->text("comment")->after("action_type")->comment("commentaire");
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
            $table->dropColumn("status");
            $table->dropColumn("invoice_number");
            $table->dropColumn("supplier_id");
            $table->dropColumn("reference_facture");
            $table->dropColumn("out");
            $table->dropColumn("action_type");
            $table->dropColumn("comment");
        });
    }
}
