<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerUpdateScreensPolicies();
        $this->registerLocationPolicies();

    }

    public function registerUpdateScreensPolicies()
    {

        Gate::define('update-screens', function (\App\User $user) {
            return $user->hasAccess(['update-screens']);
        });
    }

    public function registerLocationPolicies()
    {
        
        Gate::define('list-locations', function (\App\User $user) {
            return $user->hasAccess(['list-locations']);
        });

        Gate::define('create-locations', function (\App\User $user) {
            return $user->hasAccess(['create-locations']);
        });

        Gate::define('view-locations', function (\App\User $user) {
            return $user->hasAccess(['view-locations']);
        });

        Gate::define('edit-locations', function (\App\User $user) {
            return $user->hasAccess(['edit-locations']);
        });

        Gate::define('destroy-locations', function (\App\User $user) {
            return $user->hasAccess(['destroy-locations']);
        });

    }
}