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
                    <!-- CONDUCTOR -->
                    <div class="col-md-4">
                        <label class="form-label">Licencia Conductor</label>
                        <input type="text" id="edit-licencia" class="form-control" readonly>
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
const el = id => document.getElementById(id);

function formatDatetimeLocal(value) {
    if (!value) return '';
    const d = new Date(value);
    return `${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')}T${String(d.getHours()).padStart(2,'0')}:${String(d.getMinutes()).padStart(2,'0')}`;
}

function openEditProgramacionModal(data) {

    el('editProgramacionForm').action = `/programacions/${data.id}`;

    /* =====================
       PROGRAMACIÓN
    ===================== */
    el('edit-fecha_programacion').value = formatDatetimeLocal(data.fecha_programacion);
    el('edit-detalle_programacion_id').value = data.detalle_programacion_id ?? '';
    el('edit-guia_remision').value = data.guia_remision ?? '';
    el('edit-tipo_operacion').value = data.tipo_operacion ?? '';
    el('edit-conformidad_adelanto').value = data.conformidad_adelanto ?? '';
    el('edit-monto_adelanto').value = data.monto_adelanto ?? '';
    el('edit-guia_transportista').value = data.guia_transportista ?? '';
    el('edit-grupo_cargio').value = data.grupo_cargio ?? '';
    el('edit-tipo_mineral').value = data.tipo_mineral ?? '';

    /* =====================
       RELACIONES REALES
    ===================== */
    const proveedor = data.proveedor ?? null;
    const unidad    = data.unidad ?? null;
    const conductor = data.conductor ?? null;

    /* =====================
       CONDUCTOR
    ===================== */
    el('edit-licencia').value = conductor?.licencia ?? '';
    el('edit-dni').value = conductor?.dni ?? '';
    el('edit-nombres_conductor').value = conductor?.nombres ?? '';
    el('edit-apellidos_conductor').value = conductor?.apellidos ?? '';
    el('edit-telefono_conductor').value = conductor?.telefono ?? '';

    /* =====================
       VEHÍCULO
    ===================== */
    el('edit-placa_tracto').value = unidad?.placa_tracto ?? '';
    el('edit-placa_carreta').value = unidad?.placa_carreta ?? '';
    el('edit-marca_vehiculo').value = unidad?.marca ?? '';
    el('edit-tipo_plataforma').value = unidad?.tipo_plataforma ?? '';
    el('edit-constancia_mtc_tracto').value = unidad?.mtc_tracto ?? '';
    el('edit-constancia_mtc_carreta').value = unidad?.mtc_carreta ?? '';

    /* =====================
       PROVEEDOR
    ===================== */
    el('edit-razon_social_transporte').value = proveedor?.razon_social ?? '';
    el('edit-cuenta_banco').value = proveedor?.cuenta_banco ?? '';
    el('edit-cci_banco').value = proveedor?.cci_banco ?? '';
    el('edit-banco').value = proveedor?.banco ?? '';

    new bootstrap.Modal(el('editProgramacionModal')).show();
}
</script>
