<?php

namespace Insyht\Larvelous\CoreOverrides;

use Illuminate\Support\Facades\Log;
use Illuminate\View\Factory;
use Insyht\Larvelous\Models\Plugin;

class LarvelousViewFactory extends Factory
{
    public function make($view, $data = [], $mergeData = [])
    {
        if (!str_contains($view, '::')) {
            $namespace = $this->determineNamespace($view);
            if ($namespace !== '') {
                $view = $namespace . '::' . $view;
            }
        }

        return parent::make($view, $data, $mergeData);
    }

    protected function determineNamespace(string $view): string
    {
        $namespace = '';

        foreach (Plugin::all() as $plugin) {
            $pluginNamespace = str_replace('/', '-', $plugin->path);
            if (view()->exists($pluginNamespace . '::' . $view)) {
                Log::debug(
                    sprintf(
                        'Prefixing template "%s" with namespace "%s" from plugin "%s": %s',
                        $view,
                        $pluginNamespace,
                        $plugin->name,
                        sprintf("('%s::%s')", $pluginNamespace, $view)
                    )
                );

                return $pluginNamespace;
            }
        }

        if (app()->bound('activeTheme') && app('activeTheme')) {
            $activeThemeTemplate = app('activeTheme')->blade_prefix . '::' . $view;
            if (view()->exists($activeThemeTemplate)) {
                Log::debug(
                    sprintf(
                        'Prefixing template "%s" with namespace "%s" from active theme: %s',
                        $view,
                        app('activeTheme')->blade_prefix,
                        sprintf("('%s::%s')", app('activeTheme')->blade_prefix, $view)
                    )
                );
                $namespace = app('activeTheme')->blade_prefix;
            }
        } elseif (!view()->exists($view)) {
            $defaultThemeTemplate = app('defaultTheme')->blade_prefix . '::' . $view;
            if (!view()->exists($defaultThemeTemplate)) {
                Log::warning(
                    sprintf(
                        'Failed to find view "%s"',
                        $view
                    )
                );
                app()->abort(404);
            }

        }

        return $namespace;
    }
}