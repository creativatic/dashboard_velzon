<!-- Modal Editar Programación -->
<div class="modal fade" id="editProgramacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form id="editProgramacionForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Editar Programación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit-id" name="id">

                <div class="row g-3">

                    <!-- Fecha de Programación -->
                    <div class="col-md-4">
                        <label for="edit-fecha_programacion" class="form-label">Fecha Programación</label>
                        <input type="date" name="fecha_programacion" id="edit-fecha_programacion" class="form-control" required>
                    </div>

                    <!-- Frente (select) -->
                    <div class="col-md-4">
                        <label for="edit-detalle_programacion_id" class="form-label">Frente</label>
                        <select name="detalle_programacion_id" id="edit-detalle_programacion_id" class="form-select" required>
                            <option value="">Seleccione un frente...</option>
                            @foreach($detalles as $detalle)
                                <option value="{{ $detalle->id }}">
                                    {{ $detalle->frente }} — S/.{{ number_format($detalle->precio_frente, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- DNI -->
                    <div class="col-md-4">
                        <label for="edit-dni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="edit-dni" maxlength="8" class="form-control">
                    </div>

                    <!-- Guía Remisión -->
                    <div class="col-md-4">
                        <label for="edit-guia_remision" class="form-label">Guía Remisión</label>
                        <input type="text" name="guia_remision" id="edit-guia_remision" class="form-control">
                    </div>

                    <!-- Placa Tracto -->
                    <div class="col-md-4">
                        <label for="edit-placa_tracto" class="form-label">Placa Tracto</label>
                        <input type="text" name="placa_tracto" id="edit-placa_tracto" class="form-control">
                    </div>

                    <!-- Placa Carreta -->
                    <div class="col-md-4">
                        <label for="edit-placa_carreta" class="form-label">Placa Carreta</label>
                        <input type="text" name="placa_carreta" id="edit-placa_carreta" class="form-control">
                    </div>

                    <!-- Marca -->
                    <div class="col-md-4">
                        <label for="edit-marca_vehiculo" class="form-label">Marca Vehículo</label>
                        <input type="text" name="marca_vehiculo" id="edit-marca_vehiculo" class="form-control">
                    </div>

                    <!-- Tipo Plataforma -->
                    <div class="col-md-4">
                        <label for="edit-tipo_plataforma" class="form-label">Tipo Plataforma</label>
                        <input type="text" name="tipo_plataforma" id="edit-tipo_plataforma" class="form-control">
                    </div>

                    <!-- Constancia MTC Tracto -->
                    <div class="col-md-4">
                        <label for="edit-constancia_mtc_tracto" class="form-label">Constancia MTC Tracto</label>
                        <input type="text" name="constancia_mtc_tracto" id="edit-constancia_mtc_tracto" class="form-control">
                    </div>

                    <!-- Constancia MTC Carreta -->
                    <div class="col-md-4">
                        <label for="edit-constancia_mtc_carreta" class="form-label">Constancia MTC Carreta</label>
                        <input type="text" name="constancia_mtc_carreta" id="edit-constancia_mtc_carreta" class="form-control">
                    </div>

                    <!-- RUC Transporte -->
                    <div class="col-md-4">
                        <label for="edit-ruc_transporte" class="form-label">RUC Transporte</label>
                        <input type="text" name="ruc_transporte" id="edit-ruc_transporte" class="form-control" maxlength="11">
                    </div>

                    <!-- Razón social -->
                    <div class="col-md-4">
                        <label for="edit-razon_social_transporte" class="form-label">Razón Social Transporte</label>
                        <input type="text" name="razon_social_transporte" id="edit-razon_social_transporte" class="form-control">
                    </div>

                    <!-- Nombres / Apellidos conductor -->
                    <div class="col-md-4">
                        <label for="edit-nombres_conductor" class="form-label">Nombres Conductor</label>
                        <input type="text" name="nombres_conductor" id="edit-nombres_conductor" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="edit-apellidos_conductor" class="form-label">Apellidos Conductor</label>
                        <input type="text" name="apellidos_conductor" id="edit-apellidos_conductor" class="form-control">
                    </div>

                    <!-- Licencia -->
                    <div class="col-md-4">
                        <label for="edit-licencia" class="form-label">Licencia</label>
                        <input type="text" name="licencia" id="edit-licencia" class="form-control">
                    </div>

                    <!-- Tipo Operación -->
                    <div class="col-md-4">
                        <label for="edit-tipo_operacion" class="form-label">Tipo Operación</label>
                        <select name="tipo_operacion" id="edit-tipo_operacion" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="nacional">Nacional</option>
                            <option value="internacional">Internacional</option>
                        </select>
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-4">
                        <label for="edit-telefono_conductor" class="form-label">Teléfono</label>
                        <input type="text" name="telefono_conductor" id="edit-telefono_conductor" class="form-control">
                    </div>

                    <!-- Cuenta / CCI / Banco -->
                    <div class="col-md-4">
                        <label for="edit-cuenta_banco" class="form-label">Cuenta Banco</label>
                        <input type="text" name="cuenta_banco" id="edit-cuenta_banco" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="edit-cci_banco" class="form-label">CCI Banco</label>
                        <input type="text" name="cci_banco" id="edit-cci_banco" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="edit-banco" class="form-label">Banco</label>
                        <input type="text" name="banco" id="edit-banco" class="form-control">
                    </div>

                    <!-- Tipo mineral, conformidad, guia transportista, grupo -->
                    <div class="col-md-4">
                        <label for="edit-tipo_mineral" class="form-label">Tipo Mineral</label>
                        <input type="text" name="tipo_mineral" id="edit-tipo_mineral" class="form-control">
                    </div>
                    <!--
                    <div class="col-md-4">
                        <label for="edit-conformidad_adelanto" class="form-label">Conformidad Adelantdasdasdaso</label>
                        <input type="text" name="conformidad_adelanto" id="edit-conformidad_adelanto" class="form-control">
                    </div> -->

                    <div class="col-md-4">
                        <label for="edit-conformidad_adelanto" class="form-label">Conformidad Adelanto</label>
                        <select name="conformidad_adelanto" id="edit-conformidad_adelanto" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="Ok" style="color: #198754; font-weight: bold;">Ok</option>
                            <option value="Pendiente" style="color: #dc3545; font-weight: bold;">Pendiente</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="edit-guia_transportista" class="form-label">Guía Transportista</label>
                        <input type="text" name="guia_transportista" id="edit-guia_transportista" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="edit-grupo_cargio" class="form-label">Grupo Carguío</label>
                        <input type="text" name="grupo_cargio" id="edit-grupo_cargio" class="form-control">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-3-line"></i> Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditProgramacionModal(programacion) {
    const form = document.getElementById('editProgramacionForm');
    form.action = `/programacions/${programacion.id}`;

    // Rellenar inputs y selects
    const fields = [
        'fecha_programacion','detalle_programacion_id','dni','guia_remision','placa_tracto',
        'placa_carreta','marca_vehiculo','tipo_plataforma','constancia_mtc_tracto',
        'constancia_mtc_carreta','ruc_transporte','razon_social_transporte',
        'nombres_conductor','apellidos_conductor','licencia','tipo_operacion',
        'telefono_conductor','cuenta_banco','cci_banco','banco',
        'tipo_mineral','conformidad_adelanto','guia_transportista','grupo_cargio'
    ];

    fields.forEach(key => {
        const el = document.getElementById(`edit-${key}`) || document.getElementById(`edit-${key.replace('_','-')}`);
        if (el) {
            // manejar selects directos (detalle_programacion_id y tipo_operacion)
            if (el.tagName === 'SELECT') {
                // Si el JSON trae detalle_programacion_id o tipo_operacion lo asigna
                el.value = programacion[key] ?? '';
            } else {
                // si es fecha, asegúrate del formato YYYY-MM-DD
                if (key === 'fecha_programacion' && programacion[key]) {
                    // si viene con timestamp, intentar parse simple
                    const d = new Date(programacion[key]);
                    if (!isNaN(d)) {
                        const yyyy = d.getFullYear();
                        const mm = String(d.getMonth() + 1).padStart(2, '0');
                        const dd = String(d.getDate()).padStart(2, '0');
                        el.value = `${yyyy}-${mm}-${dd}`;
                    } else {
                        el.value = programacion[key] ?? '';
                    }
                } else {
                    el.value = programacion[key] ?? '';
                }
            }
        }
    });

    // Mostrar modal
    new bootstrap.Modal(document.getElementById('editProgramacionModal')).show();
}
</script>
