@extends('layouts.plantilla')

@section('title','Seguimiento')

@section('content')
@include('expediente.create')

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


@endsection


@push('scripts')

<script>
    function editarExpediente(id) {
        fetch(`/expediente/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_numero_factura_exped').value = data.numero_factura_exped ?? '';
                document.getElementById('edit_tisur_id').value = data.tisur_id ?? '';
                document.getElementById('edit_detalle_programacion_id').value = data.detalle_programacion_id ?? '';
            });
    }

    function mostrarExpediente(id) {
        fetch(`/expediente/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('show_numero_factura_exped').textContent = data.numero_factura_exped ?? '-';
                document.getElementById('show_tisur').textContent = data.tisur?.numero_ticket ?? '-';
                document.getElementById('show_programacion').textContent = data.programacion?.razon_social_transporte ?? '-';
            });
    }
</script>
@endpush
