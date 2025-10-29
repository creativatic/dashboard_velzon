<!-- Modal Editar EPP -->
<div class="modal fade" id="editEppModal" tabindex="-1" aria-labelledby="editEppModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="editEppForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title text-white mb-3" id="editEppModalLabel">Editar EPP</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit_id">

                <div class="mb-3">
                    <label class="form-label">Código</label>
                    <input type="text" id="edit_codigo" name="codigo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" id="edit_nombre" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoría</label>
                    <input type="text" id="edit_categoria" name="categoria" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Talla</label>
                    <input type="text" id="edit_talla" name="talla" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" id="edit_stock" name="stock" class="form-control" min="0" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea id="edit_descripcion" name="descripcion" class="form-control"></textarea>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="edit_estado" name="estado" value="1">
                    <label class="form-check-label">Activo</label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </form>
    </div>
</div>
