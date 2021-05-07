<?php

namespace App\Providers;

use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ProductService::class, function ($app) {
            return new ProductService();
        });

    }

    public function boot()
    {
        //
    }
}
