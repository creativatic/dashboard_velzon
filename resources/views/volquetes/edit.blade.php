<div class="modal fade" id="modalEditVolquete{{ $volquete->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('volquetes.update', $volquete->id) }}">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Editar Volquete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Placa</label>
                            <input type="text" name="placa" class="form-control" value="{{ $volquete->placa }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Marca</label>
                            <input type="text" name="marca" class="form-control" value="{{ $volquete->marca }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Modelo</label>
                            <input type="text" name="modelo" class="form-control" value="{{ $volquete->modelo }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Año</label>
                            <input type="number" name="anio" class="form-control" value="{{ $volquete->anio }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Constancia MTC</label>
                            <input type="text" name="constancia_mtc" class="form-control" value="{{ $volquete->constancia_mtc }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Proveedor</label>
                            <select name="proveedor_id" class="form-select" required>
                                @foreach($proveedores as $p)
                                    <option value="{{ $p->id }}" {{ $volquete->proveedor_id == $p->id ? 'selected' : '' }}>
                                        {{ $p->razon_social }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-warning">Actualizar</button>
                </div>

            </div>

        </form>
    </div>
</div>
