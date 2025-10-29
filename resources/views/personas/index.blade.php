@extends('layouts.plantilla')

@section('title', 'Personal')

@section('content')
<div class="container">
    <h1>Listado de Personal</h1>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createPersonaModal">
        <i class="ri-add-circle-line"></i> Agregar Persona
    </button>

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Cargo</th>
                <th>Área</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personas as $persona)
            <tr>
                <td>{{ $persona->nombres }}</td>
                <td>{{ $persona->dni }}</td>
                <td>{{ $persona->cargo }}</td>
                <td>{{ $persona->area }}</td>
                <td>
                    @if($persona->estado)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-secondary">Inactivo</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#editPersonaModal"
                        onclick='cargarDatosPersona(@json($persona))'>
                        Editar
                    </button>

                    <form action="{{ route('personas.destroy', $persona) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm('¿Seguro que deseas eliminar esta persona?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('personas.create')
@include('personas.edit')
@endsection
