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
        // 🔄 Limpiar caché de permisos y roles
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 🔹 Crear permisos base (puedes ampliar esta lista más adelante)
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
        $superAdmin = Role::firstOrCreate(['name' => 'Super Administrador']);
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $auxiliar = Role::firstOrCreate(['name' => 'Auxiliar']);

        // 🔹 Asignar permisos por rol
        $superAdmin->syncPermissions(Permission::all()); // todos los permisos
        $admin->syncPermissions(['ver dashboard', 'gestionar usuarios']);
        $auxiliar->syncPermissions(['ver dashboard']);

        // 🔹 Crear usuarios y asignar roles
        $userSuper = User::firstOrCreate(
            ['email' => 'super-admin@gmail.com'],
            ['name' => 'Super Administrador', 'password' => bcrypt('12345678')]
        );
        $userSuper->assignRole('Super Administrador');

        $userAdmin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Administrador del Sistema', 'password' => bcrypt('12345678')]
        );
        $userAdmin->assignRole('Administrador');

        $userAux = User::firstOrCreate(
            ['email' => 'auxiliar@gmail.com'],
            ['name' => 'Usuario Auxiliar', 'password' => bcrypt('12345678')]
        );
        $userAux->assignRole('Auxiliar');
    }
}
