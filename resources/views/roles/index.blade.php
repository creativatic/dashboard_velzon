@extends('layouts.plantilla')

@section('title','Roles')


@section('content')
@include('roles.create')
@include('roles.edit')

<div class="container-fluid">
    <h4 class="mb-3">Gestión de Roles</h4>
    {{-- Botón para abrir modal crear rol--}}
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRoleModal">
        <i class="ri-add-circle-line"></i> Nuevo Rol
    </button>
    
    <div class="card">
        <div class="card-body table-responsive">

            <table class="table">
                <thead>
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
</div>


@endsection