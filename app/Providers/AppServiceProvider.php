<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MercadoPago\SDK;

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
        SDK::setAccessToken('TEST-1530488659488383-070501-a7091210b8912a88cdb4ed0621ad1806-195782699');
    }
}
