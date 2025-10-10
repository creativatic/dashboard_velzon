<!-- Modal Editar Programación -->
<div class="modal fade" id="editProgramacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="editProgramacionForm" method="POST" class="modal-content">
            @csrf @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Editar Programación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit-id" name="id">

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Guía de Remisión</label>
                        <input type="text" name="guia_remision" id="edit-guia_remision" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Placa Tracto</label>
                        <input type="text" name="placa_tracto" id="edit-placa_tracto" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Placa Carreta</label>
                        <input type="text" name="placa_carreta" id="edit-placa_carreta" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Marca del Vehículo</label>
                        <input type="text" name="marca_vehiculo" id="edit-marca_vehiculo" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tipo de Plataforma</label>
                        <input type="text" name="tipo_plataforma" id="edit-tipo_plataforma" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Constancia MTC</label>
                        <input type="text" name="constancia_mtc" id="edit-constancia_mtc" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Constancia MTC Carreta</label>
                        <input type="text" name="constancia_mtc_carreta" id="edit-constancia_mtc_carreta" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Razón Social del Transporte</label>
                        <input type="text" name="razon_social_transporte" id="edit-razon_social_transporte" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">RUC del Transporte</label>
                        <input type="text" name="ruc_transporte" id="edit-ruc_transporte" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Conductor (Nombre y Apellidos)</label>
                        <input type="text" name="conductor" id="edit-conductor" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Licencia</label>
                        <input type="text" name="licencia" id="edit-licencia" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Teléfono del Conductor</label>
                        <input type="text" name="telefono_conductor" id="edit-telefono_conductor" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Cuenta</label>
                        <input type="text" name="cuenta" id="edit-cuenta" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">CCI</label>
                        <input type="text" name="cci" id="edit-cci" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Banco</label>
                        <input type="text" name="banco" id="edit-banco" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tipo de Mineral</label>
                        <input type="text" name="tipo_mineral" id="edit-tipo_mineral" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Número de Guía</label>
                        <input type="text" name="numero_guia" id="edit-numero_guia" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Conformidad Adelanto</label>
                        <input type="text" name="conformidad_adelanto" id="edit-conformidad_adelanto" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Guía Transportista</label>
                        <input type="text" name="guia_transportista" id="edit-guia_transportista" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Logística</label>
                        <input type="text" name="logistica" id="edit-logistica" class="form-control">
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

    // Llenar los campos
    for (const key in programacion) {
        const input = document.getElementById(`edit-${key}`);
        if (input) input.value = programacion[key] ?? '';
    }

    new bootstrap.Modal(document.getElementById('editProgramacionModal')).show();
}
</script>
