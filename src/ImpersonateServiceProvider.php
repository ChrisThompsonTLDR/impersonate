<?php

namespace Christhompsontldr\Impersonate;

use Christhompsontldr\Impersonate\Http\Middleware\Impersonate;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class ImpersonateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->appendMiddlewareToGroup(config('impersonate.routes.middlewareGroup'), Impersonate::class);

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->publishes([
            dirname(__DIR__) . '/config/impersonate.php' => config_path('impersonate.php'),
        ]);

        $this->loadViewsFrom(dirname(__DIR__) . '/views', 'impersonate');

        $this->publishes([
            dirname(__DIR__) . '/views' => resource_path('views/vendor/impersonate'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/config/impersonate.php', 'impersonate'
        );
    }
}






