<div class="modal fade" id="modalCreateProveedor" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nuevo Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Razón Social</label>
                            <input type="text" name="razon_social" class="form-control" value="{{ old('razon_social') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label>RUC</label>
                            <input type="text" name="ruc_transporte" class="form-control" value="{{ old('ruc_transporte') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label>Banco</label>
                            <input type="text" name="banco" class="form-control" value="{{ old('banco') }}">
                        </div>

                        <div class="col-md-4">
                            <label>Cuenta Banco</label>
                            <input type="text" name="cuenta_banco" class="form-control" value="{{ old('cuenta_banco') }}">
                        </div>

                        <div class="col-md-4">
                            <label>CCI</label>
                            <input type="text" name="cci_banco" class="form-control" value="{{ old('cci_banco') }}">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>

            @if ($errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        let modal = new bootstrap.Modal(document.getElementById('modalCreateProveedor'));
                        modal.show();
                    });
                </script>
            @endif


        </div>
    </div>
</div>
