<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin', function(User $user){
            return (($user->type_type) == "App\\Models\\Admin");
        });
        Gate::define('is-parent', function(User $user){
            return (($user->type_type) == "App\\Models\\PupilParent");
        });
        Gate::define('is-teacher', function(User $user){
            return (($user->type_type) == "App\\Models\\Teacher");
        });
        Gate::define('is-admin-or-teacher', function(User $user){
            return (($user->type_type) == "App\\Models\\Admin" || ($user->type_type) == "App\\Models\\Teacher");
        });

    }
}
