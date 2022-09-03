<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal("wholesale_price",10,2)->after("price")->comment("Prix de gros");
            $table->integer("unity")->after("wholesale_price");
            $table->integer("package_type")->after("unity")->comment("Type de Collisage D'Article");
            $table->unsignedBigInteger("contenance")->after("package_type")->nullable()->comment("Nombre de colisage");
            $table->unsignedBigInteger("condition")->after("contenance")->nullable();
            $table->bigInteger("simple_package")->after("condition")->nullable();
            $table->bigInteger("big_package")->after("simple_package")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn("wholesale_price");
            $table->dropColumn("unity");
            $table->dropColumn("package_type");
            $table->dropColumn("contenance");
            $table->dropColumn("condition");
            $table->dropColumn("simple_package");
            $table->dropColumn("big_package");
        });
    }
}
