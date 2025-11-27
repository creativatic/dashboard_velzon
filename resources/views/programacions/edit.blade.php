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
                        <select name="conductor_id" id="edit-conductor_id" class="form-select" required>
                            <option value="">Seleccione un conductor...</option>
                            @foreach($conductores as $c)
                                <option value="{{ $c->id }}">
                                    {{ $c->licencia }} — {{ $c->nombres }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- DATOS CONDUCTOR -->
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" id="edit-dni" name="dni" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nombres</label>
                        <input type="text" id="edit-nombres_conductor" name="nombres_conductor" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Apellidos</label>
                        <input type="text" id="edit-apellidos_conductor" name="apellidos_conductor" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" id="edit-telefono_conductor" name="telefono_conductor" class="form-control">
                    </div>

                    <!-- VEHÍCULO -->
                    <div class="col-md-4">
                        <label class="form-label">Placa Tracto</label>
                        <input type="text" id="edit-placa_tracto" name="placa_tracto" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Placa Carreta</label>
                        <input type="text" id="edit-placa_carreta" name="placa_carreta" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Marca Vehículo</label>
                        <input type="text" id="edit-marca_vehiculo" name="marca_vehiculo" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tipo Plataforma</label>
                        <input type="text" id="edit-tipo_plataforma" name="tipo_plataforma" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Constancia MTC Tracto</label>
                        <input type="text" id="edit-constancia_mtc_tracto" name="constancia_mtc_tracto" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Constancia MTC Carreta</label>
                        <input type="text" id="edit-constancia_mtc_carreta" name="constancia_mtc_carreta" class="form-control">
                    </div>

                    <!-- PROVEEDOR -->
                    <div class="col-md-4">
                        <label class="form-label">RUC Transporte</label>
                        <input type="text" id="edit-ruc_transporte" name="ruc_transporte" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Razón Social</label>
                        <input type="text" id="edit-razon_social_transporte" name="razon_social_transporte" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Cuenta Banco</label>
                        <input type="text" id="edit-cuenta_banco" name="cuenta_banco" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">CCI</label>
                        <input type="text" id="edit-cci_banco" name="cci_banco" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Banco</label>
                        <input type="text" id="edit-banco" name="banco" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tipo Mineral</label>
                        <input type="text" id="edit-tipo_mineral" name="tipo_mineral" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tipo Operación</label>
                        <select id="edit-tipo_operacion" name="tipo_operacion" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="nacional">Nacional</option>
                            <option value="internacional">Internacional</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Conformidad Adelanto</label>
                        <select id="edit-conformidad_adelanto" name="conformidad_adelanto" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="Ok">Ok</option>
                            <option value="Pendiente">Pendiente</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Guía Transportista</label>
                        <input type="text" id="edit-guia_transportista" name="guia_transportista" class="form-control">
                    </div>

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
function openEditProgramacionModal(data) {

    // Cambiar la ruta del formulario a PUT programacions/{id}
    document.getElementById("editProgramacionForm").action =
        "/programacions/" + data.id;

    // Cargar campos
    document.getElementById('edit-fecha_programacion').value = data.fecha_programacion.replace(" ", "T");
    document.getElementById('edit-detalle_programacion_id').value = data.detalle_programacion_id;
    document.getElementById('edit-guia_remision').value = data.guia_remision ?? "";

    // Datos conductor
    document.getElementById('edit-conductor_id').value = data.conductor_id ?? "";
    document.getElementById('edit-dni').value = data.dni ?? "";
    document.getElementById('edit-nombres_conductor').value = data.nombres_conductor ?? "";
    document.getElementById('edit-apellidos_conductor').value = data.apellidos_conductor ?? "";
    document.getElementById('edit-telefono_conductor').value = data.telefono_conductor ?? "";

    // Vehículo
    document.getElementById('edit-placa_tracto').value = data.placa_tracto ?? "";
    document.getElementById('edit-placa_carreta').value = data.placa_carreta ?? "";
    document.getElementById('edit-marca_vehiculo').value = data.marca_vehiculo ?? "";
    document.getElementById('edit-tipo_plataforma').value = data.tipo_plataforma ?? "";

    // MTC
    document.getElementById('edit-constancia_mtc_tracto').value = data.constancia_mtc_tracto ?? "";
    document.getElementById('edit-constancia_mtc_carreta').value = data.constancia_mtc_carreta ?? "";

    // Proveedor
    document.getElementById('edit-ruc_transporte').value = data.ruc_transporte ?? "";
    document.getElementById('edit-razon_social_transporte').value = data.razon_social_transporte ?? "";
    document.getElementById('edit-cuenta_banco').value = data.cuenta_banco ?? "";
    document.getElementById('edit-cci_banco').value = data.cci_banco ?? "";
    document.getElementById('edit-banco').value = data.banco ?? "";

    document.getElementById('edit-tipo_mineral').value = data.tipo_mineral ?? "";
    document.getElementById('edit-tipo_operacion').value = data.tipo_operacion ?? "";
    document.getElementById('edit-conformidad_adelanto').value = data.conformidad_adelanto ?? "";
    document.getElementById('edit-guia_transportista').value = data.guia_transportista ?? "";
    document.getElementById('edit-grupo_cargio').value = data.grupo_cargio ?? "";

    // Abrir modal
    let modal = new bootstrap.Modal(document.getElementById('editProgramacionModal'));
    modal.show();
}

document.getElementById('edit-conductor_id').addEventListener('change', function () {

    let id = this.value;
    if (!id) return;

    fetch(`/conductores/${id}/data`)
        .then(res => res.json())
        .then(data => {

            document.getElementById('edit-dni').value = data.dni ?? '';
            document.getElementById('edit-nombres_conductor').value = data.nombres ?? '';
            document.getElementById('edit-apellidos_conductor').value = data.apellidos ?? '';
            document.getElementById('edit-telefono_conductor').value = data.telefono ?? '';

            document.getElementById('edit-placa_tracto').value = data.placa_tracto ?? '';
            document.getElementById('edit-placa_carreta').value = data.placa_carreta ?? '';
            document.getElementById('edit-marca_vehiculo').value = data.marca_vehiculo ?? '';
            document.getElementById('edit-tipo_plataforma').value = data.tipo_plataforma ?? '';

            document.getElementById('edit-constancia_mtc_tracto').value = data.constancia_mtc_tracto ?? '';
            document.getElementById('edit-constancia_mtc_carreta').value = data.constancia_mtc_carreta ?? '';

            document.getElementById('edit-ruc_transporte').value = data.ruc_transporte ?? '';
            document.getElementById('edit-razon_social_transporte').value = data.razon_social_transporte ?? '';
            document.getElementById('edit-cuenta_banco').value = data.cuenta_banco ?? '';
            document.getElementById('edit-cci_banco').value = data.cci_banco ?? '';
            document.getElementById('edit-banco').value = data.banco ?? '';

            document.getElementById('edit-tipo_mineral').value = data.tipo_mineral ?? '';
        });
});

</script>

