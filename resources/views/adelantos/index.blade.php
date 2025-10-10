@extends('layouts.plantilla')

@section('title', 'Programación')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Listado de Adelantos</h4>
        @can('crear adelantos')
            <a href="{{ route('adelantos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Adelanto
            </a>
        @endcan
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>N° Guía Remitente</th>
                        <th>Placa</th>
                        <th>Razón Social</th>
                        <th>Conductor</th>
                        <th>Monto Adelanto</th>
                        <th>Fecha de Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($adelantos as $adelanto)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $adelanto->numero_guia_remitente }}</td>
                            <td>{{ $adelanto->placa }}</td>
                            <td>{{ $adelanto->razon_social }}</td>
                            <td>{{ $adelanto->nombres_apellidos_conductor }}</td>
                            <td>{{ number_format($adelanto->monto_adelanto, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($adelanto->fecha_pago)->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @can('editar adelantos')
                                        <a href="{{ route('adelantos.edit', $adelanto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    @endcan
                                    @can('eliminar adelantos')
                                        <form action="{{ route('adelantos.destroy', $adelanto->id) }}" method="POST" onsubmit="return confirm('¿Desea eliminar este registro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay registros disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection