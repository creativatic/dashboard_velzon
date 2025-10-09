<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Mostrar la lista de roles
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Crear un nuevo rol
     */
   public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            // 🔹 Convertir los IDs a nombres antes de sincronizar
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }
    /**
     * Editar un rol existente (no se usa vista directa, el modal carga los datos)
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Actualizar el rol
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        // Verifica si el request tiene permisos
        if ($request->has('permissions')) {
            // Convierte los IDs a nombres de permisos
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();

            // Sincroniza por nombres (no IDs)
            $role->syncPermissions($permissions);
        } else {
            // Si no seleccionó permisos, elimina todos
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }
    /**
     * Eliminar un rol
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}
