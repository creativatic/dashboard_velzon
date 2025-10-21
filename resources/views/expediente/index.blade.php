@extends('layouts.plantilla')

@section('title', 'Expedientes')

@section('content')
@include('expediente.create')
@include('expediente.edit')
@include('expediente.show') {{-- ✅ Modal show incluido correctamente --}}

<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Listado de Expedientes</h5>

        {{-- Botón para abrir modal crear Expediente --}}
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateExpediente">
            <i class="ri-add-circle-line"></i> Nuevo Expediente
        </button>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-primary text-center">
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
                                <form action="{{ route('expediente.destroy', $expediente) }}" method="POST" style="display:inline-block;">
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
</div>


@endsection

<script>
function editarExpediente(expedienteJson) {
    // PASO CLAVE: Convertir la cadena JSON a un objeto JavaScript
    const expediente = JSON.parse(expedienteJson); 

    const form = document.getElementById('editExpedienteForm');
    // Asegurarse de que el ID es correcto
    form.action = `/expediente/${expediente.id}`; 

    // Campos editables
    document.getElementById('edit_fecha_carga').value = expediente.fecha_carga ?? '';
    document.getElementById('edit_total').value = expediente.total ?? '';
    document.getElementById('edit_detraccion').value = expediente.detraccion ?? '';
    document.getElementById('edit_deposito_a_proveer').value = expediente.deposito_a_proveer ?? '';
    document.getElementById('edit_fecha_pago').value = expediente.fecha_pago ?? '';
    document.getElementById('edit_numero_factura_exped').value = expediente.numero_factura_exped ?? '';
    document.getElementById('edit_comentarios').value = expediente.comentarios ?? '';

    // Campos solo lectura (verificando la anidación)
    document.getElementById('edit_guia_remitente').value = expediente.programacion?.guia_remision ?? '';
    document.getElementById('edit_razon_social_transporte').value = expediente.programacion?.razon_social_transporte ?? '';
    document.getElementById('edit_tipo_mineral').value = expediente.programacion?.tipo_mineral ?? '';
    // Los siguientes estaban en tu script original, pero no en tu modal HTML.
    // Los dejo por si están en el include 'expediente.edit'.
    // document.getElementById('edit_numero_ticket')?.value = expediente.tisur?.numero_ticket ?? '';
    // document.getElementById('edit_ruc_transporte')?.value = expediente.programacion?.ruc_transporte ?? ''; 

    // Mostrar modal
    const modal = new bootstrap.Modal(document.getElementById('editExpedienteModal'));
    modal.show();
}
</script>