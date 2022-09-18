<?php

namespace App\Providers;

use App\helper\Invoice;
use App\Models\User;
use App\Models\DocumentVente;
use App\Models\PricingSuplier;
use Illuminate\Support\Facades\Gate;
use App\Policies\PricingSupplierPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // \App\Models\User::class => \App\Policies\UserPolicy::class,
        PricingSuplier::class => PricingSupplierPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('super admin') ? true : null;
        });

        Gate::define('cancel-doc-vente', function (User $user, DocumentVente $docVente) {
            if($user->hasRole("admin")){
                if (
                    $docVente->status == Invoice::STATUS["paid"] ||
                    $docVente->status == Invoice::STATUS["incomplete"]
                ) {
                    return false;
                }
                return true;
            }

            return false;
        });
    }
}
