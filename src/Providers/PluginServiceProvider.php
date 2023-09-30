<?php

namespace Insyht\Larvelous\Providers;

use Illuminate\Support\Facades\Schema;
use Insyht\Larvelous\Models\Plugin;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

use const DIRECTORY_SEPARATOR;

class PluginServiceProvider extends ServiceProvider
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
        if (Schema::hasTable('plugins')) {
            foreach (Plugin::active()->get() as $plugin) {
                $pathToServiceProvider = base_path() . DIRECTORY_SEPARATOR
                                    . 'vendor' . DIRECTORY_SEPARATOR
                                    . $plugin->path . DIRECTORY_SEPARATOR
                                    . 'Providers' . DIRECTORY_SEPARATOR . 'PluginServiceProvider.php';
                if (file_exists($pathToServiceProvider)) {
                    require_once $pathToServiceProvider;
                    $namespace = $plugin->namespace . '\Providers\PluginServiceProvider';
                    App::register($namespace);
                }
            }
        }
    }
}
