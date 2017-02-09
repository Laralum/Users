<?php

namespace Laralum\Users;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'laralum_users');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
