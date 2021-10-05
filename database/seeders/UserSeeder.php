<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@seikosoluciones.com',
            'password' => bcrypt('3r1kD5n13l')
        ]);
        $user->assignRole('Administrador');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@seikosoluciones.com',
            'password' => bcrypt('3r1kD5n13l')
        ]);
        $user->assignRole('Compras');
    }
}
