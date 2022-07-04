<?php

namespace Database\Seeders;

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

        // todo This should be loaded dynamically, in a nicer way, for every module
        require_once __DIR__ . '/../../vendor/iws/database/seeders/DatabaseSeeder.php';
        require_once __DIR__ . '/../../vendor/iws/database/seeders/BlockTemplateSeeder.php';
        require_once __DIR__ . '/../../vendor/iws/database/seeders/BlockVariableValueSeeder.php';
        require_once __DIR__ . '/../../vendor/iws/database/seeders/UserSeeder.php';
        \Illuminate\Support\Facades\Artisan::call(
            'migrate', ['--path' => 'vendor/iws/database/migrations', '--force' => true]
        );
        $this->call(\Iws\Database\Seeders\DatabaseSeeder::class);
    }
}
