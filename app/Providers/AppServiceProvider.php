<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;
use Illuminate\Pagination\Paginator;
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
        if (!Cache::has('roles')) {
            Cache::put('roles', [
                'admin' => 1,  // admin role ID
                'user' => 2,   // user role ID
                // Add other roles here as needed
            ], 60); // Cache for 60 minutes
        }
        // Admin directive, like @auth
        Blade::if('admin', fn() : bool => is_admin());

        // Vite aliases
        Vite::macro('logo', fn(string $asset) => $this->asset("resources/images/logo/{$asset}"));
        Vite::macro('image', fn(string $asset) => $this->asset("resources/images/{$asset}"));
        Vite::macro('background', fn(string $asset) => $this->asset("resources/images/backgrounds/{$asset}"));
        Vite::macro('icon', fn(string $asset) => $this->asset("resources/images/icons/{$asset}"));

        //insert view -> this view show bar of numbers under each table.
        // Paginator::defaultView('');
    }
}
