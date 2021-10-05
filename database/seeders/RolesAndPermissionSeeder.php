<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Crear permisos
        Permission::create(['name' => 'ver roles', 'description' => 'Permite acceso a visualizar el listado de roels']);
        Permission::create(['name' => 'editar roles', 'description' => 'Permite editar roles, agregar quitar permisos']);
        Permission::create(['name' => 'crear roles', 'description' => 'Permite la creación de nuevos roles']);
        Permission::create(['name' => 'ver usuarios', 'description' => 'Permite acceso a visualizar el lsitado de usuarios']);
        Permission::create(['name' => 'crear usuarios', 'description' => 'Permite la creación de usuarios']);
        Permission::create(['name' => 'editar usuarios', 'description' => 'Permite modificar la información de perfiles de usuario']);
        Permission::create(['name' => 'suspender usuarios', 'description' => 'Permite suspender usuarios']);

        //Crear Roles
        $role = Role::create(['name' => 'Administrador', 'description' => 'Acceso a todos los módulos del sistema, puede crear, editar y/o eliminar registros de sistema.'])->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'Compras', 'description' => 'Acceso al módulo de compras y todas las operaciones relacionadas con el departamento'])->givePermissionTo(['ver usuarios','crear usuarios', 'editar usuarios']);
    }
}
