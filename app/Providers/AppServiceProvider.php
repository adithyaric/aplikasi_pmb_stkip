<?php

namespace App\Providers;

use App\Models\WebSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('photoFront', WebSetting::first()?->photo_front);
        View::share('photoLogin', WebSetting::first()?->photo_login);
    }
}
