<!-- Modal Editar Programación -->
<div class="modal fade" id="editProgramacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form id="editProgramacionForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Editar Programación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <!-- FECHA -->
                    <div class="col-md-4">
                        <label class="form-label">Fecha Programación</label>
                        <input type="datetime-local" name="fecha_programacion"
                               id="edit-fecha_programacion" class="form-control" required>
                    </div>

                    <!-- DETALLE PROGRAMACION -->
                    <div class="col-md-4">
                        <label class="form-label">Frente</label>
                        <select name="detalle_programacion_id" id="edit-detalle_programacion_id"
                                class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($detalles as $detalle)
                                <option value="{{ $detalle->id }}">
                                    {{ $detalle->frente }} — S/.{{ number_format($detalle->precio_frente, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- GUIA REMISIÓN -->
                    <div class="col-md-4">
                        <label class="form-label">Guía Remisión</label>
                        <input type="text" id="edit-guia_remision" name="guia_remision" class="form-control">
                    </div>

                    <!-- CONDUCTOR -->
                    <div class="col-md-4">
                        <label class="form-label">Licencia Conductor</label>
                            <select name="licencia" id="edit-licencia" class="form-select" required>
                                <option value="">Seleccione un conductor...</option>
                                @foreach($conductores as $c)
                                    <option value="{{ $c->licencia }}"
                                        data-dni="{{ $c->dni }}"
                                        data-nombres="{{ $c->nombres }}"
                                        data-apellidos="{{ $c->apellidos }}"
                                        data-telefono="{{ $c->telefono }}"
                                        data-unidad="{{ $c->unidad->id ?? '' }}"
                                        data-proveedor="{{ $c->unidad->proveedor->id ?? '' }}">
                                        {{ $c->licencia }} — {{ $c->nombres }} {{ $c->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                    </div>

                    <!-- DATOS DEL CONDUCTOR -->
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" id="edit-dni" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nombres</label>
                        <input type="text" id="edit-nombres_conductor" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Apellidos</label>
                        <input type="text" id="edit-apellidos_conductor" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" id="edit-telefono_conductor" class="form-control" readonly>
                    </div>

                    <!-- VEHICULO -->
                    <div class="col-md-4">
                        <label class="form-label">Placa Tracto</label>
                        <input type="text" id="edit-placa_tracto" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Placa Carreta</label>
                        <input type="text" id="edit-placa_carreta" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Marca Vehículo</label>
                        <input type="text" id="edit-marca_vehiculo" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tipo Plataforma</label>
                        <input type="text" id="edit-tipo_plataforma" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Constancia MTC Tracto</label>
                        <input type="text" id="edit-constancia_mtc_tracto" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Constancia MTC Carreta</label>
                        <input type="text" id="edit-constancia_mtc_carreta" class="form-control" readonly>
                    </div>

                    <!-- PROVEEDOR -->
                    <!--
                    <div class="col-md-4">
                        <label class="form-label">Proveedor</label>
                        <select id="edit-proveedor_id" name="proveedor_id" class="form-select" required>
                            <option value="">Seleccione...</option>
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
                    -->

                    <!-- UNIDAD -->
                    <!--
                    <div class="col-md-4">
                        <label class="form-label">Unidad</label>
                        <select id="edit-unidad_id" name="unidad_id" class="form-select" required>
                            <option value="">Seleccione unidad...</option>
                        </select>
                    </div>
                    -->

                    <!-- DATOS PROVEEDOR -->
                    <div class="col-md-4">
                        <label class="form-label">Razón Social</label>
                        <input type="text" id="edit-razon_social_transporte" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Cuenta Banco</label>
                        <input type="text" id="edit-cuenta_banco" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">CCI</label>
                        <input type="text" id="edit-cci_banco" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Banco</label>
                        <input type="text" id="edit-banco" class="form-control" readonly>
                    </div>

                    <!-- MINERAL -->
                    <div class="col-md-4">
                        <label class="form-label">Tipo Mineral</label>
                        <input type="text" id="edit-tipo_mineral" class="form-control">
                    </div>

                    <!-- TIPO OPERACION -->
                    <div class="col-md-4">
                        <label class="form-label">Tipo Operación</label>
                        <select id="edit-tipo_operacion" name="tipo_operacion" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="nacional">Nacional</option>
                            <option value="internacional">Internacional</option>
                        </select>
                    </div>

                    <!-- CONFORMIDAD ADELANTO -->
                    <div class="col-md-4">
                        <label class="form-label">Conformidad Adelanto</label>
                        <select id="edit-conformidad_adelanto" name="conformidad_adelanto" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="Ok">Ok</option>
                            <option value="Pendiente">Pendiente</option>
                        </select>
                    </div>

                    <!-- MONTO ADELANTO -->
                    <div class="col-md-4">
                        <label class="form-label">Monto Adelanto (S/)</label>
                        <input type="number" step="0.01" min="0" id="edit-monto_adelanto" name="monto_adelanto"
                               class="form-control">
                    </div>

                    <!-- GUIA TRANSPORTISTA -->
                    <div class="col-md-4">
                        <label class="form-label">Guía Transportista</label>
                        <input type="text" id="edit-guia_transportista" name="guia_transportista" class="form-control">
                    </div>

                    <!-- GRUPO CARGUÍO -->
                    <div class="col-md-4">
                        <label class="form-label">Grupo Carguío</label>
                        <input type="text" id="edit-grupo_cargio" name="grupo_cargio" class="form-control">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    Actualizar
                </button>
            </div>

        </form>
    </div>
</div>

<script>

// ============================================================
// FUNCIÓN PRINCIPAL PARA ABRIR EL MODAL DE EDICIÓN
// ============================================================
function openEditProgramacionModal(data) {

    // Ruta del PUT
    document.getElementById("editProgramacionForm").action = "/programacions/" + data.id;

    // Campos generales
    if (data.fecha_programacion) {
        let fecha = new Date(data.fecha_programacion);
        let yyyy = fecha.getFullYear();
        let mm = String(fecha.getMonth() + 1).padStart(2, '0');
        let dd = String(fecha.getDate()).padStart(2, '0');
        let hh = String(fecha.getHours()).padStart(2, '0');
        let min = String(fecha.getMinutes()).padStart(2, '0');

        document.getElementById('edit-fecha_programacion').value = `${yyyy}-${mm}-${dd}T${hh}:${min}`;
    } else {
        document.getElementById('edit-fecha_programacion').value = '';
    }

    document.getElementById('edit-detalle_programacion_id').value = data.detalle_programacion_id;
    document.getElementById('edit-guia_remision').value = data.guia_remision ?? "";

    // Conductor
    document.getElementById('edit-licencia').value = data.conductor?.licencia ?? "";

    // ===========================================
    // NUEVO: MOSTRAR CONFORMIDAD ADELANTO
    // ===========================================
    document.getElementById('edit-conformidad_adelanto').value = data.conformidad_adelanto ?? "";

    // ===========================================
    // NUEVO: TIPO OPERACION
    // ===========================================
    document.getElementById('edit-tipo_operacion').value = data.tipo_operacion ?? "";

    // ===========================================
    // NUEVO: CAMPOS DE PROVEEDOR
    // ===========================================
    // document.getElementById('edit-proveedor_id').value = data.proveedor_id ?? "";

    document.getElementById('edit-tipo_mineral').value = data.tipo_mineral ?? "";
    document.getElementById('edit-guia_transportista').value = data.guia_transportista ?? "";
    document.getElementById('edit-grupo_cargio').value = data.grupo_cargio ?? "";
    document.getElementById('edit-monto_adelanto').value = data.monto_adelanto ?? "";

    // Cargar unidades del proveedor
    if (data.proveedor_id) {
        loadUnidadesForProveedor(data.proveedor_id, data.unidad_id);
    }

    // ===========================================
    // Cargar datos del conductor si ya existía
    // ===========================================
    if (data.conductor?.licencia) {
        document.getElementById('edit-licencia').value = data.conductor.licencia;

        fetch(`/conductores/licencia/${data.conductor.licencia}`)
            .then(res => res.json())
            .then(c => fillConductorFields(c));
    }
    // Mostrar modal
    let modal = new bootstrap.Modal(document.getElementById('editProgramacionModal'));
    modal.show();
}


// ============================================================
// FUNCIÓN PARA LLENAR LOS CAMPOS DEL CONDUCTOR
// ============================================================
function fillConductorFields(c) {

    document.getElementById('edit-dni').value = c.dni ?? '';
    document.getElementById('edit-nombres_conductor').value = c.nombres ?? '';
    document.getElementById('edit-apellidos_conductor').value = c.apellidos ?? '';
    document.getElementById('edit-telefono_conductor').value = c.telefono ?? '';

    document.getElementById('edit-placa_tracto').value = c.placa_tracto ?? '';
    document.getElementById('edit-placa_carreta').value = c.placa_carreta ?? '';
    document.getElementById('edit-marca_vehiculo').value = c.marca_vehiculo ?? '';
    document.getElementById('edit-tipo_plataforma').value = c.tipo_plataforma ?? '';

    document.getElementById('edit-constancia_mtc_tracto').value = c.constancia_mtc_tracto ?? '';
    document.getElementById('edit-constancia_mtc_carreta').value = c.constancia_mtc_carreta ?? '';

    document.getElementById('edit-razon_social_transporte').value = c.razon_social_transporte ?? '';
    document.getElementById('edit-cuenta_banco').value = c.cuenta_banco ?? '';
    document.getElementById('edit-cci_banco').value = c.cci_banco ?? '';
    document.getElementById('edit-banco').value = c.banco ?? '';

    document.getElementById('edit-tipo_mineral').value = c.tipo_mineral ?? '';
}


// ============================================================
// CUANDO CAMBIA EL SELECT DE CONDUCTOR
// ============================================================
document.getElementById('edit-licencia').addEventListener('change', function () {
    let licencia = this.value;
    if (!licencia) return;

    fetch(`/conductores/licencia/${licencia}`)
        .then(res => res.json())
        .then(c => fillConductorFields(c));
});


// ============================================================
// CARGAR UNIDADES DEL PROVEEDOR PARA EL EDIT
// ============================================================
function loadUnidadesForProveedor(proveedorId, selectedUnidadId) {

    fetch(`/proveedores/${proveedorId}/unidades`)
        .then(res => res.json())
        .then(unidades => {

            let unidadSelect = document.getElementById("edit-unidad_id");
            unidadSelect.innerHTML = `<option value="">Seleccione unidad...</option>`;

            unidades.forEach(u => {
                let selected = u.id == selectedUnidadId ? "selected" : "";
                unidadSelect.innerHTML += `
                    <option value="${u.id}" ${selected}>
                        ${u.placa_tracto} / ${u.placa_carreta}
                    </option>
                `;
            });
        });
}

</script>
