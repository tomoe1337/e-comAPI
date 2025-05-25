<?php

namespace App\Providers;

use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Services\Orders\OrderService;
use App\Services\Payment\PaymentService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepository::class, CartRepository::class);
        $this->app->bind(OrderRepository::class, OrderRepository::class);
        $this->app->bind(ProductRepository::class, ProductRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
