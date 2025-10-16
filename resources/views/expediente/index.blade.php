@extends('layouts.plantilla')

@section('title', 'Expedientes')

@section('content')
@include('expediente.create')

<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Listado de Expedientes</h5>

        {{-- Botón para abrir modal crear Expediente --}}
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateExpediente">
            <i class="ri-add-circle-line"></i> Nuevo Expediente
        </button>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Razón Social Empresa</th>
                        <th>RUC</th>
                        <th>Placa Tracto</th>
                        <th>Placa Carreta</th>
                        <th>Guía Transportista</th>
                        <th>N° Ticket Expediente</th>
                        <th>N° Factura Expediente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($expedientes as $expediente)
                        <tr>
                            <td>{{ $expediente->id }}</td>
                            <!--<td>{{ $expediente->razon_social_empresa }}</td>-->
                            <td>{{ $expediente->programacion->razon_social_transporte ?? '-' }}</td>
                            <td>{{ $expediente->programacion->ruc_transporte }}</td>
                            <td>{{ $expediente->programacion->placa_tracto }}</td>
                            <td>{{ $expediente->programacion->placa_carreta }}</td>
                            <td>{{ $expediente->programacion->guia_transportista }}</td>
                            <td>{{ $expediente->numero_ticke_exped }}</td>
                            <td>{{ $expediente->numero_factura_exped }}</td>
                            <td>
                                <!-- Botón para editar -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditExpediente{{ $expediente->id }}">
                                    <i class="ri-edit-2-line"></i>
                                </button>

                                <!-- Botón para eliminar -->
                                <form action="{{ route('expediente.destroy', $expediente) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este expediente?')">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Editar Expediente --}}
                        @include('expediente.edit')
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $expedientes->links() }}
        </div>
    </div>
</div>
@endsection
