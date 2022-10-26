<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean("status")->default(true)->comment("0-Actif 1-Passif");
            $table->string("permission_access")->default(rand(3, 4))->comment("1->Super Admin | 2->Admin | 3->Facturation 1 | 4->...");

            //Genel bilgileri
            $table->string('name');
            $table->string("surname");
            $table->string("identity_number")->nullable()->comment("CIN");
            $table->date("birth_date")->nullable();
            $table->string('email')->unique();
            $table->string("phone")->comment("giriş yapacak kullanıcının telefon numarası");
            
            $table->string("image")->nullable()->comment("photo de profil");

            //Adres bilgileri
            $table->string("address")->nullable()->comment("Adres");

            //Şifre
            $table->string('password');

            $table->text("note")->nullable()->comment("description de l'utilisateur");

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
        Schema::dropIfExists('users');
    }
}
