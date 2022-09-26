<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix" =>"admin","as" =>"admin."],function(){
    Route::resource('achat-fournisseurs', App\Http\Controllers\admin\achat\AchatFournisseurController::class);
});