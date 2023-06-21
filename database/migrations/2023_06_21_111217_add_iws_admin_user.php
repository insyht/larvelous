<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Editor']);

        $user = new User();
        $user->password = Hash::make(Str::password());
        $user->email = 'accounts@insyht.nl';
        $user->name = 'IWS';
        $user->save();
        $user->assignRole('Admin');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('name', 'IWS')->first()->delete();
        Role::where('name', 'Admin')->first()->delete();
        Role::where('name', 'Editor')->first()->delete();
    }
};
