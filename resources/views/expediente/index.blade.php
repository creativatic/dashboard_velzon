@extends('layouts.plantilla')

@section('title','Seguimiento')

@section('content')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Listado de Expediente</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Expediente</a></li>
            <li class="breadcrumb-item active">Listado de Expediente</li>
        </ol>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>N° Guía Remisión</th>
                    <th>Placa Tracto</th>
                    <th>Tipo Mineral</th>
                    <th>Conformidad Adelanto</th>
                    <th>Frente</th>
                    <th>Razón Social</th>
                    <th>RUC</th>
                    <th>Apellidos Conductor</th>
                    <th>Teléfono</th>
                    <th>Cuenta Banco</th>
                    <th>Banco</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($programaciones as $index => $programacion)
                    @php
                        $seguimiento = $programacion->seguimiento;
                        $detalle = $programacion->detalleProgramacion ?? null;
                    @endphp

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $programacion->guia_transportista ?? '-' }}</td>
                        <td>{{ $programacion->placa_tracto ?? '-' }}</td>
                        <td>{{ $programacion->tipo_mineral ?? '-' }}</td>
                        <td>
                            @if($programacion->conformidad_adelanto === 'Ok')
                                <span class="btn btn-success btn-sm w-100">{{ $programacion->conformidad_adelanto }}</span>
                            @elseif($programacion->conformidad_adelanto === 'Pendiente')
                                <span class="btn btn-danger btn-sm w-100">{{ $programacion->conformidad_adelanto }}</span>
                            @else
                                <span class="badge bg-secondary">--</span>
                            @endif
                        </td>
                        <td>{{ $detalle->frente ?? 'Sin frente' }}</td>
                        <td>{{ $programacion->razon_social_transporte ?? '-' }}</td>
                        <td>{{ $programacion->ruc_transporte ?? '-' }}</td>
                        <td>{{ $programacion->apellidos_conductor  ?? '-' }}</td>
                        <td>{{ $programacion->telefono_conductor ?? '-' }}</td>
                        <td>{{ $programacion->cuenta_banco ?? '-' }}</td>
                        <td>{{ $programacion->banco ?? '-' }}</td>
                        <td>
                            @if($seguimiento)
                                <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editSeguimientoModal"
                                    onclick="editarExpediente({{ $seguimiento->id }})">
                                    <i class="ri-edit-2-line"></i>
                                </button>
                            @else
                                <button class="btn btn-success btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editSeguimientoModal"
                                    onclick="crearExpediente({{ $programacion->id }})">
                                    <i class="ri-add-line"></i> Crear
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center text-muted">No hay registros de expediente</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- 🔹 Modal dinámico reutilizable -->
<div class="modal fade" id="editSeguimientoModal" tabindex="-1" aria-labelledby="editSeguimientoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="formEditExpediente" method="POST" class="modal-content" enctype="multipart/form-data">
      @csrf
      @method('POST')

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editSeguimientoLabel">Expediente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body row g-3" id="modalEditBody">
        <div class="text-center w-100">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
function editarExpediente(id) {
    const modalBody = document.getElementById('modalEditBody');
    const form = document.getElementById('formEditExpediente');
    const modalTitle = document.getElementById('editSeguimientoLabel');

    modalBody.innerHTML = `
        <div class="text-center w-100">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    `;

    fetch(`/expediente/${id}/edit`)
        .then(response => {
            if (!response.ok) throw new Error("No se pudo cargar el expediente");
            return response.text();
        })
        .then(html => {
            modalBody.innerHTML = html;
            form.action = `/expediente/${id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';
            modalTitle.textContent = "Editar Expediente";
        })
        .catch(error => {
            modalBody.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
        });
}

function crearExpediente(programacionId) {
    const modalBody = document.getElementById('modalEditBody');
    const form = document.getElementById('formEditExpediente');
    const modalTitle = document.getElementById('editSeguimientoLabel');

    modalBody.innerHTML = `
        <div class="text-center w-100">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    `;

    fetch(`/expediente/create?programacion_id=${programacionId}`)
        .then(response => {
            if (!response.ok) throw new Error("No se pudo cargar el formulario de creación");
            return response.text();
        })
        .then(html => {
            modalBody.innerHTML = html;
            form.action = `/expediente`;
            form.querySelector('input[name="_method"]').value = 'POST';
            modalTitle.textContent = "Crear Expediente";
        })
        .catch(error => {
            modalBody.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
        });
}
</script>
@endpush
