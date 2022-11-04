<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        protected $policies = [
            Post::class => PostPolicy::class,
          ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-tags', function($user){
            return $user->roles()->where('name', 'admin')->count() > 0;
        });
        Gate::define('admin', function($user){
            return $user->roles()->where('name', 'admin')->count() > 0;
        });
        Gate::define('moderator', function($user){
            return $user->roles()->where('name', 'moderator')->count() > 0;
        });
    }
}
