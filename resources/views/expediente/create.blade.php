<div class="modal fade" id="modalCreateExpediente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('expediente.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nuevo Expediente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">

                {{-- === SELECT DE GUIA REMISION (PROGRAMACIÓN) === --}}
                <div class="col-md-6">
                    <label class="form-label">Guía de Remisión</label>
                    <select name="programacion_id" id="programacion_id" class="form-select" required>
                        <option value="">-- Seleccione una guía --</option>
                        @foreach ($programacions as $programacion)
                            <option value="{{ $programacion->id }}">{{ $programacion->guia_remision }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- === DATOS AUTOMÁTICOS DE PROGRAMACIÓN === --}}
                <div class="col-md-3">
                    <label class="form-label">Placa Tracto</label>
                    <input type="text" id="placa_tracto" class="form-control" readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Placa Carreta</label>
                    <input type="text" id="placa_carreta" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Razón Social Empresa</label>
                    <input type="text" id="razon_social_empresa" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">RUC</label>
                    <input type="text" id="ruc" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Guía Transportista</label>
                    <input type="text" id="guia_transportista" class="form-control" readonly>
                </div>

                <hr class="mt-3 mb-3">

                {{-- === SELECT DE NÚMERO DE TICKET (TISUR) === --}}
                <div class="col-md-6">
                    <label class="form-label">Número de Ticket (Tisur)</label>
                    <select name="tisur_id" id="tisur_id" class="form-select" required>
                        <option value="">-- Seleccione un ticket --</option>
                        @foreach ($tisurs as $tisur)
                            <option value="{{ $tisur->id }}">{{ $tisur->numero_ticket }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- === DATOS AUTOMÁTICOS DE TISUR === --}}
                <div class="col-md-3">
                    <label class="form-label">Fecha Ingreso</label>
                    <input type="text" id="fecha_hora_ingreso" class="form-control" readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Peso Neto</label>
                    <input type="text" id="peso_neto" class="form-control" readonly>
                </div>

                <hr class="mt-3 mb-3">

                {{-- === SELECT DE FRENTE (DETALLE PROGRAMACIÓN) === --}}
                <div class="col-md-6">
                    <label class="form-label">Frente</label>
                    <select name="detalle_programacion_id" id="detalle_programacion_id" class="form-select" required>
                        <option value="">-- Seleccione un frente --</option>
                        @foreach ($detalles as $detalle)
                            <option value="{{ $detalle->id }}">{{ $detalle->frente }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- === DATOS AUTOMÁTICOS DE FRENTE === --}}
                <div class="col-md-3">
                    <label class="form-label">Precio Frente</label>
                    <input type="text" id="precio_frente" class="form-control" readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Precio TN</label>
                    <input type="text" id="precio_tn" class="form-control" readonly>
                </div>

                <hr class="mt-3 mb-3">

                {{-- === CAMPOS DEL EXPEDIENTE === --}}
                <div class="col-md-4">
                    <label class="form-label">N° Factura Expediente</label>
                    <input type="text" name="numero_factura_exped" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Total (S/)</label>
                    <input type="number" step="0.01" name="total" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Detracción (S/)</label>
                    <input type="number" step="0.01" name="detraccion" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Fecha de Pago</label>
                    <input type="date" name="fecha_pago" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Comentarios</label>
                    <textarea name="comentarios" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- === SCRIPTS PARA CARGAR DATOS DINÁMICOS === --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    // === Cargar datos de PROGRAMACIÓN ===
    document.getElementById('programacion_id').addEventListener('change', function() {
        const id = this.value;
        if (id) {
            fetch(`/expediente/programacion/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('placa_tracto').value = data.placa_tracto ?? '';
                    document.getElementById('placa_carreta').value = data.placa_carreta ?? '';
                    document.getElementById('razon_social_empresa').value = data.razon_social_transporte ?? '';
                    document.getElementById('ruc').value = data.ruc_transporte ?? '';
                    document.getElementById('guia_transportista').value = data.guia_transportista ?? '';
                });
        }
    });

    // === Cargar datos de TISUR ===
    document.getElementById('tisur_id').addEventListener('change', function() {
        const id = this.value;
        if (id) {
            fetch(`/expediente/tisur/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('fecha_hora_ingreso').value = data.fecha_hora_ingreso ?? '';
                    document.getElementById('peso_neto').value = data.peso_neto ?? '';
                });
        }
    });

    // === Cargar datos del FRENTE ===
    document.getElementById('detalle_programacion_id').addEventListener('change', function() {
        const id = this.value;
        if (id) {
            fetch(`/expediente/detalle/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('precio_frente').value = data.precio_frente ?? '';
                    document.getElementById('precio_tn').value = data.precio_tn ?? '';
                });
        }
    });

});
</script>
