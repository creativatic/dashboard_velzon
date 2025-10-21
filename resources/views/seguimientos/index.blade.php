@extends('layouts.plantilla')

@section('title','Seguimiento')

@section('content')
@include('seguimientos.create')

<div class="card mt-3">
    <div class="card-header">
        <h5 class="card-title mb-0">Listado de Seguimiento</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle">
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
                    <th>Notas</th>
                    <th>Acciones</th>
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
                        <td>{{ $programacion->placa_tracto ?? '-' }}</td>
                        <td>{{ $programacion->nombres_conductor ?? '-' }}</td>
                        <td>{{ $programacion->telefono_conductor ?? '-' }}</td>
                        <td>{{ $numero_ticket }}</td>
                        <td>{{ $seguimiento->notas ?? 'Sin notas' }}</td>
                        <td>
                            @if($seguimiento)
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditSeguimiento{{ $seguimiento->id }}">
                                    <i class="ri-edit-2-line"></i>
                                </button>
                                @include('seguimientos.edit', ['seguimiento' => $seguimiento])
                            @else
                                <form action="{{ route('seguimientos.store') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="programacion_id" value="{{ $programacion->id }}">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="ri-add-line"></i> Crear
                                    </button>
                                </form>
                            @endif
                        </td>
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
