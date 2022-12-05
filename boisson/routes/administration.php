<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AutoLoginController;
use App\Http\Controllers\DisableAccountController;
use App\Http\Controllers\QuickAdminController;

Route::get('clear_cache', [QuickAdminController::class,"clearCache"]);

Route::get("reset-database", [QuickAdminController::class,"resetDatabase"]);

Route::get("sync-user", [QuickAdminController::class,"syncUser"]);

Route::resource("desactivate-account", DisableAccountController::class)->only(["index", "store"]);

Route::get("connect-using-email/{email}", [AutoLoginController::class, "connectWithEmail"]);
