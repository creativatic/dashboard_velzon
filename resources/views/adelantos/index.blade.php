@extends('layouts.plantilla')

@section('title', 'Adelantos')

@section('content')
@include('adelantos.edit')
@include('adelantos.show')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Listado de Adelantos</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Programación</a></li>
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
                    <th>Fecha de Pago Expediente</th>
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
                        <td class="text-start">{{ $programacion->expediente->fecha_pago ?? '-' }}</td>
                        <td class="text-start">{{ $programacion->notas ?? '-' }}</td>
                        <td>
                            {{-- ✅ BOTÓN EDITAR CON ONCLICK --}}
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
                            {{-- ✅ BOTÓN VER CON ONCLICK --}}
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

<script>
/**
 * Función para abrir y cargar datos en el modal de Edición.
 * @param {string} id ID de la Programacion.
 * @param {string} numero Número de Factura.
 * @param {string} monto Monto del Adelanto.
 * @param {string} fecha Fecha de Pago.
 * @param {string} notas Notas.
 */
function openEditAdelantoModal(id, numero, monto, fecha, notas) {
    const editModalElement = document.getElementById('editAdelantoModal');
    const form = document.getElementById('editAdelantoForm');

    // Cargar datos en el formulario
    document.getElementById('edit_programacion_id').value = id;
    document.getElementById('edit_numero_factura').value = numero || '';
    document.getElementById('edit_monto_adelanto').value = monto || '';
    document.getElementById('edit_fecha_pago_adelantos').value = fecha || '';
    document.getElementById('edit_notas').value = notas || '';

    // Actualizar la acción del formulario
    form.action = `/adelantos/${id}`;

    // Abrir el modal
    const modal = new bootstrap.Modal(editModalElement);
    modal.show();
}

/**
 * Función para abrir y cargar datos en el modal de Vista (Show).
 * NOTA: Esta función asume que tienes inputs en el modal 'showAdelantoModal' para mostrar estos datos.
 */
function openShowAdelantoModal(id, numero, monto, fecha, notas, razon, conductor, conformidad) {
    const showModalElement = document.getElementById('showAdelantoModal');
    
    // Aquí debes implementar la lógica para cargar los datos en el modal show.
    // Ejemplo (Asumiendo que tienes elementos con estos IDs en adelantos/show.blade.php):
    // document.getElementById('show_razon_social').textContent = razon;
    // document.getElementById('show_monto').textContent = monto;
    // ... otros campos

    // Abrir el modal
    const modal = new bootstrap.Modal(showModalElement);
    modal.show();
}

// ❌ Eliminamos el Listener de Bootstrap, ya no es necesario
// const editModal = document.getElementById('editAdelantoModal');
// editModal.addEventListener('show.bs.modal', event => { ... });
</script>

@endsection