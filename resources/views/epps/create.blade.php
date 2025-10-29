<!-- Modal Crear EPP -->
<div class="modal fade" id="createEppModal" tabindex="-1" aria-labelledby="createEppModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('epps.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createEppModalLabel">Agregar EPP</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Código</label>
                    <input type="text" name="codigo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoría</label>
                    <input type="text" name="categoria" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Talla</label>
                    <input type="text" name="talla" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" min="0" value="0" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control"></textarea>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="estado" value="1" checked>
                    <label class="form-check-label">Activo</label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
