@extends('layouts.plantilla')

@section('title', 'Expedientes')

@section('content')
@include('expediente.create')
@include('expediente.edit')
@include('expediente.show')

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Listado de Expedientes</h4>
        @can('crear expedientes')
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateExpediente">
                <i class="fas fa-plus"></i> Nuevo Expediente
            </button>
        @endcan
    </div>

    <div class="card-body">
        <div class="alert alert-success py-2 mb-3">
            Mostrando solo expedientes con <strong>Conformidad de Adelanto: Ok</strong>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Razón Social</th>
                        <th>RUC</th>
                        <th>Placa Tracto</th>
                        <th>Placa Carreta</th>
                        <th>Guía Transportista</th>
                        <th>N° Ticket (Tisur)</th>
                        <th>Factura</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($expedientes as $expediente)
                        @php
                            // === DATOS DE PROGRAMACION ===
                            $prog = $expediente->programacion_id
                                ? \App\Models\Programacion::find($expediente->programacion_id)
                                : null;

                            $razon_social = $prog->razon_social_transporte ?? '-';
                            $ruc = $prog->ruc_transporte ?? '-';
                            $placa_tracto = $prog->placa_tracto ?? '-';
                            $placa_carreta = $prog->placa_carreta ?? '-';
                            $guia_transportista = $prog->guia_transportista ?? '-';

                            // === DATOS DE TISUR ===
                            $tisur = $expediente->tisur_id
                                ? \App\Models\Tisur::find($expediente->tisur_id)
                                : null;

                            $numero_ticket = $tisur->numero_ticket ?? '-';
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $razon_social }}</td>
                            <td>{{ $ruc }}</td>
                            <td>{{ $placa_tracto }}</td>
                            <td>{{ $placa_carreta }}</td>
                            <td>{{ $guia_transportista }}</td>
                            <td>{{ $numero_ticket }}</td>
                            <td>{{ $expediente->numero_factura_exped ?? '-' }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm"
                                    onclick="mostrarExpediente({{ $expediente->id }})"
                                    data-bs-toggle="modal" data-bs-target="#modalShowExpediente">
                                    <i class="fas fa-eye"></i>
                                </button>

                                @can('editar expedientes')
                                    <button type="button" class="btn btn-warning btn-sm"
                                        onclick="editarExpediente({{ $expediente->id }})"
                                        data-bs-toggle="modal" data-bs-target="#modalEditExpediente">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endcan

                                @can('eliminar expedientes')
                                    <form action="{{ route('expediente.destroy', $expediente->id) }}" 
                                          method="POST" class="d-inline-block"
                                          onsubmit="return confirm('¿Deseas eliminar este expediente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No hay expedientes con conformidad "Ok".</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <p class="mb-0 text-muted">
                Total de expedientes: {{ $expedientes->total() }}
            </p>
            {{ $expedientes->links() }}
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
