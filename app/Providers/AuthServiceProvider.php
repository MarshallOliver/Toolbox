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
        $this->registerLocationDatabasePolicies();
<<<<<<< HEAD
        $this->registerSignPolicies();
=======
>>>>>>> 265320a05eed5b6e7498355e80ab419581b2b41e

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

    public function registerLocationDatabasePolicies()
    {
        
        Gate::define('create-databases', function (\App\User $user) {
            return $user->hasAccess(['create-databases']);
        });

        Gate::define('edit-databases', function (\App\User $user) {
            return $user->hasAccess(['edit-databases']);
        });

        Gate::define('destroy-databases', function (\App\User $user) {
            return $user->hasAccess(['destroy-databases']);
        });
    
    }
<<<<<<< HEAD

    public function registerSignPolicies()
    {

        Gate::define('list-signs', function (\App\User $user) {
            return $user->hasAccess(['list-signs']);
        });

        Gate::define('create-signs', function (\App\User $user) {
            return $user->hasAccess(['create-signs']);
        });

        Gate::define('view-signs', function (\App\User $user) {
            return $user->hasAccess(['view-signs']);
        });

        Gate::define('edit-signs', function (\App\User $user) {
            return $user->hasAccess(['edit-signs']);
        });

        Gate::define('destroy-signs', function (\App\User $user) {
            return $user->hasAccess(['destroy-signs']);
        });

    }
=======
>>>>>>> 265320a05eed5b6e7498355e80ab419581b2b41e
}