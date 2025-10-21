<div class="modal fade" id="modalCreateExpediente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('expediente.store') }}" method="POST" class="modal-content" enctype="multipart/form-data">
            @csrf

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nuevo Expediente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">

                {{-- === AUTOCOMPLET DE GUIA REMISION (PROGRAMACIÓN) === --}}
                <div class="col-md-6 position-relative">
                    <label class="form-label">Guía de Remisión</label>
                    <input type="text" id="programacion_search" class="form-control" placeholder="Buscar guía..." autocomplete="off">
                    <input type="hidden" name="programacion_id" id="programacion_id">
                    <div id="programacion_suggestions" class="list-group position-absolute w-100" style="z-index:1055; display:none;"></div>
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
                    <label class="form-label">Peso Neto (U)</label>
                    <input type="number" id="peso_neto" class="form-control" readonly>
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
                    <label class="form-label">Precio TN (V)</label>
                    <input type="number" id="precio_tn" class="form-control" readonly>
                </div>

                <hr class="mt-3 mb-3">

                {{-- === CAMPOS CALCULADOS === --}}
                <div class="col-md-3">
                    <label class="form-label">Estado Pago Detracción (Y)</label>
                    <select id="estado_pago_detraccion" class="form-select">
                        <option value="Pagado">Pagado</option>
                        <option value="No Pagado">No Pagado</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Total (W)</label>
                    <input type="number" step="0.01" name="total" id="total" class="form-control" readonly>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Detracción (X)</label>
                    <input type="number" step="0.01" name="detraccion" id="detraccion" class="form-control" readonly>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Total + Detracción (Z)</label>
                    <input type="number" step="0.01" id="total_con_detraccion" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Depósito a Proveer (AA)</label>
                    <input type="number" step="0.01" name="deposito_a_proveer" id="deposito_a_proveer" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Fecha de Pago</label>
                    <input type="date" name="fecha_pago" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Archivo (PDF, JPG, DOCX...)</label>
                    <input type="file" name="archivo" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
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

<script>

document.addEventListener('DOMContentLoaded', function() {

    let valorAdelanto = 500; // 🔹 Simulado (BUSCARV de hoja Adelantos)

    const pesoNeto = document.getElementById('peso_neto');
    const precioTN = document.getElementById('precio_tn');
    const estadoPago = document.getElementById('estado_pago_detraccion');
    const total = document.getElementById('total');
    const detraccion = document.getElementById('detraccion');
    const totalConDetraccion = document.getElementById('total_con_detraccion');
    const deposito = document.getElementById('deposito_a_proveer');

    function recalcular() {
        const peso = parseFloat(pesoNeto.value) || 0;
        const precio = parseFloat(precioTN.value) || 0;
        const estado = estadoPago.value;

        const totalCalc = precio * peso;             // W
        const detracCalc = totalCalc * 0.04;         // X
        const totalDetr = (estado === 'No Pagado') 
                            ? (totalCalc - detracCalc)
                            : totalCalc;             // Z
        const depositoCalc = totalDetr - valorAdelanto; // AA

        total.value = totalCalc.toFixed(2);
        detraccion.value = detracCalc.toFixed(2);
        totalConDetraccion.value = totalDetr.toFixed(2);
        deposito.value = depositoCalc.toFixed(2);
    }

    // === Eventos de recalculo ===
    pesoNeto.addEventListener('input', recalcular);
    precioTN.addEventListener('input', recalcular);
    estadoPago.addEventListener('change', recalcular);

    // === Cargar datos dinámicos ===
    document.getElementById('programacion_id').addEventListener('change', function() {
        const id = this.value;
        if (id) {
            fetch(`/expediente/programacion/${id}`)
                .then(r => r.json())
                .then(d => {
                    document.getElementById('placa_tracto').value = d.placa_tracto ?? '';
                    document.getElementById('placa_carreta').value = d.placa_carreta ?? '';
                    document.getElementById('razon_social_empresa').value = d.razon_social_transporte ?? '';
                    document.getElementById('ruc').value = d.ruc_transporte ?? '';
                    document.getElementById('guia_transportista').value = d.guia_transportista ?? '';
                });
        }
    });

    document.getElementById('tisur_id').addEventListener('change', function() {
        const id = this.value;
        if (id) {
            fetch(`/expediente/tisur/${id}`)
                .then(r => r.json())
                .then(d => {
                    document.getElementById('fecha_hora_ingreso').value = d.fecha_hora_ingreso ?? '';
                    document.getElementById('peso_neto').value = d.peso_neto ?? '';
                    recalcular();
                });
        }
    });

    document.getElementById('detalle_programacion_id').addEventListener('change', function() {
        const id = this.value;
        if (id) {
            fetch(`/expediente/detalle/${id}`)
                .then(r => r.json())
                .then(d => {
                    document.getElementById('precio_frente').value = d.precio_frente ?? '';
                    document.getElementById('precio_tn').value = d.precio_tn ?? '';
                    recalcular();
                });
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('programacion_search');
    const hidden = document.getElementById('programacion_id');
    const suggestions = document.getElementById('programacion_suggestions');

    let timeout = null;

    input.addEventListener('input', function() {
        const query = this.value.trim();
        hidden.value = ''; // limpiamos el ID

        if (query.length < 2) {
            suggestions.style.display = 'none';
            return;
        }

        clearTimeout(timeout);
        timeout = setTimeout(() => {
            fetch(`/programaciones/search?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    suggestions.innerHTML = '';
                    if (data.length === 0) {
                        suggestions.style.display = 'none';
                        return;
                    }

                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.classList.add('list-group-item', 'list-group-item-action');
                        div.textContent = item.guia_remision;
                        div.addEventListener('click', () => {
                            input.value = item.guia_remision;
                            hidden.value = item.id;
                            suggestions.style.display = 'none';
                            // autollenar los campos relacionados
                            document.getElementById('placa_tracto').value = item.placa_tracto || '';
                            document.getElementById('placa_carreta').value = item.placa_carreta || '';
                            document.getElementById('razon_social_empresa').value = item.razon_social_transporte || '';
                            document.getElementById('ruc').value = item.ruc_transporte || '';
                            document.getElementById('guia_transportista').value = item.guia_transportista || '';
                        });
                        suggestions.appendChild(div);
                    });

                    suggestions.style.display = 'block';
                });
        }, 300); // retraso de 300 ms para evitar exceso de peticiones
    });

    // Ocultar sugerencias si se hace clic fuera
    document.addEventListener('click', function(e) {
        if (!suggestions.contains(e.target) && e.target !== input) {
            suggestions.style.display = 'none';
        }
    });
});
</script>
