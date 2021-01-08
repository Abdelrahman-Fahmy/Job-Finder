<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

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

        //

        Gate::define('admin',function($user){
            return ($user->user_type === 2);
        });
        Gate::define('employer',function($user){
            return ($user->user_type === 0);
        });
        Gate::define('employee',function($user){
            return ($user->user_type === 1);
        });
        Gate::define('notadmin',function($user){
            return ($user->user_type != 2);
        });

        Passport::routes();
    }
}
