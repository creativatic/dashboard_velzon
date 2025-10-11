<div class="modal fade" id="modalCreateSeguimiento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('seguimientos.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nuevo Seguimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="programacion_id" id="programacion_id">

                <div class="mb-3">
                    <label class="form-label">Notas</label>
                    <textarea name="notas" class="form-control" rows="3" placeholder="Agrega observaciones o comentarios..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar Seguimiento</button>
            </div>
        </form>
    </div>
</div>
