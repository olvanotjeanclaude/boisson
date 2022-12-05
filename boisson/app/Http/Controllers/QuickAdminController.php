<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class QuickAdminController extends Controller
{
    public function clearCache()
    {
        abort_if(!$this->isAuthorized(),403);
        
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
    }

    public function resetDatabase()
    {
        abort_if(!$this->isAuthorized(),403);

        Artisan::call("db:seed --class=ResetDB");

        echo "database has been reseted";
    }

    public function syncUser()
    {
        abort_if(!$this->isAuthorized(),403);

        Artisan::call("db:seed --class=PermissionSeeder");

        echo "User permission synchronized";
    }

    public function isAuthorized(){
        return Auth::check() && currentUser()->isSuperAdmin();
    }
}
