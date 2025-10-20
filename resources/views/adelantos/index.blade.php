@extends('layouts.plantilla')

@section('title', 'Adelantos')

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
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Guía Remisión</th>
                        <th>Placa</th>
                        <th>Razón Social Transporte</th>
                        <th>Conductor</th>
                        <th>Peso Neto (Kg)</th>
                        <th>Conformidad Adelanto</th>
                        <th>Monto Adelanto (S/)</th>
                        <th>Fecha de Pago Adelanto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @forelse ($adelantos as $adelanto)
                        @php
                            $prog = $adelanto->programacion ?? null;
                            $guia = $prog->guia_remision ?? $adelanto->nro_guia_remitente ?? '-';
                            $placa = $prog->placa_tracto ?? '-';
                            $razon = $prog->razon_social_transporte ?? '-';
                            $conductor = trim(($prog->nombres_conductor ?? '') . ' ' . ($prog->apellidos_conductor ?? ''));
                            $pesoNeto = $prog->peso_neto ?? '-';
                            $conformidad = $prog->conformidad_adelanto ?? '-';
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $guia }}</td>
                            <td>{{ $placa }}</td>
                            <td class="text-start">{{ $razon }}</td>
                            <td class="text-start">{{ $conductor ?: '-' }}</td>
                            <td>{{ $pesoNeto }}</td>
                            <td>
                                @if($conformidad === 'Ok')
                                    <span class="badge bg-success">Ok</span>
                                @elseif($conformidad === 'Pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ number_format($adelanto->monto_adelanto, 2) }}</td>
                            <td>
                                @if($adelanto->fecha_pago_adelantos)
                                    {{ \Carbon\Carbon::parse($adelanto->fecha_pago_adelantos)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>
                                <div class="btn-group" role="group">
                                    @can('editar adelantos')
                                        <a href="{{ route('adelantos.edit', $adelanto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    @endcan
                                    @can('eliminar adelantos')
                                        <form action="{{ route('adelantos.destroy', $adelanto->id) }}" method="POST" onsubmit="return confirm('¿Desea eliminar este registro?')" class="d-inline">
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
                            <td colspan="10" class="text-center">No hay registros disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            @if(method_exists($adelantos, 'links'))
                <div class="mt-3 d-flex justify-content-center">
                    {{ $adelantos->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
