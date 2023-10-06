<?php

namespace Insyht\Larvelous\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $query = 'INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
                    VALUES
	                    (1,
	                     "Jordy",
	                     "jordythijs@gmail.com",
	                     NULL,
	                     "$2y$10$k5eKWTa/gb6J0RRIkh.5t.UORg.B2rijQKCRVGxgbb1Xh1iWl33.i",
	                     NULL,
	                     "2021-10-24 18:36:46",
	                     "2021-10-24 18:36:46"
                     );';
        DB::statement($query);

    }
}
