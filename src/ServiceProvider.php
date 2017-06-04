<?php

namespace LaravelVersio;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        /*
         * Publish configuration file
         */
        $this->publishes([
            __DIR__ . '/../config/versio.php' => config_path('versio.php'),
        ]);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('LaravelVersio', 'LaravelVersio\Facade');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        config([
            'config/versio.php',
        ]);

        $this->app->singleton('laravel-versio', function ($app) {
            return new LaravelVersio;
        });
    }
}
