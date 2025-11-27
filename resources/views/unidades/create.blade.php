<div class="modal fade" id="modalCreateUnidad" tabindex="-1" aria-labelledby="modalCreateUnidadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nueva Unidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('unidades.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Placa Tracto</label>
                            <input type="text" name="placa_tracto" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Placa Carreta</label>
                            <input type="text" name="placa_carreta" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Marca Vehículo</label>
                            <input type="text" name="marca_vehiculo" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tipo Plataforma</label>
                            <input type="text" name="tipo_plataforma" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Constancia MTC Tracto</label>
                            <input type="text" name="constancia_mtc_tracto" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Constancia MTC Carreta</label>
                            <input type="text" name="constancia_mtc_carreta" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Proveedor</label>
                            <select name="proveedor_id" class="form-select" required>
                                <option value="">-- Seleccione un proveedor --</option>
                                {{-- Los proveedores se pasan desde el controlador Index --}}
                                @foreach($proveedores as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->razon_social }} ({{ $p->ruc_transporte }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>
