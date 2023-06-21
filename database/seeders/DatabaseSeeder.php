<?php

namespace Database\Seeders;

use Database\Seeders\Pages\CategoryPageSeeder;
use Database\Seeders\Pages\HomePageSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CmsSeeder::class);
        $this->call(HomePageSeeder::class);
        $this->call(CategoryPageSeeder::class);

        // todo This should be loaded dynamically, in a nicer way, for every module
        require_once __DIR__ . '/../../vendor/insyht/larvelous-base-blocks/database/seeders/DatabaseSeeder.php';
        require_once __DIR__ . '/../../vendor/insyht/larvelous-base-blocks/database/seeders/UserSeeder.php';
        require_once __DIR__ . '/../../vendor/insyht/larvelous-base-blocks/database/seeders/home/BlockTemplateSeeder.php';
        require_once __DIR__ . '/../../vendor/insyht/larvelous-base-blocks/database/seeders/home/BlockVariableValueSeeder.php';
        require_once __DIR__ . '/../../vendor/insyht/larvelous-base-blocks/database/seeders/category/BlockTemplateSeeder.php';
        require_once __DIR__ . '/../../vendor/insyht/larvelous-base-blocks/database/seeders/category/BlockVariableValueSeeder.php';
        \Illuminate\Support\Facades\Artisan::call(
            'migrate',
            ['--path' => 'vendor/insyht/larvelous-base-blocks/database/migrations', '--force' => true]
        );
        $this->call(\Iws\Database\Seeders\DatabaseSeeder::class);
    }
}
