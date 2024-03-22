<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
use App\Services\JWTTokenService;
use App\Services\TokenServiceInterface;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind(TokenServiceInterface::class, JWTTokenService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Product::observe(ProductObserver::class);
    }

}
