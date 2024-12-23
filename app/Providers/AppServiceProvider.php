<?php

namespace App\Providers;

use App\Models\Tahun;
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
        View::share('tahunAktif', Tahun::where('status', true)->first() ?? null);
        View::share('photoFront', WebSetting::first()?->photo_front ?? null);
        View::share('photoLogin', WebSetting::first()?->photo_login ?? null);
    }
}
