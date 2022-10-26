<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin", "as" => "admin.", "middleware" => "can:view_intern_doc"], function () {
    Route::resource('achat-fournisseurs', App\Http\Controllers\admin\achat\AchatFournisseurController::class);
    Route::group(["prefix" => "achat-fournisseurs", "as" => "achat-fournisseurs."], function () {
        Route::get(
            "achat-fournisseurs/{invoice_number}/print",
            [App\Http\Controllers\admin\achat\AchatFournisseurController::class, "print"]
        )->name("print");
        Route::get(
            "achat-fournisseurs/{invoice_number}/telecharger",
            [App\Http\Controllers\admin\achat\AchatFournisseurController::class, "download"]
        )->name("download");
        Route::delete(
            "achat-fournisseurs/{invoice_number}/cancel",
            [App\Http\Controllers\admin\achat\AchatFournisseurController::class, "cancel"]
        )->name("cancel");

        Route::post("achat-fournisseurs-auto", [
            App\Http\Controllers\admin\achat\AchatFournisseurController::class,
            "saveAutoStock"
        ])->name("saveAutoStock");
    });
    Route::get("achat-produits/payment/{invoice_number}", [\App\Http\Controllers\admin\payment\PaymentController::class, "achatPaymentForm"])
        ->name("achat.paymentForm");
    Route::post("achat-produits/payment/{invoice_number}", [\App\Http\Controllers\admin\payment\PaymentController::class, "achatPaymentStore"])
        ->name("achat.paymentStore");
});
