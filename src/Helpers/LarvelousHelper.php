<?php

namespace Insyht\Larvelous\Helpers;

use Illuminate\Support\Facades\Artisan;
use Insyht\Larvelous\Models\Menu;
use Insyht\Larvelous\Models\Plugin;

class LarvelousHelper
{
    public function getMenu(string $position)
    {
        return Menu::where('position', $position)->first();
    }

    public function deletePlugin(Plugin $plugin): bool
    {
        $success = true;

        if (class_exists(sprintf('%s\Console\UninstallPlugin', $plugin->namespace))) {
            $success = $success && Artisan::call(sprintf('%s\Console\UninstallPlugin', $plugin->namespace));
        }

        $success = $success && app(PackageHelper::class)->deletePackage($plugin->path);

        return $success;
    }
}
