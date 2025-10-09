<?php

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

        // 🔹 Crear permisos (puedes ampliar esta lista más adelante)
        $permissions = [
            'ver dashboard',
            'gestionar usuarios',
            'gestionar roles',
            'gestionar permisos',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 🔹 Crear roles
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $contador = Role::firstOrCreate(['name' => 'Contador']);

        // 🔹 Asignar permisos a cada rol
        $admin->syncPermissions(Permission::all());
        $contador->syncPermissions(['ver dashboard']);

        // 🔹 Asignar roles a usuarios existentes (si quieres probar)
        $userAdmin = User::firstOrCreate([
            'email' => 'Admin@gmail.com',
        ], [
            'name' => 'Administrador General',
            'password' => bcrypt('12345678'),
        ]);
        
        $userAdmin->assignRole('Administrador');
        $userContador = User::firstOrCreate([
            'email' => 'contador@gmail.com',
        ], [
            'name' => 'Usuario Contador',
            'password' => bcrypt('12345678'),
        ]);
        $userContador->assignRole('Contador');
    }
}