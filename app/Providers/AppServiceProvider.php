<?php

namespace App\Providers;

use App\Models\Plugin;
use Illuminate\Support\ServiceProvider;

use const DIRECTORY_SEPARATOR;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $migrationPaths = [];

        foreach (Plugin::active()->get() as $plugin) {
            $migrationPaths[] = base_path() . DIRECTORY_SEPARATOR
                                . 'vendor' . DIRECTORY_SEPARATOR
                                . $plugin->path . DIRECTORY_SEPARATOR
                                . 'database' . DIRECTORY_SEPARATOR . 'migrations';
        }

        if (!empty($migrationPaths)) {
            $this->loadMigrationsFrom($migrationPaths);
        }
    }
}
