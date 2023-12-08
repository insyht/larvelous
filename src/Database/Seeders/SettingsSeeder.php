<?php

namespace Insyht\Larvelous\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::create(['name' => Setting::COLOR_PRIMARY, 'value' => '#f546aa']);
        Setting::create(['name' => Setting::COLOR_PRIMARY_TEXT, 'value' => 'white']);
        Setting::create(['name' => Setting::COLOR_PRIMARY_LIGHT, 'value' => '#ffe9f6']);
        Setting::create(['name' => Setting::COLOR_SECONDARY, 'value' => '#f762b7']);
        Setting::create(['name' => Setting::COLOR_SECONDARY_TEXT, 'value' => 'white']);
        Setting::create(['name' => Setting::COLOR_SECONDARY_LIGHT, 'value' => '#f499cc']);
        Setting::create(['name' => Setting::COLOR_TERTIARY, 'value' => '#f546aa']);
        Setting::create(['name' => Setting::COLOR_TERTIARY_TEXT, 'value' => 'white']);
        Setting::create(['name' => Setting::COLOR_TERTIARY_LIGHT, 'value' => '#ffe9f6']);
        Setting::create(['name' => Setting::COLOR_BLACK, 'value' => '#ffe9f6']);
        Setting::create(['name' => Setting::COLOR_WHITE, 'value' => 'white']);
    }
}










