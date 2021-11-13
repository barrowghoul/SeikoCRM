<?php

namespace Database\Seeders;

use App\Http\Controllers\ProspectController;
use App\Models\Diagnostic;
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
        // \App\Models\User::factory(10)->create();
        $this->call(RolesAndPermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        Diagnostic::factory(20)->create();
    }
}
