<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin", "as" => "admin."], function () {
    Route::resource('achat-fournisseurs', App\Http\Controllers\admin\achat\AchatFournisseurController::class);
    Route::get(
        "achat-fournisseurs/{invoice_number}/print",
        [App\Http\Controllers\admin\achat\AchatFournisseurController::class, "print"]
    )->name("achat-fournisseurs.print");
    Route::delete(
        "achat-fournisseurs/{invoice_number}/cancel",
        [App\Http\Controllers\admin\achat\AchatFournisseurController::class, "cancel"]
    )->name("achat-fournisseurs.cancel");
});
