<div class="modal fade" id="editExpedienteModal" tabindex="-1" aria-labelledby="editExpedienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="editExpedienteModalLabel">
                        <i class="ri-edit-2-line"></i> Editar Expediente
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Fecha de Carga</label>
                            <input type="date" name="fecha_carga" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Total</label>
                            <input type="number" step="0.01" name="total" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Detracción</label>
                            <input type="number" step="0.01" name="detraccion" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Depósito a Proveer</label>
                            <input type="number" step="0.01" name="deposito_a_proveer" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fecha de Pago</label>
                            <input type="date" name="fecha_pago" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">N° Factura</label>
                            <input type="text" name="numero_factura_exped" class="form-control">
                        </div>

                        <div class="col-6">
                            <label class="form-label">Comentarios</label>
                            <textarea name="comentarios" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Archivos</label>
                            <input type="file" name="archivo[]" class="form-control" multiple>
                            <small class="text-muted">Selecciona nuevos archivos si deseas reemplazar los existentes.</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
