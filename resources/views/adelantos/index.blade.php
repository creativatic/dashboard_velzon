@extends('layouts.plantilla')

@section('title', 'Adelantos')

@section('content')
@include('adelantos.edit')
@include('adelantos.show')


<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Listado de Adelantos</h4>
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
                        <th>Conformidad Adelanto</th>
                        <th>Monto Adelanto (S/)</th>
                        <th>Fecha de Pago Adelanto</th>
                        <th>Notas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @forelse ($programaciones as $programacion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $programacion->guia_remision ?? '-' }}</td>
                            <td>{{ $programacion->placa_tracto ?? '-' }}</td>
                            <td class="text-start">{{ $programacion->razon_social_transporte ?? '-' }}</td>
                            <td class="text-start">
                                {{ trim(($programacion->nombres_conductor ?? '') . ' ' . ($programacion->apellidos_conductor ?? '')) ?: '-' }}
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
                            <td class="text-start">{{ $programacion->notas ?? '-' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button 
                                        type="button"
                                        class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editAdelantoModal"
                                        data-id="{{ $programacion->id }}"
                                        data-numero="{{ $programacion->numero_factura_exped }}"
                                        data-monto="{{ $programacion->detalleProgramacion->precio_frente ?? '-' }}"
                                        data-fecha="{{ $programacion->fecha_pago_adelantos }}"
                                        data-notas="{{ $programacion->notas }}">
                                        Editar
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-sm btn-info text-white"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#showAdelantoModal"
                                        data-id="{{ $programacion->id }}"
                                        data-numero="{{ $programacion->numero_factura_exped }}"
                                        data-monto="{{ $programacion->detalleProgramacion->precio_frente ?? '-' }}"
                                        data-fecha="{{ $programacion->fecha_pago_adelantos }}"
                                        data-notas="{{ $programacion->notas }}"
                                        data-razon="{{ $programacion->razon_social_transporte }}"
                                        data-conductor="{{ trim(($programacion->nombres_conductor ?? '') . ' ' . ($programacion->apellidos_conductor ?? '')) }}"
                                        data-conformidad="{{ $programacion->conformidad_adelanto }}">
                                        <i class="ri-eye-line"></i> Ver
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">No hay registros disponibles.</td>
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
</div>
<script>
const editModal = document.getElementById('editAdelantoModal');
editModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const numero = button.getAttribute('data-numero');
    const monto = button.getAttribute('data-monto');
    const fecha = button.getAttribute('data-fecha');
    const notas = button.getAttribute('data-notas');

    document.getElementById('edit_programacion_id').value = id;
    document.getElementById('edit_numero_factura').value = numero;
    document.getElementById('edit_monto_adelanto').value = monto;
    document.getElementById('edit_fecha_pago_adelantos').value = fecha || '';
    document.getElementById('edit_notas').value = notas || '';

    document.getElementById('editAdelantoForm').action = `/adelantos/${id}`;
});
</script>

@endsection
