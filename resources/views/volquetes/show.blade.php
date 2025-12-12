<div class="modal fade" id="modalShowVolquete{{ $volquete->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detalle del Volquete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <h5 class="fw-bold">Datos Generales</h5>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Fecha:</strong> {{ $volquete->fecha }}</p>
                        <p><strong>Proveedor:</strong> {{ $volquete->proveedor->razon_social ?? '-' }}</p>
                        <p><strong>Frente:</strong> {{ $volquete->detalleProgramacion->frente ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Factura:</strong> {{ $volquete->factura }}</p>
                        <p><strong>Conformidad:</strong> {{ $volquete->conformidad }}</p>
                        <p><strong>Observaciones:</strong> {{ $volquete->observaciones }}</p>
                    </div>
                </div>

                <h5 class="fw-bold mt-4">Detalles de Vueltas</h5>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Hora Vuelta 1:</strong> {{ $volquete->hora_vuelta_1 }}</p>
                        <p><strong>Lámparas Vuelta 1:</strong> {{ $volquete->lampadas_vuelta_1 }}</p>
                        <p><strong>Peso Vuelta 1:</strong> {{ $volquete->peso_vuelta_1 }}</p>
                    </div>

                    <div class="col-md-4">
                        <p><strong>Hora Vuelta 2:</strong> {{ $volquete->hora_vuelta_2 }}</p>
                        <p><strong>Lámparas Vuelta 2:</strong> {{ $volquete->lampadas_vuelta_2 }}</p>
                        <p><strong>Peso Vuelta 2:</strong> {{ $volquete->peso_vuelta_2 }}</p>
                    </div>

                    <div class="col-md-4">
                        <p><strong>Total Lámparas Día:</strong> {{ $volquete->total_lampadas_dia }}</p>
                        <p><strong>Total Peso Día:</strong> {{ $volquete->total_peso_dia }}</p>
                        <p><strong>Pasadas:</strong> {{ $volquete->pasadas }}</p>
                    </div>
                </div>

                <h5 class="fw-bold mt-4">Montos</h5>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Total S/:</strong> {{ $volquete->total }}</p>
                        <p><strong>Detracción:</strong> {{ $volquete->detraccion }}</p>
                    </div>

                    <div class="col-md-4">
                        <p><strong>Retención:</strong> {{ $volquete->retencion }}</p>
                        <p><strong>Depósito a Proveer:</strong> {{ $volquete->deposito_a_proveer }}</p>
                    </div>

                    <div class="col-md-4">
                        <p><strong>Depósito Total:</strong> {{ $volquete->deposito_total }}</p>
                        <p><strong>Fecha Pago:</strong> {{ $volquete->fecha_pago }}</p>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
