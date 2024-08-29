<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $permissions = \App\Models\Permission::all();

        foreach($permissions as $permission) {
            Gate::define($permission->slug, function($user) use ($permission) {
                $return = false;
                foreach ($permission->role as $role) {
                    $return = $user->hasRole($role->name);
                    if($return) break;
                }
                return $return;
            });
        }
    }
}
