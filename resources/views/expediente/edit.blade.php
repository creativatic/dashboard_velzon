<!-- Modal único: Editar Expediente -->
<div class="modal fade" id="editExpedienteModal" tabindex="-1" aria-labelledby="editExpedienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="editExpedienteForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editExpedienteModalLabel">
                    <i class="ri-file-edit-line"></i> Editar Expediente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha de Carga</label>
                        <input type="date" name="fecha_carga" id="edit_fecha_carga" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Guía de Remisión</label>
                        <input type="text" id="edit_guia_remitente" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Razón Social Transporte</label>
                        <input type="text" id="edit_razon_social_transporte" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Material</label>
                        <input type="text" id="edit_tipo_mineral" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Total</label>
                        <input type="number" step="0.01" name="total" id="edit_total" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Detracción</label>
                        <input type="number" step="0.01" name="detraccion" id="edit_detraccion" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Depósito a Proveer</label>
                        <input type="number" step="0.01" name="deposito_a_proveer" id="edit_deposito_a_proveer" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" id="edit_fecha_pago" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">N° Factura</label>
                        <input type="text" name="numero_factura_exped" id="edit_numero_factura_exped" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Comentarios</label>
                        <textarea name="comentarios" id="edit_comentarios" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-warning">
                    <i class="ri-save-3-line"></i> Actualizar Expediente
                </button>
            </div>
        </form>
    </div>
</div>

