<?php

namespace App\Providers;

use App\Interfaces\Repositories\FoodRepositoryInterface;
use App\Interfaces\Repositories\IngredientRepositoryInterface;
use App\Interfaces\Repositories\OrderRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\FoodRepository;
use App\Repositories\IngredientRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class BindRepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IngredientRepositoryInterface::class, IngredientRepository::class);
        $this->app->bind(FoodRepositoryInterface::class, FoodRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
