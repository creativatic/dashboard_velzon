<?php
// database/seeders/RolesAndPermissionsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpieza previa
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 🔹 Crear permisos
        $permissions = [
            // Dashboard
            'ver dashboard',
            
            // Usuarios
            'ver usuarios',
            'crear usuario',
            'editar usuario',
            'eliminar usuario',
            
            // Roles
            'ver roles',
            'crear rol',
            'editar rol',
            'eliminar rol',
            
            // Permisos
            'ver permisos',
            'crear permiso',
            'editar permiso',
            'eliminar permiso',
            
            // Otras funcionalidades (puedes ampliar según necesites)
            'gestionar usuarios',
            'gestionar roles',
            'gestionar permisos',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission],
                ['guard_name' => 'web']
            );
        }

        // 🔹 Crear roles
        $admin = Role::firstOrCreate(
            ['name' => 'Administrador'],
            ['guard_name' => 'web']
        );
        
        $contador = Role::firstOrCreate(
            ['name' => 'Contador'],
            ['guard_name' => 'web']
        );

        // 🔹 Asignar permisos a cada rol
        // Administrador: todos los permisos
        $admin->syncPermissions(Permission::all());

        // Contador: solo permisos específicos
        $contador->syncPermissions([
            'ver dashboard',
            'ver usuarios',
        ]);

        // 🔹 Asignar roles a usuarios existentes
        $userAdmin = User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Administrador General',
            'password' => bcrypt('12345678'),
        ]);
        
        $userAdmin->syncRoles(['Administrador']);

        $userContador = User::firstOrCreate([
            'email' => 'contador@gmail.com',
        ], [
            'name' => 'Usuario Contador',
            'password' => bcrypt('12345678'),
        ]);
        
        $userContador->syncRoles(['Contador']);
    }
}