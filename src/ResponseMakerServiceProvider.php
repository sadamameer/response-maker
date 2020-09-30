<?php

namespace Laracodes\ResponseMaker;
use Illuminate\Support\ServiceProvider;

class ResponseMakerServiceProvider extends ServiceProvider{
    
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/config/ResponseMaker.php' => config_path('ResponseMaker.php')
        ], 'config');
    
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');

        // $this->publishes([
        //     __DIR__.'/assets' => public_path('vendor/ResponseMaker'),
        // ], 'public');

        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('ResponseMakerMiddleware', ResponseMakerMiddleware::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/ResponseMaker.php', 'rm'
        );
    }
}