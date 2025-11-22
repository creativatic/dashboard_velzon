<div class="modal fade" id="importEntregaModal" tabindex="-1" aria-labelledby="importEntregaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="ri-upload-cloud-line"></i> Importar registros desde Excel KARDEX MES DE OCTUBRE
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('entregas.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="alert alert-info">
                        El archivo debe contener estas columnas:<br>
                        <b>dni, nombres_apellidos, epp, cantidad, fecha_entrega, numero_vale, orden_trabajo, observacion</b>
                    </div>

                    <input type="file" name="archivo" class="form-control" required accept=".xlsx,.xls">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary"><i class="ri-upload-line"></i> Importar</button>
                </div>

            </form>
        </div>
    </div>
</div>
