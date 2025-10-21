<!-- Modal Crear Frente -->
<div class="modal fade" id="createFrenteModal" tabindex="-1" aria-labelledby="createFrenteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('detalleprogramacion.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="createFrenteModalLabel">Nuevo Frente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
              

                {{-- Frente --}}
                <div class="mb-3">
                    <label for="frente" class="form-label">Frente</label>
                    <input 
                        type="text" 
                        name="frente" 
                        id="frente" 
                        class="form-control" 
                        placeholder="Ejemplo: Huanaco, Intikal, Mina Central" 
                        required>
                </div>

                <div class="row">
                    {{-- Precio Frente --}}
                    <div class="col-md-6 mb-3">
                        <label for="precio_frente" class="form-label">Precio Frente (S/)</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="precio_frente" 
                            id="precio_frente" 
                            class="form-control" 
                            placeholder="0.00" 
                            required>
                    </div>

                    {{-- Precio TN --}}
                    <div class="col-md-6 mb-3">
                        <label for="precio_tn" class="form-label">Precio TN (S/)</label>
                        <input 
                            type="number" 
                            step="any" 
                            name="precio_tn" 
                            id="precio_tn" 
                            class="form-control" 
                            placeholder="0.0000" 
                            required>
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea 
                        name="descripcion" 
                        id="descripcion" 
                        class="form-control" 
                        rows="3" 
                        placeholder="Descripción opcional del frente"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-3-line"></i> Guardar Frente
                </button>
            </div>
        </form>
    </div>
</div>