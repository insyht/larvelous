<?php

namespace Insyht\Larvelous\CoreOverrides;

use Illuminate\Support\Facades\Log;

class BladeCompiler extends \Illuminate\View\Compilers\BladeCompiler
{
    /**
     * Prepend the active theme's namespace if that theme has an override for that template.
     * If not, do the same but use the default theme.
     *
     * @param string $expression
     *
     * @return string
     */
    protected function compileExtends($expression)
    {
        // If no namespace is given, use the active theme namespace (with a fallback to the default theme namespace)
        if (strpos($expression, '::') === false) {
            $template = substr($expression, 2, -2);
            $activeThemeTemplate = app('activeTheme')->blade_prefix . '::' . $template;
            $defaultThemeTemplate = app('defaultTheme')->blade_prefix . '::' . $template;

            if (app()->bound('activeTheme') && app('activeTheme') && view()->exists($activeThemeTemplate)) {
                Log::debug(
                    sprintf(
                        'Prefixing template "%s" with namespace "%s" from active theme: %s',
                        $template,
                        app('activeTheme')->blade_prefix,
                        sprintf("('%s::%s')", app('activeTheme')->blade_prefix, $template)
                    )
                );
                $expression = sprintf("('%s::%s')", app('activeTheme')->blade_prefix, $template);
            } elseif (view()->exists($defaultThemeTemplate)) {
                Log::debug(
                    sprintf(
                        'Prefixing template "%s" with namespace "%s" from default theme: %s',
                        $template,
                        app('defaultTheme')->blade_prefix,
                        sprintf("('%s::%s')", app('activeTheme')->blade_prefix, $template)
                    )
                );
                $expression = sprintf("('%s::%s')", app('defaultTheme')->blade_prefix, $template);
            }
        }

        return parent::compileExtends($expression);
    }

    /**
     * Prepend the active theme's namespace if that theme has an override for that template.
     * If not, do the same but use the default theme.
     *
     * @param string $expression
     *
     * @return string
     */
    protected function compileInclude($expression)
    {
        // If no namespace is given, use the active theme namespace (with a fallback to the default theme namespace)
        if (strpos($expression, '::') === false) {
            $template = substr($expression, 2, -2);
            $activeThemeTemplate = app('activeTheme')->blade_prefix . '::' . $template;
            $defaultThemeTemplate = app('defaultTheme')->blade_prefix . '::' . $template;

            if (app()->bound('activeTheme') && app('activeTheme') && view()->exists($activeThemeTemplate)) {
                $expression = sprintf("('%s::%s')", app('activeTheme')->blade_prefix, $template);
            } elseif (view()->exists($defaultThemeTemplate)) {
                $expression = sprintf("('%s::%s')", app('defaultTheme')->blade_prefix, $template);
            }
        }

        return parent::compileInclude($expression);
    }
}
