<?php

namespace App\Providers;

use App\Repositories\Contracts\UserAuthRepositoryInterface;
use App\Repositories\Eloquent\UserAuthRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserAuthRepositoryInterface::class, UserAuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
