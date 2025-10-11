<div class="modal fade" id="modalEditExpediente{{ $expediente->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('expediente.update', $expediente) }}" method="POST" class="modal-content">
            @csrf @method('PUT')
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Editar Expediente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-4">
                    <label class="form-label">Fecha de Carga</label>
                    <input type="date" name="fecha_carga" class="form-control" value="{{ $expediente->fecha_carga }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Guía Remitente</label>
                    <input type="text" name="guia_remitente" class="form-control" value="{{ $expediente->guia_remitente }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Razón Social</label>
                    <input type="text" name="razon_social_empresa" class="form-control" value="{{ $expediente->razon_social_empresa }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Material</label>
                    <input type="text" name="material" class="form-control" value="{{ $expediente->material }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Total</label>
                    <input type="number" step="0.01" name="total" class="form-control" value="{{ $expediente->total }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Detracción</label>
                    <input type="number" step="0.01" name="detraccion" class="form-control" value="{{ $expediente->detraccion }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha de Pago</label>
                    <input type="date" name="fecha_pago" class="form-control" value="{{ $expediente->fecha_pago }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Comentarios</label>
                    <textarea name="comentarios" class="form-control" rows="2">{{ $expediente->comentarios }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
        </form>
    </div>
</div>
