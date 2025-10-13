<div class="modal fade" id="modalEditSeguimiento{{ $seguimiento->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('seguimientos.update', $seguimiento->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Editar Seguimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Notas</label>
                    <textarea name="notas" class="form-control" rows="3">{{ $seguimiento->notas }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
        </form>
    </div>
</div>
