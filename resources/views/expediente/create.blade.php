<div class="modal fade" id="modalCreateExpediente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('expediente.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nuevo Expediente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-4">
                    <label class="form-label">Fecha de Carga</label>
                    <input type="date" name="fecha_carga" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">N° Guía Remitente</label>
                    <input type="text" name="guia_remitente" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Razon Social Empresa</label>
                    <input type="text" name="razon_social_empresa" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Conductor</label>
                    <input type="text" name="conductor" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Material</label>
                    <input type="text" name="material" class="form-control">
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
                    <label class="form-label">Fecha de Pago</label>
                    <input type="date" name="fecha_pago" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Comentarios</label>
                    <textarea name="comentarios" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
