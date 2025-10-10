<!-- Modal Editar Frente -->
<div class="modal fade" id="editFrenteModal" tabindex="-1" aria-labelledby="editFrenteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editFrenteForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_frente_id" name="id">
            
            <div class="modal-header">
                <h5 class="modal-title" id="editFrenteModalLabel">Editar Frente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                {{-- Programación --}}
                <div class="mb-3">
                    <label for="edit_programacion_id" class="form-label">Programación</label>
                    <select name="programacion_id" id="edit_programacion_id" class="form-select" required>
                        <option value="">Seleccionar Programación</option>
                        @foreach($programaciones as $programacion)
                            <option value="{{ $programacion->id }}">
                                {{ $programacion->guia_remision }} - {{ \Carbon\Carbon::parse($programacion->fecha)->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Frente --}}
                <div class="mb-3">
                    <label for="edit_frente" class="form-label">Frente</label>
                    <input 
                        type="text" 
                        name="frente" 
                        id="edit_frente" 
                        class="form-control" 
                        placeholder="Ejemplo: Huanaco, Intikal, Mina Central" 
                        required>
                </div>

                <div class="row">
                    {{-- Precio Frente --}}
                    <div class="col-md-6 mb-3">
                        <label for="edit_precio_frente" class="form-label">Precio Frente (S/)</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="precio_frente" 
                            id="edit_precio_frente" 
                            class="form-control" 
                            placeholder="0.00" 
                            required>
                    </div>

                    {{-- Precio TN --}}
                    <div class="col-md-6 mb-3">
                        <label for="edit_precio_tn" class="form-label">Precio TN (S/)</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="precio_tn" 
                            id="edit_precio_tn" 
                            class="form-control" 
                            placeholder="0.00" 
                            required>
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label for="edit_descripcion" class="form-label">Descripción</label>
                    <textarea 
                        name="descripcion" 
                        id="edit_descripcion" 
                        class="form-control" 
                        rows="3" 
                        placeholder="Descripción opcional del frente"></textarea>
                </div>

                {{-- Estado --}}
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input 
                            type="checkbox" 
                            name="activo" 
                            id="edit_activo" 
                            class="form-check-input" 
                            value="1" 
                            checked>
                        <label for="edit_activo" class="form-check-label">Activo</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-3-line"></i> Actualizar Frente
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configurar el formulario de edición
    const editForm = document.getElementById('editFrenteForm');
    editForm.addEventListener('submit', function(e) {
        const frenteId = document.getElementById('edit_frente_id').value;
        this.action = '/detalleprogramacion/' + frenteId;
    });
});
</script>