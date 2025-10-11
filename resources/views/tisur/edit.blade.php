<div class="modal fade" id="modalEditTisur{{ $tisur->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('tisur.update', $tisur) }}" method="POST" class="modal-content">
            @csrf @method('PUT')
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Editar Registro TISUR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">N° Ticket</label>
                    <input type="text" name="numero_ticket" class="form-control" value="{{ $tisur->numero_ticket }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Placa Tracto</label>
                    <input type="text" name="placa_tracto" class="form-control" value="{{ $tisur->placa_tracto }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Razón Social</label>
                    <input type="text" name="razon_social" class="form-control" value="{{ $tisur->razon_social }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Carga</label>
                    <input type="text" name="carga" class="form-control" value="{{ $tisur->carga }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Peso Neto</label>
                    <input type="number" step="0.01" name="peso_neto" class="form-control" value="{{ $tisur->peso_neto }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Total</label>
                    <input type="number" step="0.01" name="total" class="form-control" value="{{ $tisur->total }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
        </form>
    </div>
</div>
