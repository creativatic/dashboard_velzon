@extends('layouts.plantilla')

@section('title','Seguimiento')

@section('content')
@include('seguimientos.create')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Listado de Seguimiento</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Programación</a></li>
            <li class="breadcrumb-item active">Listado de Seguimiento</li>
        </ol>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Grupo Carguío</th>
                    <th>Tipo Mineral</th>
                    <th>Frente</th>
                    <th>Activo</th>
                    <th>Placa Tracto</th>
                    <th>Conductor</th>
                    <th>Teléfono</th>
                    <th>N° Ticket</th>
                    <th>Fecha de Programación</th>
                    <th>Notas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($programaciones as $index => $programacion)
                    @php
                        $seguimiento = $programacion->seguimiento;
                        $detalle = $programacion->detalleProgramacion ?? null;

                        // ✅ Obtener número(s) de ticket desde los expedientes asociados
                        $numero_ticket = $programacion->expedientes->pluck('tisur.numero_ticket')->filter()->implode(', ');
                        if (empty($numero_ticket)) {
                            $numero_ticket = 'No registrado';
                        }
                    @endphp

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $programacion->grupo_cargio ?? '-' }}</td>
                        <td>{{ $programacion->tipo_mineral ?? '-' }}</td>
                        <td>{{ $detalle->frente ?? 'Sin frente' }}</td>
                        <td>
                            <span class="badge bg-{{ $detalle && $detalle->activo ? 'success' : 'secondary' }}">
                                {{ $detalle && $detalle->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            {{ optional($programacion->proveedor->unidades->first())->placa_tracto ?? '-' }}
                        </td>
                        <td>
                            @php
                                $unidad = $programacion->proveedor->unidades->first();
                                $conductor = optional($unidad)->conductores->first();
                            @endphp

                            {{ $conductor ? $conductor->nombres . ' ' . $conductor->apellidos : '-' }}
                        </td>
                        <td>
                            {{ optional($conductor)->telefono ?? '-' }}
                        </td>
                        <td>{{ $numero_ticket }}</td>
                        <td>{{ $programacion->fecha_programacion }}</td>
                        <td>{{ $seguimiento->notas ?? 'Sin notas' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">No hay registros de seguimiento</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<!-- Modal dinámico -->
<div class="modal fade" id="editSeguimientoModal" tabindex="-1" aria-labelledby="editSeguimientoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" id="modalEditContent">
      <!-- Aquí se cargará el contenido con JS -->
    </div>
  </div>
</div>

<script>
function openEditModal(seguimientoId) {
    fetch(`/seguimientos/${seguimientoId}/edit`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('modalEditContent').innerHTML = html;
            new bootstrap.Modal(document.getElementById('editSeguimientoModal')).show();
        })
        .catch(err => console.error('Error al cargar el modal:', err));
}
</script>
@endsection
