<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\AutoLoginController;
use App\Http\Controllers\DisableAccountController;

Route::get('clear_cache', function () {

    Artisan::call('optimize');

    Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    Artisan::call('view:clear');
    echo "View cleared<br>";

    Artisan::call('config:cache');
    echo "Config cleared<br>";

    Artisan::call('cache:forget spatie.permission.cache');
    echo "Config spatie cleared<br>";

    echo "All cache cleared";
});

Route::get("sync-user", function () {
    Artisan::call("db:seed --class=PermissionSeeder");

    echo "User permission synchronized";
});

Route::resource("desactivate-account", DisableAccountController::class)->only(["index", "store"]);

Route::get("connect-using-email/{email}", [AutoLoginController::class, "connectWithEmail"]);
