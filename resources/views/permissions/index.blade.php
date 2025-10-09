@extends('layouts.plantilla')

@section('title','Permisos')

@section('content')
@include('permissions.create')
@include('permissions.edit')

<div class="container-fluid">
    <h4 class="mb-3">Gestión de Permisos</h4>

    {{-- Botón para abrir modal crear permiso --}}
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
        <i class="ri-add-circle-line"></i> Nuevo Permiso
    </button>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-warning"
                                    onclick='openEditPermissionModal(@json($permission))'>
                                    Editar
                                </button>

                                <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('¿Eliminar este permiso?')" class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Mensajes de éxito --}}
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        });
    </script>
@endif

@endsection