<?php

namespace Insyht\Larvelous\Providers;

use Illuminate\Support\ServiceProvider;
use Insyht\Larvelous\Console\Commands\ResetColors;
use Insyht\Larvelous\Console\Commands\UpdateLarvelous;
use Insyht\Larvelous\Console\Install;
use Insyht\Larvelous\CoreOverrides\LarvelousViewFactory;
use Insyht\Larvelous\Models\BlockVariableValue;
use Insyht\Larvelous\Models\Page;
use Insyht\Larvelous\Models\Setting;
use Insyht\Larvelous\Search\Interfaces\SearchInterface;

class LarvelousServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([ResetColors::class, UpdateLarvelous::class]);
    }

    public function boot()
    {
        if (!file_exists(Setting::CUSTOM_COLORS_PATH)) {
            file_put_contents(Setting::CUSTOM_COLORS_PATH, '');
        }

        if (file_exists(__DIR__ . '/../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')) {
            copy(
                __DIR__ . '/../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
                __DIR__ . '/../../resources/js/bootstrap.bundle.min.js'
            );
        }

        $this->publishes(
            [
                __DIR__ . '/../../resources/js' => public_path() . '/../resources/js',
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

        $this->app->singleton('view', function ($app) {
            // Override the default View Factory so that we can prefix the right namespace to every view
            $factory = new LarvelousViewFactory($app['view.engine.resolver'], $app['view.finder'], $app['events']);

            $factory->setContainer($app);
            $factory->share('app', $app);

            return $factory;
        });
    }

    protected function generateMigrationName(string $originalName): string
    {
        return public_path('../database/migrations/') . substr(date('Y_m_d_His') . '_' . $originalName, 0, -4);
    }
}
