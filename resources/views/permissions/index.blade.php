@extends('layouts.plantilla')

@section('title','Permisos')

@section('content')
@include('permissions.create')
@include('permissions.edit')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Gestión de Permisos</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Usuarios</a></li>
            <li class="breadcrumb-item active">Gestión de Permisos</li>
        </ol>
    </div>
</div>

{{-- Botón para abrir modal crear permiso --}}
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
    <i class="ri-add-circle-line"></i> Nuevo Permiso
</button>

    <div class="card mt-3">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
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