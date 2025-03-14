<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
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
        // GATES

        // Define a gate that checks if the user is an admin
        Gate::define('admin', function () {
            return auth()->user()->role === 'admin';
        });

        // Define a gate that checks if the user is an rh
        Gate::define('rh', function () {
            return auth()->user()->role === 'rh';
        });

        Route::model('user', User::class);
    }
}
