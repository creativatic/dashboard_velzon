<div class="modal fade" id="showProgramacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white">Detalles de la Programación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha Programación:</label>
                        <p id="show_fecha_programacion" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Frente:</label>
                        <p id="show_frente" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Licencia:</label>
                        <p id="show_licencia" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">DNI:</label>
                        <p id="show_dni" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Guía Remisión:</label>
                        <p id="show_guia_remision" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Placa Tracto:</label>
                        <p id="show_placa_tracto" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Placa Carreta:</label>
                        <p id="show_placa_carreta" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Marca Vehículo:</label>
                        <p id="show_marca_vehiculo" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo Plataforma:</label>
                        <p id="show_tipo_plataforma" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Constancia MTC Tracto:</label>
                        <p id="show_constancia_tracto" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Constancia MTC Carreta:</label>
                        <p id="show_constancia_carreta" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Razón Social Transporte:</label>
                        <p id="show_razon_social_transporte" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">RUC Transporte:</label>
                        <p id="show_ruc_transporte" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nombres Conductor:</label>
                        <p id="show_nombres_conductor" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Apellidos Conductor:</label>
                        <p id="show_apellidos_conductor" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Teléfono Conductor:</label>
                        <p id="show_telefono_conductor" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo Mineral:</label>
                        <p id="show_tipo_mineral" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo Operación:</label>
                        <p id="show_tipo_operacion" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Conformidad Adelanto:</label>
                        <p id="show_conformidad_adelanto" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Guía Transportista:</label>
                        <p id="show_guia_transportista" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Grupo Carguío:</label>
                        <p id="show_grupo_cargio" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                    </div>
                </div>
            </div>
            <hr class="my-4">

            <div class="modal-body">
                <h5 class="fw-bold text-primary">Información de Adelantos</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Monto Adelanto (S/):</label>
                            <p id="show_monto_adelanto" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Fecha de Pago:</label>
                            <p id="show_fecha_pago_adelantos" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Banco:</label>
                            <p id="show_banco" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Glosa Banco:</label>
                            <p id="show_glosa_banco" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Notas:</label>
                            <p id="show_notas" class="form-control-plaintext border rounded p-2 bg-light">--</p>
                        </div>
                    </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
function verProgramacion(id) {
    fetch(`/programacions/${id}/json`)
        .then(response => {
            if (!response.ok) throw new Error('Error en la petición');
            return response.json();
        })
        .then(data => {

            const p = data.programacion;
            const u = data.unidad;
            const c = data.conductor;
            const prov = data.proveedor;

            // ========= PROGRAMACION =========
            document.getElementById('show_fecha_programacion').innerText = p.fecha_programacion ?? '--';
            document.getElementById('show_frente').innerText = p.detalle_programacion?.frente ?? '--';
            document.getElementById('show_guia_remision').innerText = p.guia_remision ?? '--';

            document.getElementById('show_tipo_mineral').innerText = p.tipo_mineral ?? '--';
            document.getElementById('show_tipo_operacion').innerText = p.tipo_operacion ?? '--';
            document.getElementById('show_conformidad_adelanto').innerText = p.conformidad_adelanto ?? '--';
            document.getElementById('show_guia_transportista').innerText = p.guia_transportista ?? '--';
            document.getElementById('show_grupo_cargio').innerText = p.grupo_cargio ?? '--';

            // ========= UNIDAD =========
            document.getElementById('show_placa_tracto').innerText = u?.placa_tracto ?? '--';
            document.getElementById('show_placa_carreta').innerText = u?.placa_carreta ?? '--';
            document.getElementById('show_marca_vehiculo').innerText = u?.marca_vehiculo ?? '--';
            document.getElementById('show_tipo_plataforma').innerText = u?.tipo_plataforma ?? '--';
            document.getElementById('show_constancia_tracto').innerText = u?.constancia_mtc_tracto ?? '--';
            document.getElementById('show_constancia_carreta').innerText = u?.constancia_mtc_carreta ?? '--';

            // ========= PROVEEDOR =========
            document.getElementById('show_razon_social_transporte').innerText = prov?.razon_social ?? '--';
            document.getElementById('show_ruc_transporte').innerText = prov?.ruc_transporte ?? '--';
            document.getElementById('show_banco').innerText = prov?.banco ?? '--';

            // ========= CONDUCTOR =========
            document.getElementById('show_licencia').innerText = c?.licencia ?? '--';
            document.getElementById('show_dni').innerText = c?.dni ?? '--';
            document.getElementById('show_nombres_conductor').innerText = c?.nombres ?? '--';
            document.getElementById('show_apellidos_conductor').innerText = c?.apellidos ?? '--';
            document.getElementById('show_telefono_conductor').innerText = c?.telefono ?? '--';

            // ========= ADELANTOS =========
            document.getElementById('show_monto_adelanto').innerText = p.monto_adelanto ?? '--';
            document.getElementById('show_fecha_pago_adelantos').innerText = p.fecha_pago_adelantos ?? '--';
            document.getElementById('show_glosa_banco').innerText = p.glosa_banco ?? '--';
            document.getElementById('show_notas').innerText = p.notas ?? '--';

            // ✅ ABRIR MODAL
            new bootstrap.Modal(
                document.getElementById('showProgramacionModal')
            ).show();
        })
        .catch(error => {
            console.error(error);
            alert('Error al cargar la programación');
        });
}
</script>
