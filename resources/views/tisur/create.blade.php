<div class="modal fade" id="modalCreateTisur" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('tisur.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nuevo Registro TISUR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">N° Ticket</label>
                    <input type="text" name="numero_ticket" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Placa Tracto</label>
                    <input type="text" name="placa_tracto" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Razón Social</label>
                    <input type="text" name="razon_social" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Carga</label>
                    <input type="text" name="carga" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Peso Neto</label>
                    <input type="number" step="0.01" name="peso_neto" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Total</label>
                    <input type="number" step="0.01" name="total" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
