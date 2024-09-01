<?php

namespace App\Providers;
//interfaces

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\CategoryRepository;
//Eloquents
use App\Repositories\Eloquent\UserAuthRepository;
use App\Repositories\Eloquent\AdminAuthRepository;
use App\Repositories\Eloquent\OrderItemRepository;
use App\Repositories\Eloquent\ManageUsersRepository;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Eloquent\ShippingAddressRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\UserAuthRepositoryInterface;
use App\Repositories\Contracts\AdminAuthRepositoryInterface;
use App\Repositories\Contracts\OrderItemRepositoryInterface;
use App\Repositories\Contracts\ManageUsersRepositoryInterface;
use App\Repositories\Contracts\ShippingAddressRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //user interface and reposiory bind
        $this->app->bind(UserAuthRepositoryInterface::class, UserAuthRepository::class);
        //admin interface and repo bind
        $this->app->bind(AdminAuthRepositoryInterface::class, AdminAuthRepository::class);
        //bind category interfave and implemenet class
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        //product interface binding
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ManageUsersRepositoryInterface::class, ManageUsersRepository::class);
        //carts binding
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);

        // Bind repository interfaces to implementations
        $this->app->bind(ShippingAddressRepositoryInterface::class, ShippingAddressRepository::class);
        // Bind repository interfac
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        // Bind repository interfaces
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
