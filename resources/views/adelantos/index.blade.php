@extends('layouts.plantilla')

@section('title', 'Adelantos')

@section('content')
@include('adelantos.edit')
@include('adelantos.show')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Listado de Adelantos</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="#">Programación</a></li>
            <li class="breadcrumb-item active">Listado de Adelantos</li>
        </ol>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Guía Remisión</th>
                    <th>Placa</th>
                    <th>Razón Social Transporte</th>
                    <th>Conductor</th>
                    <th>Conformidad Adelanto</th>
                    <th>Monto Adelanto (S/)</th>
                    <th>Fecha de Pago Adelanto</th>
                    <th>Fecha Pago Expediente</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody class="text-center">
                
                @forelse ($programaciones as $programacion)
                    <tr>
                        @php
                            $unidad = $programacion->proveedor?->unidades?->first();
                            $conductor = $unidad?->conductores?->first();
                        @endphp
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $programacion->guia_remision ?? '-' }}</td>
                        <td>{{ $unidad?->placa_tracto ?? '-' }}</td>
                        <td>{{ optional($programacion->proveedor)->razon_social ?? '-' }}</td>
                        <td>
                            {{ $conductor
                                ? trim($conductor->nombres . ' ' . $conductor->apellidos)
                                : '-' }}
                        </td>

                        <td>
                            @if($programacion->conformidad_adelanto === 'Ok')
                                <span class="badge bg-success">Ok</span>
                            @elseif($programacion->conformidad_adelanto === 'Pendiente')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td>
                            {{ optional($programacion->detalleProgramacion)->precio_frente 
                                ? number_format($programacion->detalleProgramacion->precio_frente, 2)
                                : '-' }}
                        </td>

                        <td>
                            @if($programacion->fecha_pago_adelantos)
                                {{ \Carbon\Carbon::parse($programacion->fecha_pago_adelantos)->format('d/m/Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td>{{ optional($programacion->expedientes->first())->fecha_pago ?? '-' }}</td>
                        <td>{{ $programacion->notas ?? '-' }}</td>

                        <td>
                            {{-- EDITAR --}}
                            <button 
                                type="button"
                                class="btn btn-warning btn-sm"
                                onclick="openEditAdelantoModal(
                                    '{{ $programacion->id }}',
                                    '{{ $programacion->numero_factura_exped }}',
                                    '{{ $programacion->detalleProgramacion->precio_frente ?? '' }}',
                                    '{{ $programacion->fecha_pago_adelantos }}',
                                    '{{ $programacion->notas }}'
                                )">
                                <i class="ri-edit-2-line"></i>
                            </button>

                            {{-- VER --}}
                            <button 
                                type="button" 
                                class="btn btn-info btn-sm"
                                onclick="openShowAdelantoModal(
                                    '{{ $programacion->id }}',
                                    '{{ $programacion->numero_factura_exped }}',
                                    '{{ $programacion->detalleProgramacion->precio_frente ?? '' }}',
                                    '{{ $programacion->fecha_pago_adelantos }}',
                                    '{{ $programacion->notas }}',
                                    '{{ $programacion->razon_social_transporte }}',
                                    '{{ trim(($programacion->nombres_conductor ?? '') . ' ' . ($programacion->apellidos_conductor ?? '')) }}',
                                    '{{ $programacion->conformidad_adelanto }}'
                                )">
                                <i class="fas fa-eye"></i> Ver
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-muted">No hay registros disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        @if(method_exists($programaciones, 'links'))
            <div class="mt-3 d-flex justify-content-center">
                {{ $programaciones->links() }}
            </div>
        @endif
    </div>
</div>

<script>
function openEditAdelantoModal(id, numero, monto, fecha, notas) {
    document.getElementById('edit_programacion_id').value = id;
    document.getElementById('edit_numero_factura').value = numero || '';
    document.getElementById('edit_monto_adelanto').value = monto || '';
    document.getElementById('edit_fecha_pago_adelantos').value = fecha || '';
    document.getElementById('edit_notas').value = notas || '';

    document.getElementById('editAdelantoForm').action = `/adelantos/${id}`;

    new bootstrap.Modal(document.getElementById('editAdelantoModal')).show();
}

function openShowAdelantoModal(id, numero, monto, fecha, notas, razon, conductor, conformidad) {
    new bootstrap.Modal(document.getElementById('showAdelantoModal')).show();
}
</script>

@endsection
