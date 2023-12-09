<?php

namespace Insyht\Larvelous\Providers;

use Illuminate\Support\ServiceProvider;
use Insyht\Larvelous\Console\Commands\ResetColors;
use Insyht\Larvelous\Console\Install;
use Insyht\Larvelous\Models\BlockVariableValue;
use Insyht\Larvelous\Models\Page;
use Insyht\Larvelous\Models\Setting;
use Insyht\Larvelous\Search\Interfaces\SearchInterface;

class LarvelousServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([ResetColors::class]);
    }

    public function boot()
    {
        if (!file_exists(Setting::CUSTOM_COLORS_PATH)) {
            file_put_contents(Setting::CUSTOM_COLORS_PATH, '');
        }

        $this->publishes(
            [
                __DIR__ . '/../../public/images' => public_path('images'),
                __DIR__ . '/../../config/insyht-larvelous.php' => config_path('insyht-larvelous.php'),
                __DIR__ . '/../../public/vendor/insyht/larvelous' => public_path('vendor/insyht/larvelous'),
                __DIR__ . '/../../database/migrations/add_iws_admin_user.php.stub' => $this->generateMigrationName('add_iws_admin_user.php'),
            ],
            'insyht-larvelous'
        );

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'insyht-larvelous');

        if (app()->bound('defaultTheme') && app('defaultTheme')) {
            $this->loadViewsFrom(
                base_path() . '/vendor/' . app('defaultTheme')->path,
                strtolower(str_replace('\\', '-', app('defaultTheme')->namespace))
            );
        }
        if (app()->bound('activeTheme') && app('activeTheme')) {
            $this->loadViewsFrom(
                base_path() . '/vendor/' . app('activeTheme')->path,
                strtolower(str_replace('\\', '-', app('activeTheme')->namespace))
            );
        }

        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                    Install::class,
                ]
            );
        }

        app(SearchInterface::class)->addSearchable(new Page());
        app(SearchInterface::class)->addSearchable(new BlockVariableValue());
    }

    protected function generateMigrationName(string $originalName): string
    {
        return public_path('../database/migrations/') . substr(date('Y_m_d_His') . '_' . $originalName, 0, -4);
    }
}
