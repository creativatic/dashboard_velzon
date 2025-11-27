<div class="modal fade" id="modalCreateConductor" tabindex="-1" aria-labelledby="modalCreateConductorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('conductores.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Registrar Conductor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">

                <div class="col-md-6">
                    <label class="form-label">DNI</label>
                    <input type="text" name="dni" class="form-control" required maxlength="8">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Licencia</label>
                    <input type="text" name="licencia" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nombres</label>
                    <input type="text" name="nombres" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Unidad Asociada</label>
                    <select name="unidad_id" class="form-select" required>
                        <option value="">Seleccione unidad</option>
                        @foreach($unidades as $u)
                        <option value="{{ $u->id }}">{{ $u->placa_tracto }} - {{ $u->placa_carreta }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
