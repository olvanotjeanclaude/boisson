<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/link-storage", function () {
    //dd(storage_path('app/public'), public_path('storage'));
    File::link(storage_path('app/public'), public_path('storage'));
    return "Symbolik link created";
});

Route::get('clear_cache', function () {

    Artisan::call('optimize');

    Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    Artisan::call('view:clear');
    echo "View cleared<br>";

    Artisan::call('config:cache');
    echo "Config cleared<br>";

    dd("Cache is cleared");
});

Route::redirect("/", "/admin");

Auth::routes();

Route::group(["prefix" => "admin", "as" => "admin.", "middleware" => "auth"], function () {
    Route::get("/", [\App\Http\Controllers\admin\AdminController::class, "index"])->name("index");
    Route::resource("utlisateurs", \App\Http\Controllers\admin\users\UserController::class);
    Route::resource("fournisseurs", \App\Http\Controllers\admin\supplier\SupplierController::class);
    // Route::resource("produits",\App\Http\Controllers\admin\product\ProductController::class);
    Route::resource("category-articles", \App\Http\Controllers\admin\article\CategoryArticleController::class);

    Route::post("pre-save-articles", [\App\Http\Controllers\admin\article\ArticleController::class, "preSaveArticle"])->name("article.preSaveArticle");
    Route::post("pre-save-invoice-articles", [\App\Http\Controllers\admin\article\ArticleController::class, "preSaveInvoiceArticle"])->name("article.preSaveInvoiceArticle");

    Route::resource("articles", \App\Http\Controllers\admin\article\ArticleController::class);
    Route::resource("tarif-fournisseurs", \App\Http\Controllers\admin\produit\PricingSupplierController::class)->except("show");

    Route::resource("achat-produits", \App\Http\Controllers\admin\article\PurchaseProductController::class);
    Route::resource("stocks", \App\Http\Controllers\admin\article\StockController::class)->except(["create"]);

    Route::group(["prefix" => "produits", "as" => "approvisionnement."], function () {
        Route::resource("articles", \App\Http\Controllers\admin\produit\ProductController::class);
        Route::resource("emballages", \App\Http\Controllers\admin\produit\EmballageController::class);
        Route::resource("packages", \App\Http\Controllers\admin\produit\PackageController::class);
    });

    Route::group(["prefix" => "impression", "as" => "print."], function () {
      Route::get("vente/{invoice_number}",[\App\Http\Controllers\admin\impression\ImpressionController::class,"printSale"])->name("sale");
      Route::get("vente/{invoice_number}/terminer",[\App\Http\Controllers\admin\impression\ImpressionController::class,"saleTerminate"])->name("sale.terminate");
      Route::get("achat/{invoice_number}",[\App\Http\Controllers\admin\impression\ImpressionController::class,"printAchat"])->name("achat");
      Route::get("achat/{invoice_number}/terminer",[\App\Http\Controllers\admin\impression\ImpressionController::class,"achatTerminate"])->name("achat.terminate");
    });

    Route::resource("ventes", \App\Http\Controllers\admin\sale\SaleController::class);
    Route::get("ventes/payment/{invoice_number}",[\App\Http\Controllers\admin\payment\PaymentController::class,"paymentForm"])->name("sale.paymentForm");
    Route::post("ventes/payment/{invoice_number}",[\App\Http\Controllers\admin\payment\PaymentController::class,"paymentStore"])->name("sale.paymentStore");
    Route::get("achat-produits/payment/{invoice_number}",[\App\Http\Controllers\admin\payment\PaymentController::class,"achatPaymentForm"])->name("achat.paymentForm");
    Route::post("achat-produits/payment/{invoice_number}",[\App\Http\Controllers\admin\payment\PaymentController::class,"achatPaymentStore"])->name("achat.paymentStore");

    Route::post("pre-save-ventes", [\App\Http\Controllers\admin\sale\SaleController::class, "preSaveVente"])->name("ventes.preSaveVente");
    Route::post("pre-save-invoice-ventes", [\App\Http\Controllers\admin\sale\SaleController::class, "preSaveInvoiceVente"])->name("ventes.preSaveInvoiceVente");

    Route::resource("factures", \App\Http\Controllers\admin\invoice\InvoiceController::class);

    Route::resource("clients", \App\Http\Controllers\admin\customer\CustomerController::class);
    Route::resource("achat-fournisseurs", \App\Http\Controllers\admin\achat\AchatFournisseurController::class);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
