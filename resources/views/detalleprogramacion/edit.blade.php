<!-- Modal Editar Programación -->
<div class="modal fade" id="editProgramacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form id="editProgramacionForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Editar Programación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit-id" name="id">

                <div class="row g-3">

                    {{-- Fecha de Programación --}}
                    <div class="col-md-4">
                        <label for="edit-fecha_progracion" class="form-label">Fecha Programación</label>
                        <input type="date" name="fecha_progracion" id="edit-fecha_progracion" class="form-control" required>
                    </div>

                    {{-- Frente (relación con detalle_programacion) --}}
                    <div class="col-md-4">
                        <label for="edit-detalle_programacion_id" class="form-label">Frente</label>
                        <select name="detalle_programacion_id" id="edit-detalle_programacion_id" class="form-select" required>
                            <option value="">Seleccione un frente...</option>
                            @foreach($detalles as $detalle)
                                <option value="{{ $detalle->id }}"
                                    {{ isset($programacion) && $programacion->detalle_programacion_id == $detalle->id ? 'selected' : '' }}>
                                    {{ $detalle->frente }} — S/.{{ number_format($detalle->precio_frente, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- DNI --}}
                    <div class="col-md-4">
                        <label for="edit-dni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="edit-dni" maxlength="8" class="form-control">
                    </div>

                    {{-- Guía Remisión --}}
                    <div class="col-md-4">
                        <label for="edit-guia_remision" class="form-label">Guía Remisión</label>
                        <input type="text" name="guia_remision" id="edit-guia_remision" class="form-control">
                    </div>

                    {{-- Placa Tracto --}}
                    <div class="col-md-4">
                        <label for="edit-placa_tracto" class="form-label">Placa Tracto</label>
                        <input type="text" name="placa_tracto" id="edit-placa_tracto" class="form-control">
                    </div>

                    {{-- Placa Carreta --}}
                    <div class="col-md-4">
                        <label for="edit-placa_carreta" class="form-label">Placa Carreta</label>
                        <input type="text" name="placa_carreta" id="edit-placa_carreta" class="form-control">
                    </div>

                    {{-- RUC Transporte --}}
                    <div class="col-md-4">
                        <label for="edit-ruc_transporte" class="form-label">RUC Transporte</label>
                        <input type="text" name="ruc_transporte" id="edit-ruc_transporte" maxlength="11" class="form-control">
                    </div>

                    {{-- Razón Social Transporte --}}
                    <div class="col-md-4">
                        <label for="edit-razon_social_transporte" class="form-label">Razón Social Transporte</label>
                        <input type="text" name="razon_social_transporte" id="edit-razon_social_transporte" class="form-control">
                    </div>

                    {{-- Nombres Conductor --}}
                    <div class="col-md-4">
                        <label for="edit-nombres_conductor" class="form-label">Nombres Conductor</label>
                        <input type="text" name="nombres_conductor" id="edit-nombres_conductor" class="form-control">
                    </div>

                    {{-- Apellidos Conductor --}}
                    <div class="col-md-4">
                        <label for="edit-apellidos_conductor" class="form-label">Apellidos Conductor</label>
                        <input type="text" name="apellidos_conductor" id="edit-apellidos_conductor" class="form-control">
                    </div>

                    {{-- Licencia --}}
                    <div class="col-md-4">
                        <label for="edit-licencia" class="form-label">Licencia</label>
                        <input type="text" name="licencia" id="edit-licencia" class="form-control">
                    </div>

                    {{-- Tipo Operación --}}
                    <div class="col-md-4">
                        <label for="edit-tipo_operacion" class="form-label">Tipo Operación</label>
                        <select name="tipo_operacion" id="edit-tipo_operacion" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="nacional">Nacional</option>
                            <option value="internacional">Internacional</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-3-line"></i> Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditProgramacionModal(programacion) {
    const form = document.getElementById('editProgramacionForm');
    form.action = `/programacions/${programacion.id}`;

    for (const [key, value] of Object.entries(programacion)) {
        const input = document.getElementById(`edit-${key}`);
        if (input) {
            if (input.tagName === 'SELECT') {
                input.value = value ?? '';
            } else {
                input.value = value ?? '';
            }
        }
    }

    new bootstrap.Modal(document.getElementById('editProgramacionModal')).show();
}
</script>
