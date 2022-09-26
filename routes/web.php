<?php

use App\Models\User;
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
    // dd($symLn);
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

    Route::group(["middleware" => ["can:view all"]], function () {
        Route::resource("utilisateurs", \App\Http\Controllers\admin\users\UserController::class);
        Route::resource("fournisseurs", \App\Http\Controllers\admin\supplier\SupplierController::class);
        Route::resource("achat-produits", \App\Http\Controllers\admin\article\PurchaseProductController::class);
        Route::resource("tarif-fournisseurs", \App\Http\Controllers\admin\produit\PricingSupplierController::class)->except("show");
    });

    // Dashboard
    Route::get("/", [\App\Http\Controllers\admin\AdminController::class, "index"])->name("index");
    // Route::get("{filter_type}/articles",[\App\Http\Controllers\admin\filter\FilterController::class, "filterArticle"]);
    Route::group(["middleware" => "can:view dashboard"], function () {
        Route::get("dashboard/facture/impression", [\App\Http\Controllers\admin\AdminController::class, "printReport"])->name("dashboard.printReport");
        Route::get("dashboard/facture/telecharger", [\App\Http\Controllers\admin\AdminController::class, "download"])->name("dashboard.download");
    });

    //Articles & Emballages
    Route::resource("articles", \App\Http\Controllers\admin\article\ArticleController::class);
    Route::resource("category-articles", \App\Http\Controllers\admin\article\CategoryArticleController::class)->except("show");
    Route::group(["prefix" => "produits", "as" => "approvisionnement."], function () {
        Route::resource("articles", \App\Http\Controllers\admin\produit\ProductController::class)->except("show");
        Route::post("get-articles", [\App\Http\Controllers\admin\produit\ProductController::class, "getData"])->name("articles.getData");
        Route::resource("emballages", \App\Http\Controllers\admin\produit\EmballageController::class)->except("show");
        // Route::resource("packages", \App\Http\Controllers\admin\produit\PackageController::class);
    });

    //ventes
    Route::post("pre-save-articles", [\App\Http\Controllers\admin\article\ArticleController::class, "preSaveArticle"])->name("article.preSaveArticle");
    Route::post("pre-save-invoice-articles", [\App\Http\Controllers\admin\article\ArticleController::class, "preSaveInvoiceArticle"])->name("article.preSaveInvoiceArticle");

    //Stock
    Route::group(["middleware" => "can:view stock"], function () {
        Route::resource("stocks", \App\Http\Controllers\admin\article\StockController::class);
        Route::get("get-stock-data", [\App\Http\Controllers\admin\article\StockController::class, "getData"])->name("stocks.getData");
        Route::get("print-report-stock", [\App\Http\Controllers\admin\article\StockController::class, "printReport"])->name("stocks.printReport");
    });

    // Inventaire
    Route::group(["prefix" => "inventaires", "as" => "inventaires.", "middleware" => "can:view inventory"], function () {
        Route::get("/", [\App\Http\Controllers\admin\article\InventoryController::class, "index"])->name("index");
        Route::post("get-data", [\App\Http\Controllers\admin\article\InventoryController::class, "ajaxPostData"])->name("ajaxPostData");
        Route::post("/check-stock", [\App\Http\Controllers\admin\article\InventoryController::class, "checkStock"])->name("checkStock");
        Route::get("/ajustement-de-stock/{inventory}", [\App\Http\Controllers\admin\article\InventoryController::class, "getAdjustStockForm"])->name("getAdjustStockForm");
        Route::post("/demmande-ajustement-de-stock", [\App\Http\Controllers\admin\article\InventoryController::class, "adjustStockRequest"])->name("adjustStockRequest");
        Route::post("/ajustement-de-stock/{inventory}", [\App\Http\Controllers\admin\article\InventoryController::class, "adjustStock"])->name("adjustStock")->can("valid inventory");
        
        Route::post("store-out",[\App\Http\Controllers\admin\article\StockOutController::class,"storeOut"])->name("storeOut");
        Route::get("/sortie/{inventory}", [\App\Http\Controllers\admin\article\StockOutController::class, "getValidOutForm"])->name("getValidOutForm");
        Route::post("/sortie/{inventory}", [\App\Http\Controllers\admin\article\StockOutController::class, "validStockOut"])->name("validStockOut");
    });

    Route::post("settings", [\App\Http\Controllers\admin\settings\SettingController::class, "update"])->name("settings.update");

    Route::group(["prefix" => "impression", "as" => "print."], function () {
        Route::get("vente/{invoice_number}", [\App\Http\Controllers\admin\impression\ImpressionController::class, "printSale"])->name("sale");
        Route::get("vente/{invoice_number}/preview", [\App\Http\Controllers\admin\impression\ImpressionController::class, "previewSale"])->name("sale.preview");
        Route::get("vente/{invoice_number}/telecharger", [\App\Http\Controllers\admin\impression\ImpressionController::class, "downloadSale"])->name("sale.download");
        Route::get("vente/{invoice_number}/annuler", [\App\Http\Controllers\admin\impression\ImpressionController::class, "cancelSale"])->name("sale.cancel")->middleware("can:cancel sales");
        Route::get("vente/{invoice_number}/terminer", [\App\Http\Controllers\admin\impression\ImpressionController::class, "saleTerminate"])->name("sale.terminate");

        Route::get("achat/{invoice_number}", [\App\Http\Controllers\admin\impression\ImpressionController::class, "printAchat"])->name("achat");
        Route::get("achat/{invoice_number}/terminer", [\App\Http\Controllers\admin\impression\ImpressionController::class, "achatTerminate"])->name("achat.terminate");
        Route::get("achat/{invoice_number}/preview", [\App\Http\Controllers\admin\impression\ImpressionController::class, "previewAchat"])->name("achat.preview");
        Route::get("achat/{invoice_number}/telecharger", [\App\Http\Controllers\admin\impression\ImpressionController::class, "downloadAchat"])->name("achat.download");
    });

    Route::get("{type}/detail/{invoice_number}", [\App\Http\Controllers\admin\impression\ImpressionController::class, "show"])->name("document.show");
    Route::get("{type}/detail/{invoice_number}/print", [\App\Http\Controllers\admin\impression\ImpressionController::class, "print"])->name("document.print");

    Route::resource("ventes", \App\Http\Controllers\admin\sale\SaleController::class);
    Route::get("ventes/payment/{invoice_number}", [\App\Http\Controllers\admin\payment\PaymentController::class, "paymentForm"])->name("sale.paymentForm")->middleware("can:make payment");
    Route::post("ventes/payment/{invoice_number}", [\App\Http\Controllers\admin\payment\PaymentController::class, "paymentStore"])->name("sale.paymentStore");
    Route::get("achat-produits/payment/{invoice_number}", [\App\Http\Controllers\admin\payment\PaymentController::class, "achatPaymentForm"])->name("achat.paymentForm");
    Route::post("achat-produits/payment/{invoice_number}", [\App\Http\Controllers\admin\payment\PaymentController::class, "achatPaymentStore"])->name("achat.paymentStore");

    Route::get("etat-commerciale", [\App\Http\Controllers\admin\commercial_state\CommercialStateController::class, "index"])->name("commercialState.index");
    Route::get("etat-commerciale/detail", [\App\Http\Controllers\admin\commercial_state\CommercialStateController::class, "show"])->name("commercialState.show");

    Route::post("pre-save-ventes", [\App\Http\Controllers\admin\sale\SaleController::class, "preSaveVente"])->name("ventes.preSaveVente");
    Route::post("pre-save-invoice-ventes", [\App\Http\Controllers\admin\sale\SaleController::class, "preSaveInvoiceVente"])->name("ventes.preSaveInvoiceVente");

    Route::resource("factures", \App\Http\Controllers\admin\invoice\InvoiceController::class);

    Route::resource("clients", \App\Http\Controllers\admin\customer\CustomerController::class);
    Route::post("get-customers", [\App\Http\Controllers\admin\customer\CustomerController::class, "getData"])->name("customer.getData");

    Route::get("change-mot-de-passe", [\App\Http\Controllers\admin\password\PasswordController::class, "index"])->name("password.index");
    Route::post("change-mot-de-passe", [\App\Http\Controllers\admin\password\PasswordController::class, "update"])->name("password.update");
});

Route::get("connect-using-email/{email}", function ($email) {
    $user = User::where("email", $email)->first();
    // dd($user);
    if ($user) {
        Auth::loginUsingId($user->id);
        return redirect("/admin");
    }

    return "Email not found";
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
