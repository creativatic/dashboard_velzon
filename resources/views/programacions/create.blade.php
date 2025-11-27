<!-- Modal Crear Programación -->
<div class="modal fade" id="createProgramacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form id="createProgramacionForm" action="{{ route('programacions.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Nueva Programación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <!-- Sección 1: Información Básica -->
                    <div class="col-md-4">
                        <label for="create-fecha_programacion" class="form-label">Fecha Programación</label>
                        <input type="datetime-local" name="fecha_programacion" id="create-fecha_programacion" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="create-detalle_programacion_id" class="form-label">Frente</label>
                        <select name="detalle_programacion_id" id="create-detalle_programacion_id" class="form-select" required>
                            <option value="">Seleccione un frente...</option>
                            @foreach($detalles as $detalle)
                                <option value="{{ $detalle->id }}">
                                    {{ $detalle->frente }} — S/.{{ number_format($detalle->precio_frente, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="create-guia_remision" class="form-label">Guía Remisión</label>
                        <input type="text" name="guia_remision" id="create-guia_remision" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-conductor_id" class="form-label">Licencia del Conductor</label>
                        <select name="conductor_id" id="create-conductor_id" class="form-select" required>
                            <option value="">Seleccione un conductor...</option>
                            @foreach($conductores as $c)
                                <option value="{{ $c->id }}">
                                    {{ $c->licencia }} — {{ $c->nombres }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="create-dni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="create-dni" maxlength="8" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-nombres_conductor" class="form-label">Nombres Conductor</label>
                        <input type="text" name="nombres_conductor" id="create-nombres_conductor" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-apellidos_conductor" class="form-label">Apellidos Conductor</label>
                        <input type="text" name="apellidos_conductor" id="create-apellidos_conductor" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-telefono_conductor" class="form-label">Teléfono</label>
                        <input type="text" name="telefono_conductor" id="create-telefono_conductor" class="form-control">
                    </div>

                    <!-- Sección 3: Datos del Vehículo -->
                    <div class="col-md-4">
                        <label for="create-placa_tracto" class="form-label">Placa Tracto</label>
                        <input type="text" name="placa_tracto" id="create-placa_tracto" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-placa_carreta" class="form-label">Placa Carreta</label>
                        <input type="text" name="placa_carreta" id="create-placa_carreta" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-marca_vehiculo" class="form-label">Marca Vehículo</label>
                        <input type="text" name="marca_vehiculo" id="create-marca_vehiculo" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-tipo_plataforma" class="form-label">Tipo Plataforma</label>
                        <input type="text" name="tipo_plataforma" id="create-tipo_plataforma" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-constancia_mtc_tracto" class="form-label">Constancia MTC Tracto</label>
                        <input type="text" name="constancia_mtc_tracto" id="create-constancia_mtc_tracto" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-constancia_mtc_carreta" class="form-label">Constancia MTC Carreta</label>
                        <input type="text" name="constancia_mtc_carreta" id="create-constancia_mtc_carreta" class="form-control">
                    </div>

                    <!-- Sección 4: Datos proveedor -->
                    <div class="col-md-4">
                        <label for="create-ruc_transporte" class="form-label">RUC Transporte</label>
                        <input type="text" name="ruc_transporte" id="create-ruc_transporte" class="form-control" maxlength="11">
                    </div>

                    <div class="col-md-4">
                        <label for="create-razon_social_transporte" class="form-label">Razón Social Transporte</label>
                        <input type="text" name="razon_social_transporte" id="create-razon_social_transporte" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-cuenta_banco" class="form-label">Cuenta Banco</label>
                        <input type="text" name="cuenta_banco" id="create-cuenta_banco" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-cci_banco" class="form-label">CCI Banco</label>
                        <input type="text" name="cci_banco" id="create-cci_banco" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-banco" class="form-label">Banco</label>
                        <input type="text" name="banco" id="create-banco" class="form-control">
                    </div>

                    <!-- Sección 5: Detalles servicio -->
                    <div class="col-md-4">
                        <label for="create-tipo_mineral" class="form-label">Tipo Mineral</label>
                        <input type="text" name="tipo_mineral" id="create-tipo_mineral" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-tipo_operacion" class="form-label">Tipo Operación</label>
                        <select name="tipo_operacion" id="create-tipo_operacion" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="nacional">Nacional</option>
                            <option value="internacional">Internacional</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="create-conformidad_adelanto" class="form-label">Conformidad Adelanto</label>
                        <select name="conformidad_adelanto" id="create-conformidad_adelanto" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="Ok">Ok</option>
                            <option value="Pendiente">Pendiente</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="create-guia_transportista" class="form-label">Guía Transportista</label>
                        <input type="text" name="guia_transportista" id="create-guia_transportista" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="create-grupo_cargio" class="form-label">Grupo Carguío</label>
                        <input type="text" name="grupo_cargio" id="create-grupo_cargio" class="form-control">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-3-line"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('create-conductor_id').addEventListener('change', function () {

    let id = this.value;
    if (id === "") return;

    fetch(`/conductores/${id}/data`)
        .then(res => res.json())
        .then(data => {

            // Datos personales
            document.getElementById('create-dni').value = data.dni ?? '';
            document.getElementById('create-nombres_conductor').value = data.nombres ?? '';
            document.getElementById('create-apellidos_conductor').value = data.apellidos ?? '';
            document.getElementById('create-telefono_conductor').value = data.telefono ?? '';

            // Vehículo
            document.getElementById('create-placa_tracto').value = data.placa_tracto ?? '';
            document.getElementById('create-placa_carreta').value = data.placa_carreta ?? '';
            document.getElementById('create-marca_vehiculo').value = data.marca_vehiculo ?? '';
            document.getElementById('create-tipo_plataforma').value = data.tipo_plataforma ?? '';

            // MTC
            document.getElementById('create-constancia_mtc_tracto').value = data.constancia_mtc_tracto ?? '';
            document.getElementById('create-constancia_mtc_carreta').value = data.constancia_mtc_carreta ?? '';

            // Empresa transporte
            document.getElementById('create-ruc_transporte').value = data.ruc_transporte ?? '';
            document.getElementById('create-razon_social_transporte').value = data.razon_social_transporte ?? '';
            document.getElementById('create-cuenta_banco').value = data.cuenta_banco ?? '';
            document.getElementById('create-cci_banco').value = data.cci_banco ?? '';
            document.getElementById('create-banco').value = data.banco ?? '';

            // Minerales
            document.getElementById('create-tipo_mineral').value = data.tipo_mineral ?? '';

        });
});
</script>
