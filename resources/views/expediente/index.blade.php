@extends('layouts.plantilla')

@section('title', 'Expedientes')

@section('content')
@include('expediente.create')
@include('expediente.edit')
@include('expediente.show') {{-- ✅ Modal show incluido correctamente --}}

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Listado de Expedientes</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Expedientes</a></li>
            <li class="breadcrumb-item active">Listado de Expedientes</li>
        </ol>
    </div>
</div>

{{-- Botón para abrir modal crear Expediente --}}
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateExpediente">
    <i class="ri-add-circle-line"></i> Nuevo Expediente
</button>

    <div class="card mt-3">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Razón Social Empresa</th>
                        <th>RUC</th>
                        <th>Placa Tracto</th>
                        <th>Placa Carreta</th>
                        <th>Guía Transportista</th>
                        <th>N° Ticket Expediente</th>
                        <th>N° Factura Expediente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($expedientes as $expediente)
                        <tr>
                            <td>{{ $expediente->id }}</td>
                            <td>{{ $expediente->programacion->razon_social_transporte ?? '-' }}</td>
                            <td>{{ $expediente->programacion->ruc_transporte ?? '-' }}</td>
                            <td>{{ $expediente->programacion->placa_tracto ?? '-' }}</td>
                            <td>{{ $expediente->programacion->placa_carreta ?? '-' }}</td>
                            <td>{{ $expediente->programacion->guia_transportista ?? '-' }}</td>
                            <td>{{ $expediente->tisur->numero_ticket ?? '-' }}</td>
                            <td>{{ $expediente->numero_factura_exped ?? '-' }}</td>
                            <td>
                                <!-- ✅ CORREGIDO: Solo un método para Ver -->
                                <button type="button" class="btn btn-info btn-sm" 
                                        onclick="mostrarExpediente({{ $expediente->id }})">
                                    <i class="fas fa-eye"></i> Ver
                                </button>

                                <!-- Botón para editar -->
                                 <button class="btn btn-warning btn-sm" 
                                        onclick="editarExpediente('{{ json_encode($expediente) }}')">
                                    <i class="ri-edit-2-line"></i>
                                </button>

                                <!-- Botón para eliminar -->
                                <form action="{{ route('expediente.destroy', $expediente) }}" method="POST" 
                                      style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este expediente?')">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $expedientes->links() }}
        </div>
    </div>

@endsection

<script>
function editarExpediente(expedienteJson) {
    const expediente = JSON.parse(expedienteJson); 
    const form = document.getElementById('editExpedienteForm');
    // Asegurarse de que el ID es correcto
    form.action = `/expediente/${expediente.id}`; 

    // ... (Llenado de campos editables y de solo lectura) ...
    document.getElementById('edit_fecha_carga').value = expediente.fecha_carga ?? '';
    document.getElementById('edit_total').value = expediente.total ?? '';
    document.getElementById('edit_detraccion').value = expediente.detraccion ?? '';
    document.getElementById('edit_deposito_a_proveer').value = expediente.deposito_a_proveer ?? '';
    document.getElementById('edit_fecha_pago').value = expediente.fecha_pago ?? '';
    document.getElementById('edit_numero_factura_exped').value = expediente.numero_factura_exped ?? '';
    document.getElementById('edit_comentarios').value = expediente.comentarios ?? '';

    document.getElementById('edit_guia_remitente').value = expediente.programacion?.guia_remision ?? '';
    document.getElementById('edit_razon_social_transporte').value = expediente.programacion?.razon_social_transporte ?? '';
    document.getElementById('edit_tipo_mineral').value = expediente.programacion?.tipo_mineral ?? '';

    // 💡 NUEVA LÓGICA: Mostrar el archivo actual
    const fileDisplay = document.getElementById('current_file_display');
    fileDisplay.innerHTML = ''; // Limpiar contenido previo

    if (expediente.archivo) {
        // Se asume que los archivos están en storage/app/public/expedientes
        // y que tienes un enlace simbólico (storage:link) para acceder vía /storage/
        const fileName = expediente.archivo.split('/').pop();
        const fileUrl = `/storage/${expediente.archivo}`; 

        fileDisplay.innerHTML = `
            <span class="badge bg-success me-2">Archivo Actual</span>
            <a href="${fileUrl}" target="_blank" class="text-decoration-none">
                <i class="ri-file-fill"></i> Ver ${fileName}
            </a>
        `;
    }

    // Mostrar modal
    const modal = new bootstrap.Modal(document.getElementById('editExpedienteModal'));
    modal.show();
}
</script>
