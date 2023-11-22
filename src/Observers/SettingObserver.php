<?php

namespace Insyht\Larvelous\Observers;

use Artisan;
use Insyht\Larvelous\Models\Setting;

class SettingObserver
{
    public function updated(Setting $setting): void
    {
        $colorSettings = [
            Setting::COLOR_PRIMARY,
            Setting::COLOR_PRIMARY_TEXT,
            Setting::COLOR_PRIMARY_LIGHT,
            Setting::COLOR_SECONDARY,
            Setting::COLOR_SECONDARY_TEXT,
            Setting::COLOR_SECONDARY_LIGHT,
            Setting::COLOR_TERTIARY,
            Setting::COLOR_TERTIARY_TEXT,
            Setting::COLOR_TERTIARY_LIGHT,
            Setting::COLOR_BLACK,
            Setting::COLOR_WHITE,
        ];

        if (in_array($setting->name, $colorSettings)) {
            $filename = Setting::CUSTOM_COLORS_PATH;
            $sass = '$primary: %s;' . PHP_EOL .
                    '$primary-text: %s;' . PHP_EOL .
                    '$primary-light: %s;' . PHP_EOL . PHP_EOL .

                    '$secondary: %s;' . PHP_EOL .
                    '$secondary-text: %s;' . PHP_EOL .
                    '$secondary-light: %s;' . PHP_EOL . PHP_EOL .

                    '$tertiary: %s;' . PHP_EOL .
                    '$tertiary-text: %s;' . PHP_EOL .
                    '$tertiary-light: %s;' . PHP_EOL . PHP_EOL .

                    '$black: %s;' . PHP_EOL .
                    '$white: %s;';
            $sass = sprintf(
                $sass,
                Setting::where('name', Setting::COLOR_PRIMARY)->first()->value,
                Setting::where('name', Setting::COLOR_PRIMARY_TEXT)->first()->value,
                Setting::where('name', Setting::COLOR_PRIMARY_LIGHT)->first()->value,
                Setting::where('name', Setting::COLOR_SECONDARY)->first()->value,
                Setting::where('name', Setting::COLOR_SECONDARY_TEXT)->first()->value,
                Setting::where('name', Setting::COLOR_SECONDARY_LIGHT)->first()->value,
                Setting::where('name', Setting::COLOR_TERTIARY)->first()->value,
                Setting::where('name', Setting::COLOR_TERTIARY_TEXT)->first()->value,
                Setting::where('name', Setting::COLOR_TERTIARY_LIGHT)->first()->value,
                Setting::where('name', Setting::COLOR_BLACK)->first()->value,
                Setting::where('name', Setting::COLOR_WHITE)->first()->value,
            );

            file_put_contents($filename, $sass);
            Artisan::queue('larvelous:reset-colors');
        }
    }
}
