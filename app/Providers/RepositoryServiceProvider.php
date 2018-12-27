<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class repositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\UserRepository', 'App\Repositories\UserRepositoryEloquent');
        $this->app->bind('App\Repositories\CategoryRepository', 'App\Repositories\CategoryRepositoryEloquent');
        //:end-bindings:
    }
}
