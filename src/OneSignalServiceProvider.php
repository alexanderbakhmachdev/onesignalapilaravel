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
        $configPath = __DIR__ . '/../config/onesignal.php';
        $this->publishes([$configPath => config_path('onesignal.php')], 'config');
        $this->mergeConfigFrom($configPath, 'onesignal');
        if ( class_exists('Laravel\Lumen\Application') ) {
            $this->app->configure('onesignal');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('notification', function($app){
            $config = isset($app['config']['services']['onesignal']) ? $app['config']['services']['onesignal'] : null;
            if (is_null($config)) {
                $config = $app['config']['onesignal'] ?: $app['config']['onesignal::config'];
            }
            return OneSignalNotification::createInstance()->withConfig($config);
        });
    }
}
