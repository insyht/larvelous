<?php

namespace Insyht\Larvelous\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Database\Seeders\Home\BlockTemplateSeeder as HomeBlockTemplateSeeder;
use Insyht\Larvelous\Database\Seeders\Home\BlockVariableValueSeeder as HomeBlockVariableValueSeeder;
use Insyht\Larvelous\Database\Seeders\Category\BlockTemplateSeeder as CategoryBlockTemplateSeeder;
use Insyht\Larvelous\Database\Seeders\Category\BlockVariableValueSeeder as CategoryBlockVariableValueSeeder;
use Insyht\Larvelous\Database\Seeders\Pages\CategoryPageSeeder;
use Insyht\Larvelous\Database\Seeders\Pages\HomePageSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CmsSeeder::class);
        $this->call(HomePageSeeder::class);
        $this->call(CategoryPageSeeder::class);

        $this->call(UserSeeder::class);
        // Homepage
        $this->call(HomeBlockTemplateSeeder::class);
        $this->call(HomeBlockVariableValueSeeder::class);
        // Category page
        $this->call(CategoryBlockTemplateSeeder::class);
        $this->call(CategoryBlockVariableValueSeeder::class);

        // todo Load the seeders for every module
        // $this->call(\Insyht\Package\Database\Seeders\DatabaseSeeder::class);
    }
}
