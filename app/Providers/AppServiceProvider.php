<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\KendaraanRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\KendaraanRepository::class, function ($app) {
            return new \App\Repositories\KendaraanRepository(new \App\Models\Kendaraan());
        });

        $this->app->bind(\App\Repositories\MobilRepository::class, function ($app) {
            return new \App\Repositories\MobilRepository(new \App\Models\Mobil());
        });

        $this->app->bind(\App\Repositories\MotorRepository::class, function ($app) {
            return new \App\Repositories\MotorRepository(new \App\Models\Motor());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
