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
            'name' => 'Omar Garcia',
            'email' => 'omar.garcia@seikosoluciones.com',
            'password' => bcrypt('seiko123')
        ]);
        $user->assignRole('Auxiliar Administrativo');
        $user = User::create([
            'name' => 'Nestor Barcenas',
            'email' => 'nestor.barcenas@seikosoluciones.com',
            'password' => bcrypt('seiko123')
        ]);
        $user->assignRole('Ventas');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@seikosoluciones.com',
            'password' => bcrypt('3r1kD5n13l')
        ]);
        $user->assignRole('Compras');

        $user = User::create([
            'name' => 'procesos',
            'email' => 'procesos@metalboss.com.mx',
            'password' => bcrypt('metalboss')
        ]);
        $user->assignRole('Administrador');

        $user = User::create([
            'name' => 'Paola',
            'email' => 'paola@metalboss.com.mx',
            'password' => bcrypt('metalboss')
        ]);
        $user->assignRole('Ventas');
    }
}
