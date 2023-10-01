<?php

namespace Insyht\Larvelous\Providers;

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
                __DIR__ . '/../../public/images' => public_path('storage/images'),
                __DIR__ . '/../../config/insyht-larvelous.php' => config_path('insyht-larvelous.php'),
                __DIR__ . '/../../public/vendor/insyht/larvelous' => public_path('vendor/insyht/larvelous'),
                __DIR__ . '/../../public/vendor/insyht/larvelous/database/migrations/add_iws_admin_user.php.stub' => $this->generateMigrationName('add_iws_admin_user.php'),
            ],
            'insyht-larvelous'
        );

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'insyht-larvelous');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'insyht-larvelous');

        $this->publishes([
                             __DIR__ . '/../database/migrations/create_permission_tables.php.stub' => $this->getMigrationFileName(
                                 'create_permission_tables.php'
                             ),
                         ], 'permission-migrations');

        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                    Install::class,
                ]
            );
        }
    }

    protected function generateMigrationName(string $originalName): string
    {
        return public_path('../database/migrations/') . substr(date('Y_m_d_His') . '_' . $originalName, 0, -4);
    }
}
