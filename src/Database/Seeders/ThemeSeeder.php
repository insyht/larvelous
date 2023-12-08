<?php

namespace Insyht\Larvelous\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\Theme;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        Theme::create(
            [
                'name' => 'Default',
                'path' => 'insyht/larvelous/resources/views',
                'namespace' => 'Insyht\Larvelous',
                'github_url' => '',
                'image' => 'images/larvelous-theme.jpg',
                'active' => true,
                'author' => 'insyht',
            ]
        );
    }
}
