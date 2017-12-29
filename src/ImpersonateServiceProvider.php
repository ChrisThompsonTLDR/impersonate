<?php

namespace Christhompsontldr\Impersonate;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Christhompsontldr\Impersonate\Commands\PublishCommand;
use Christhompsontldr\Impersonate\Commands\SetupCommand;
use Christhompsontldr\Impersonate\Commands\AddTraitCommand;

class ImpersonateServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $router->pushMiddlewareToGroup(config('impersonate.routes.middlewareGroup', 'web'), \Christhompsontldr\Impersonate\Http\Middleware\Impersonate::class);

        if (!$this->app->routesAreCached()) {
            $this->setupRoutes($this->app->router);
        }

        //  create the commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishCommand::class,
                SetupCommand::class,
                AddTraitCommand::class,
            ]);
        }

        //  this is used by the PublishCommand
        $this->publishes([
            realpath(dirname(__DIR__) . '/config/impersonate.php') => config_path('impersonate.php'),
        ], 'impersonateconfig');

        $this->loadViewsFrom(realpath(dirname(__DIR__) . '/views'), 'impersonate');
    }

    /**
     * Define the routes for the package.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Christhompsontldr\Impersonate\Http\Controllers'], function($router)
        {
            require __DIR__ . '/routes/web.php';
        });
    }

    public function register()
    {
        //  make the config available even if not published
        $this->mergeConfigFrom(
            realpath(dirname(__DIR__)) . '/config/impersonate.php', 'impersonate'
        );
    }
}






