<?php

namespace Insyht\Larvelous;

use Illuminate\Support\ServiceProvider;
use Insyht\Larvelous\Console\Install;

class LarvelousServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/../resources/js' => public_path('js/insyht/larvelous'),
                __DIR__ . '/../config/insyht-larvelous.php' => config_path('insyht-larvelous.php'),
            ],
            'insyht-larvelous-shop'
        );

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'insyht-larvelous');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'insyht-larvelous');

        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                    Install::class,
                ]
            );
        }
    }
}
