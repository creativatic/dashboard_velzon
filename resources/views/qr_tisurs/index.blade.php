@extends('layouts.plantilla')

@section('title', 'Programación')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Listado de QR Tisur</h4>
        @can('crear qr_tisurs')
            <a href="{{ route('qr_tisurs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo QR Tisur
            </a>
        @endcan
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Placa Tracto</th>
                        <th>Licencia</th>
                        <th>DNI</th>
                        <th>Conductor</th>
                        <th>RUC Transporte</th>
                        <th>Razón Social Transporte</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($qr_tisurs as $qr)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $qr->placa_tracto }}</td>
                            <td>{{ $qr->licencia }}</td>
                            <td>{{ $qr->dni }}</td>
                            <td>{{ $qr->nombres_conductor }} {{ $qr->apellidos_conductor }}</td>
                            <td>{{ $qr->ruc_transporte }}</td>
                            <td>{{ $qr->razon_social_transporte }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @can('editar qr_tisurs')
                                        <a href="{{ route('qr_tisurs.edit', $qr->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    @endcan
                                    @can('eliminar qr_tisurs')
                                        <form action="{{ route('qr_tisurs.destroy', $qr->id) }}" method="POST" onsubmit="return confirm('¿Desea eliminar este registro?')">
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