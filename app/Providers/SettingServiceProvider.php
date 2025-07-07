<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting; // Import the Setting model
use View; 

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Share the settings with all views
        // View::share('settings', Setting::first());
        View::share('settings', Setting::first());
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
