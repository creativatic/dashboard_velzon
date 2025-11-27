<div class="modal fade" id="modalEditUnidad{{ $unidad->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Editar Unidad - {{ $unidad->placa_tracto }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('unidades.update', $unidad->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Placa Tracto <span class="text-danger">*</span></label>
                            <input type="text" name="placa_tracto" class="form-control" value="{{ old('placa_tracto', $unidad->placa_tracto) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Placa Carreta</label>
                            <input type="text" name="placa_carreta" class="form-control" value="{{ old('placa_carreta', $unidad->placa_carreta) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Marca Vehículo <span class="text-danger">*</span></label>
                            <input type="text" name="marca_vehiculo" class="form-control" value="{{ old('marca_vehiculo', $unidad->marca_vehiculo) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tipo Plataforma</label>
                            <input type="text" name="tipo_plataforma" class="form-control" value="{{ old('tipo_plataforma', $unidad->tipo_plataforma) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Constancia MTC Tracto</label>
                            <input type="text" name="constancia_mtc_tracto" class="form-control" value="{{ old('constancia_mtc_tracto', $unidad->constancia_mtc_tracto) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Constancia MTC Carreta</label>
                            <input type="text" name="constancia_mtc_carreta" class="form-control" value="{{ old('constancia_mtc_carreta', $unidad->constancia_mtc_carreta) }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Proveedor <span class="text-danger">*</span></label>
                            <select name="proveedor_id" class="form-select" required>
                                <option value="">-- Seleccione un proveedor --</option>
                                @foreach($proveedores as $p)
                                    <option value="{{ $p->id }}" {{ $unidad->proveedor_id == $p->id ? 'selected' : '' }}>
                                        {{ $p->razon_social }} ({{ $p->ruc_transporte }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>