<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TypeRepository::class, \App\Repositories\TypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RequestRepository::class, \App\Repositories\RequestRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ItemRepository::class, \App\Repositories\ItemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PendingRepository::class, \App\Repositories\PendingRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AprovedRepository::class, \App\Repositories\AprovedRepositoryEloquent::class);
        //:end-bindings:
    }
}
