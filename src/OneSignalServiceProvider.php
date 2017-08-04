<?php

namespace Alexander\OneSignalApiLaravel;

use Illuminate\Support\ServiceProvider;

class OneSignalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('notification', function($app)
        {
            OneSignalNotification::createInstance();
        });
    }
}
