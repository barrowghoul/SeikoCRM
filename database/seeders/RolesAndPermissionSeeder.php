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
        Permission::create(['name' => 'ver clientes', 'description' => 'Permite acceso a vizualisar el listado de clientes']);
        Permission::create(['name' => 'editar clientes', 'description' => 'Permite acceso a editar la informacón de clientes']);
        Permission::create(['name' => 'crear clientes', 'description' => 'Permite la creación de clientes']);
        Permission::create(['name' => 'aprobar clientes', 'description' => 'Permite la aprobación de clientes nuevos']);
        Permission::create(['name' => 'aprobar prospectos', 'description' => 'Permite la aprobación de prospectos nuevos']);
        Permission::create(['name' => 'rechazar prospectos', 'description' => 'Permite el rechazo  de prospectos nuevos']);
        Permission::create(['name' => 'ver prospectos', 'description' => 'Permite acceso a visualizar el listado de prospectos de clientes']);
        Permission::create(['name' => 'editar prospectos', 'description' => 'Permite acceso a editar la informacón de prospectos']);
        Permission::create(['name' => 'crear prospectos', 'description' => 'Permite la creació de prospectos']);
        Permission::create(['name' => 'ver diagnosticos', 'description' => 'Permite ver el listado de diagnósticos de clientes']);
        Permission::create(['name' => 'crear diagnosticos', 'description' => 'Permite crear diagnósticos de clientes']);
        Permission::create(['name' => 'editar diagnosticos', 'description' => 'Permite editar diagnósticos de clientes']);
        Permission::create(['name' => 'aprobar diagnosticos', 'description' => 'Permite aprobar diagnósticos de clientes']);

        //Crear Roles
        $role = Role::create(['name' => 'Administrador', 'description' => 'Acceso a todos los módulos del sistema, puede crear, editar y/o eliminar registros de sistema.'])->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'Compras', 'description' => 'Acceso al módulo de compras y todas las operaciones relacionadas con el departamento'])->givePermissionTo(['ver usuarios','crear usuarios', 'editar usuarios']);        
        $role = Role::create(['name' => 'Auxiliar Administrativo', 'description' => 'Auxiliar Admin'])->givePermissionTo(['ver prospectos','crear prospectos', 'editar prospectos','aprobar prospectos', 'rechazar prospectos']);        
        $role = Role::create(['name' => 'Ventas', 'description' => 'Ventas'])->givePermissionTo(['ver prospectos','crear prospectos', 'editar prospectos', 'ver diagnosticos', 'crear diagnosticos', 'editar diagnosticos']);        
        $role = Role::create(['name' => 'Gerente de Ventas', 'description' => 'Ventas'])->givePermissionTo(['ver prospectos','crear prospectos', 'editar prospectos', 'ver diagnosticos', 'aprobar diagnosticos']);
    }
}
