<!-- Modal Crear Programación -->
<div class="modal fade" id="createProgramacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form id="createProgramacionForm" action="{{ route('programacions.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Nueva Programación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <!-- Fecha -->
                    <div class="col-md-4">
                        <label class="form-label">Fecha Programación</label>
                        <input type="datetime-local" name="fecha_programacion" class="form-control" required>
                    </div>

                    <!-- Frente -->
                    <div class="col-md-4">
                        <label class="form-label">Frente</label>
                        <select name="detalle_programacion_id" class="form-select" required>
                            <option value="">Seleccione un frente...</option>
                            @foreach($detalles as $detalle)
                                <option value="{{ $detalle->id }}">
                                    {{ $detalle->frente }} — S/. {{ number_format($detalle->precio_frente, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Guía -->
                    <div class="col-md-4">
                        <label class="form-label">Guía Remisión</label>
                        <input type="text" name="guia_remision" class="form-control">
                    </div>

                    <!-- PROVEEDOR -->
                    <div class="col-md-4">
                        <label class="form-label">Proveedor</label>
                        <select name="proveedor_id" id="create-proveedor_id" class="form-select" required>
                            <option value="">Seleccione proveedor...</option>
                            @foreach($proveedores as $p)
                                <option value="{{ $p->id }}"
                                    data-ruc="{{ $p->ruc_transporte }}"
                                    data-razon="{{ $p->razon_social }}"
                                    data-banco="{{ $p->banco }}"
                                    data-cuenta="{{ $p->cuenta_banco }}"
                                    data-cci="{{ $p->cci_banco }}">
                                    {{ $p->razon_social }} — {{ $p->ruc_transporte }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- UNIDADES -->
                    <div class="col-md-4">
                        <label class="form-label">Unidad</label>
                        <select name="unidad_id" id="create-unidad_id" class="form-select" required>
                            <option value="">Seleccione unidad...</option>
                            @foreach($unidades as $u)
                                <option value="{{ $u->id }}">
                                    {{ $u->placa_tracto }} - {{ $u->placa_carreta }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- CONDUCTORES -->
                    <div class="col-md-4">
                        <label class="form-label">Conductor</label>
                        <select id="create-conductor_id" name="conductor_id" class="form-select" required>
                            <option value="">Seleccione conductor...</option>
                        </select>
                    </div>

                    <!-- Datos conductor -->
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" id="create-dni" name="dni" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nombres Conductor</label>
                        <input type="text" id="create-nombres_conductor" name="nombres_conductor" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Apellidos Conductor</label>
                        <input type="text" id="create-apellidos_conductor" name="apellidos_conductor" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" id="create-telefono_conductor" name="telefono_conductor" class="form-control" readonly>
                    </div>

                    <!-- Vehículo -->
                    <div class="col-md-4">
                        <label class="form-label">Placa Tracto</label>
                        <input type="text" id="create-placa_tracto" name="placa_tracto" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Placa Carreta</label>
                        <input type="text" id="create-placa_carreta" name="placa_carreta" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Marca Vehículo</label>
                        <input type="text" id="create-marca_vehiculo" name="marca_vehiculo" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tipo Plataforma</label>
                        <input type="text" id="create-tipo_plataforma" name="tipo_plataforma" class="form-control" readonly>
                    </div>

                    <!-- MTC -->
                    <div class="col-md-4">
                        <label class="form-label">Constancia MTC Tracto</label>
                        <input type="text" id="create-constancia_mtc_tracto" name="constancia_mtc_tracto" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Constancia MTC Carreta</label>
                        <input type="text" id="create-constancia_mtc_carreta" name="constancia_mtc_carreta" class="form-control" readonly>
                    </div>

                    <!-- Proveedor -->
                    <div class="col-md-4">
                        <label class="form-label">RUC Transporte</label>
                        <input type="text" id="create-ruc_transporte" name="ruc_transporte" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Razón Social Transporte</label>
                        <input type="text" id="create-razon_social_transporte" name="razon_social_transporte" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Cuenta Banco</label>
                        <input type="text" id="create-cuenta_banco" name="cuenta_banco" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">CCI Banco</label>
                        <input type="text" id="create-cci_banco" name="cci_banco" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Banco</label>
                        <input type="text" id="create-banco" name="banco" class="form-control" readonly>
                    </div>

                    <!-- Servicio -->
                    <div class="col-md-4">
                        <label class="form-label">Tipo Mineral</label>
                        <input type="text" id="create-tipo_mineral" name="tipo_mineral" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tipo Operación</label>
                        <select name="tipo_operacion" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="nacional">Nacional</option>
                            <option value="internacional">Internacional</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Conformidad Adelanto</label>
                        <select name="conformidad_adelanto" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="Ok">Ok</option>
                            <option value="Pendiente">Pendiente</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Guía Transportista</label>
                        <input type="text" name="guia_transportista" class="form-control">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS DINÁMICO -->
<script>
const proveedores = @json($proveedores);

const proveedorSelect  = document.getElementById('create-proveedor_id');
const unidadSelect     = document.getElementById('create-unidad_id');
const conductorSelect  = document.getElementById('create-conductor_id');


// CUANDO SE SELECCIONA PROVEEDOR
proveedorSelect.addEventListener('change', function () {

    let proveedor = proveedores.find(p => p.id == this.value);

    unidadSelect.innerHTML = `<option value="">Seleccione unidad...</option>`;
    conductorSelect.innerHTML = `<option value="">Seleccione conductor...</option>`;

    if (!proveedor) return;

    // AUTOCOMPLETAR DATOS DEL PROVEEDOR
    document.getElementById('create-ruc_transporte').value = this.selectedOptions[0].dataset.ruc;
    document.getElementById('create-razon_social_transporte').value = this.selectedOptions[0].dataset.razon;
    document.getElementById('create-cuenta_banco').value = this.selectedOptions[0].dataset.cuenta;
    document.getElementById('create-cci_banco').value = this.selectedOptions[0].dataset.cci;
    document.getElementById('create-banco').value = this.selectedOptions[0].dataset.banco;

    // CARGAR UNIDADES
    proveedor.unidades.forEach(u => {
        unidadSelect.innerHTML += `<option value="${u.id}">
            ${u.placa_tracto} / ${u.placa_carreta}
        </option>`;
    });
});


// CUANDO SE SELECCIONA UNIDAD
unidadSelect.addEventListener('change', function () {

    let proveedor = proveedores.find(p => p.id == proveedorSelect.value);
    let unidad = proveedor?.unidades.find(u => u.id == this.value);

    conductorSelect.innerHTML = `<option value="">Seleccione conductor...</option>`;

    if (!unidad) return;

    // AUTOCOMPLETAR DATOS DE LA UNIDAD
    document.getElementById('create-placa_tracto').value = unidad.placa_tracto ?? '';
    document.getElementById('create-placa_carreta').value = unidad.placa_carreta ?? '';
    document.getElementById('create-marca_vehiculo').value = unidad.marca_vehiculo ?? '';
    document.getElementById('create-tipo_plataforma').value = unidad.tipo_plataforma ?? '';
    document.getElementById('create-constancia_mtc_tracto').value = unidad.constancia_mtc_tracto ?? '';
    document.getElementById('create-constancia_mtc_carreta').value = unidad.constancia_mtc_carreta ?? '';

    // CARGAR CONDUCTORES RELACIONADOS A ESA UNIDAD
    unidad.conductores.forEach(c => {
        conductorSelect.innerHTML += `<option value="${c.id}">
            ${c.nombres} ${c.apellidos} — Lic: ${c.licencia}
        </option>`;
    });
});


// CUANDO SE SELECCIONA CONDUCTOR (NUEVO, SIN FETCH)
conductorSelect.addEventListener('change', function () {

    let proveedor = proveedores.find(p => p.id == proveedorSelect.value);
    let unidad    = proveedor?.unidades.find(u => u.id == unidadSelect.value);
    let conductor = unidad?.conductores.find(c => c.id == this.value);

    if (!conductor) return;

    // AUTOCOMPLETAR DATOS DEL CONDUCTOR
    document.getElementById('create-dni').value                 = conductor.dni ?? '';
    document.getElementById('create-nombres_conductor').value   = conductor.nombres ?? '';
    document.getElementById('create-apellidos_conductor').value = conductor.apellidos ?? '';
    document.getElementById('create-telefono_conductor').value  = conductor.telefono ?? '';
});
</script>
