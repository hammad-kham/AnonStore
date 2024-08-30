<?php

namespace App\Providers;
//interfaces
use App\Repositories\Contracts\AdminAuthRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\UserAuthRepositoryInterface;
//Eloquents
use App\Repositories\Eloquent\AdminAuthRepository;
use App\Repositories\Eloquent\CategoryRepository;
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
        //bind category interfave and implemenet class
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
