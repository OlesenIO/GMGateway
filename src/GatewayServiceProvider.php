<?php

namespace OlesenIO\GMGateway;

use Illuminate\Support\ServiceProvider;

class GatewayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'GMGateway');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'GMGateway');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('GMGateway.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/GMGateway'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/GMGateway'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/GMGateway'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'GMGateway');

        // Register the main class to use with the facade
        $this->app->singleton('GMGateway', function () {
            return new GMGateway;
        });
    }
}
