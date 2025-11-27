<!-- Modal Editar Proveedor -->
<div class="modal fade" id="modalEditProveedor{{ $proveedor->id }}" tabindex="-1" aria-labelledby="modalEditProveedorLabel{{ $proveedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="modalEditProveedorLabel{{ $proveedor->id }}">Editar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Razón Social</label>
                            <input type="text" name="razon_social" class="form-control" value="{{ $proveedor->razon_social }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">RUC</label>
                            <input type="text" name="ruc_transporte" class="form-control" value="{{ $proveedor->ruc_transporte }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banco</label>
                            <input type="text" name="banco" class="form-control" value="{{ $proveedor->banco }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cuenta</label>
                            <input type="text" name="cuenta_banco" class="form-control" value="{{ $proveedor->cuenta_banco }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">CCI</label>
                            <input type="text" name="cci_banco" class="form-control" value="{{ $proveedor->cci_banco }}">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-warning text-white">Actualizar</button>
                </div>
            </form>

        </div>
    </div>
</div>
