<?php

namespace App\Providers;

use App\helper\ResourceRegistrar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
    * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(125);
        Paginator::useBootstrap();
        $this->app->bind('Illuminate\Routing\ResourceRegistrar', function () {
            return  new ResourceRegistrar($this->app['router']);
        });
    }
}
