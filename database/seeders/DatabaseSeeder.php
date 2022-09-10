<?php

namespace Database\Seeders;

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

        // todo This should be loaded dynamically, in a nicer way, for every module
        require_once __DIR__ . '/../../vendor/iws/database/seeders/DatabaseSeeder.php';
        require_once __DIR__ . '/../../vendor/iws/database/seeders/UserSeeder.php';
        require_once __DIR__ . '/../../vendor/iws/database/seeders/home/BlockTemplateSeeder.php';
        require_once __DIR__ . '/../../vendor/iws/database/seeders/home/BlockVariableValueSeeder.php';
        \Illuminate\Support\Facades\Artisan::call(
            'migrate', ['--path' => 'vendor/iws/database/migrations', '--force' => true]
        );
        $this->call(\Iws\Database\Seeders\DatabaseSeeder::class);
    }
}
