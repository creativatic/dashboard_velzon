@extends('layouts.plantilla')

@section('title', 'Expedientes')

@section('content')
@include('expediente.create')

<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Listado de Expedientes</h5>

        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Razón Social</th>
                    <th>Guía Remitente</th>
                    <th>Material</th>
                    <th>Total</th>
                    <th>Fecha de pago</th>
                    <th>Comentarios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expedientes as $expediente)
                    <tr>
                        <td>{{ $expediente->id }}</td>
                        <td>{{ $expediente->razon_social_empresa }}</td>
                        <td>{{ $expediente->guia_remitente }}</td>
                        <td>{{ $expediente->material }}</td>
                        <td>{{ $expediente->total }}</td>
                        <td>
                            <!-- Botón para editar -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditExpediente{{ $expediente->id }}">
                                Editar
                            </button>

                            <!-- Botón para eliminar -->
                            <form action="{{ route('expediente.destroy', $expediente) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este registro?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Aquí se incluye el modal de edición por cada expediente -->
                    @include('expediente.edit')
                @endforeach
            </tbody>
        </table>

        {{ $expedientes->links() }}
    </div>
</div>
@endsection
