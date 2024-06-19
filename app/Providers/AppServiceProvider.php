<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Should return TRUE or FALSE
        Gate::define('manage_users', function(User $user) {
            return $user->hasAnyRole('Admin', 'Staff', 'Client');
        });

//        Gate::define('can delete admin', function(User $loggedInUser, User $userToDelete) {
//            return $loggedInUser->hasRole('Admin') && $loggedInUser->id !== $userToDelete->id;
//        });
//
//        Gate::define('can delete staff', function(User $loggedInUser, User $userToDelete) {
//            return $loggedInUser->hasRole('Admin') && $userToDelete->hasRole('Staff');
//        });
//
//        Gate::define('can delete client', function(User $loggedInUser, User $userToDelete) {
//            return ($loggedInUser->hasRole('Admin') || $loggedInUser->hasRole('Staff')) && $userToDelete->hasRole('Client');
//        });
    }
}
