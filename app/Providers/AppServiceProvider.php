<?php

namespace App\Providers;

use App\Repositories\Contracts\AdminAuthRepositoryInterface;
use App\Repositories\Contracts\UserAuthRepositoryInterface;
use App\Repositories\Eloquent\AdminAuthRepository;
use App\Repositories\Eloquent\UserAuthRepository;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
