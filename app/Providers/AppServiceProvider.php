<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\UserService;

use App\Repositories\Car\CarRepository;
use App\Repositories\Car\CarRepositoryInterface;
use App\Services\CarService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
        $this->app->bind(CarService::class, function ($app) {
            return new CarService($app->make(CarRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
