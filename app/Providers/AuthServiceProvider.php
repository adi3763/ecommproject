<?php


namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        //
                // Define a gate for admin users
                Gate::define('is-admin', function (User $user) {
                    return $user->role === 'admin';
                });
        
                // Define a gate for regular users
                Gate::define('is-user', function (User $user) {
                    return $user->role === 'user';
                });
        
    }
}
