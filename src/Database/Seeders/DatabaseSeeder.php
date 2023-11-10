<?php

namespace Insyht\Larvelous\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Insyht\Larvelous\Database\Seeders\Home\BlockTemplateSeeder as HomeBlockTemplateSeeder;
use Insyht\Larvelous\Database\Seeders\Home\BlockVariableValueSeeder as HomeBlockVariableValueSeeder;
use Insyht\Larvelous\Database\Seeders\Category\BlockVariableValueSeeder as CategoryBlockVariableValueSeeder;
use Insyht\Larvelous\Database\Seeders\Pages\CategoryPageSeeder;
use Insyht\Larvelous\Database\Seeders\Pages\HomePageSeeder;
use Insyht\Larvelous\Database\Seeders\Pages\LandingPageSeeder;
use Insyht\Larvelous\Database\Seeders\Pages\TextPageSeeder;
use Insyht\Larvelous\Models\Plugin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(HomePageSeeder::class);
        $this->call(CmsSeeder::class);
        $this->call(CategoryPageSeeder::class);
        $this->call(TextPageSeeder::class);
        $this->call(LandingPageSeeder::class);
        $this->call(ThemeSeeder::class);

        $this->call(UserSeeder::class);
        // Homepage
        $this->call(HomeBlockTemplateSeeder::class);
        $this->call(HomeBlockVariableValueSeeder::class);
        // Category page
        $this->call(CategoryBlockVariableValueSeeder::class);

        // Load the seeder(s) of every module
        if (Schema::hasTable('plugins')) {
            foreach (Plugin::active()->get() as $plugin) {
                $namespace = $plugin->namespace . '\\Database\\Seeders\\DatabaseSeeder';
                if (class_exists($namespace)) {
                    $this->call($namespace);
                }
            }
        }
    }
}
