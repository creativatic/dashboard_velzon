@extends('layouts.plantilla')

@section('title', 'Roles')

@section('content')
@include('roles.create')
@include('roles.edit')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Gestión de Roles</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Usuarios</a></li>
            <li class="breadcrumb-item active">Gestión de Roles</li>
        </ol>
    </div>
</div>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRoleModal">
    <i class="ri-add-circle-line"></i> Nuevo Rol
</button>
    
<div class="card mt-3">
    <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nombres</th>
                        <th>Permisos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->permissions->pluck('name')->join(', ') }}</td>
                            <td>
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-warning"
                                    onclick='openEditRoleModal(@json($role))'>
                                    Editar
                                </button>

                                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('¿Eliminar este rol?')" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection
