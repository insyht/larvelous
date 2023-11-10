<?php

namespace Insyht\Larvelous\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Schema;
use Insyht\Larvelous\Models\Plugin;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;

use Insyht\Larvelous\Models\Theme;
use const DIRECTORY_SEPARATOR;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('defaultTheme', function (Application $app) {
            return Theme::where('name', 'Default')->where('namespace', 'Insyht\Larvelous')->first();
        });
        $this->app->singleton('activeTheme', function (Application $app) {
            $activeTheme = Theme::active()->first();
            if (!$activeTheme) {
                $activeTheme = app('defaultTheme');
            }

            return $activeTheme;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $migrationPaths = [];
        $languagePaths = [];

        if (Schema::hasTable('plugins')) {
            foreach (Plugin::active()->get() as $plugin) {
                $migrationPaths[] = base_path() . DIRECTORY_SEPARATOR
                                    . 'vendor' . DIRECTORY_SEPARATOR
                                    . $plugin->path . DIRECTORY_SEPARATOR
                                    . 'database' . DIRECTORY_SEPARATOR . 'migrations';

                /** @var string $key */
                $key = str_replace('/', '-', $plugin->path);
                $languagePaths[$key] = base_path() . DIRECTORY_SEPARATOR
                                    . 'vendor' . DIRECTORY_SEPARATOR
                                    . $plugin->path . DIRECTORY_SEPARATOR
                                    . 'resources' . DIRECTORY_SEPARATOR . 'lang';
            }
        }
        if (!empty($migrationPaths)) {
            $this->loadMigrationsFrom($migrationPaths);
        }

        foreach ($languagePaths as $namespace => $languagePath) {
            Lang::addNamespace($namespace, $languagePath);
        }
    }
}
