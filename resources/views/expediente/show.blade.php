{{-- C:\laragon\www\ventas_seven\resources\views\expediente\show.blade.php --}}
<div class="modal fade" id="modalShowExpediente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white">Detalles del Expediente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{-- Información General del Expediente --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Información del Expediente</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">N° Factura Expediente:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_numero_factura_exped">--</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Fecha de Carga:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_fecha_carga">--</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Fecha de Pago:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_fecha_pago">--</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Total (S/):</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_total">--</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Detracción (S/):</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_detraccion">--</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Archivo:</label>
                                <p class="form-control-plaintext" id="show_archivo">
                                    <span class="badge bg-secondary">Sin archivo</span>
                                </p>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Comentarios:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_comentarios">--</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Información de la Guía de Remisión --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Información de la Guía de Remisión</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Guía de Remisión:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_guia_remision">--</p>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Placa Tracto:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_placa_tracto">--</p>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Placa Carreta:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_placa_carreta">--</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Razón Social Empresa:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_razon_social_empresa">--</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">RUC:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_ruc">--</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Guía Transportista:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_guia_transportista">--</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Información del Ticket Tisur --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Información del Ticket Tisur</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Número de Ticket:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_numero_ticket">--</p>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Fecha Ingreso:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_fecha_hora_ingreso">--</p>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Peso Neto:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_peso_neto">--</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Información del Frente --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Información del Frente</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Frente:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_frente">--</p>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Precio Frente:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_precio_frente">--</p>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Precio TN:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light" id="show_precio_tn">--</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{-- Script para cargar los datos en el modal show --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Función para abrir el modal show con los datos del expediente
    window.mostrarExpediente = function(id) {
        if (id) {
            fetch(`/expediente/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al cargar los datos');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos recibidos:', data); // Para debug
                    
                    // Información general del expediente
                    document.getElementById('show_numero_factura_exped').textContent = data.numero_factura_exped || '--';
                    document.getElementById('show_fecha_carga').textContent = data.fecha_carga || '--';
                    document.getElementById('show_fecha_pago').textContent = data.fecha_pago || '--';
                    document.getElementById('show_total').textContent = data.total ? `S/ ${parseFloat(data.total).toFixed(2)}` : '--';
                    document.getElementById('show_detraccion').textContent = data.detraccion ? `S/ ${parseFloat(data.detraccion).toFixed(2)}` : '--';
                    document.getElementById('show_comentarios').textContent = data.comentarios || '--';
                    
                    // Manejar el archivo
                    const archivoElement = document.getElementById('show_archivo');
                    if (data.archivo) {
                        const archivoUrl = `/storage/${data.archivo}`;
                        archivoElement.innerHTML = `<a href="${archivoUrl}" target="_blank" class="btn btn-outline-success btn-sm">📎 Ver Archivo</a>`;
                    } else {
                        archivoElement.innerHTML = '<span class="badge bg-secondary">Sin archivo</span>';
                    }


                    // Información de programación
                    if (data.programacion) {
                        document.getElementById('show_guia_remision').textContent = data.programacion.guia_remision || '--';
                        document.getElementById('show_placa_tracto').textContent = data.programacion.placa_tracto || '--';
                        document.getElementById('show_placa_carreta').textContent = data.programacion.placa_carreta || '--';
                        document.getElementById('show_razon_social_empresa').textContent = data.programacion.razon_social_transporte || '--';
                        document.getElementById('show_ruc').textContent = data.programacion.ruc_transporte || '--';
                        document.getElementById('show_guia_transportista').textContent = data.programacion.guia_transportista || '--';
                    }

                    // Información de Tisur
                    if (data.tisur) {
                        document.getElementById('show_numero_ticket').textContent = data.tisur.numero_ticket || '--';
                        document.getElementById('show_fecha_hora_ingreso').textContent = data.tisur.fecha_hora_ingreso || '--';
                        document.getElementById('show_peso_neto').textContent = data.tisur.peso_neto || '--';
                    }

                    // Información del frente (detalle programación)
                    if (data.programacion && data.programacion.detalle_programacion) {
                        document.getElementById('show_frente').textContent = data.programacion.detalle_programacion.frente || '--';
                        document.getElementById('show_precio_frente').textContent = data.programacion.detalle_programacion.precio_frente || '--';
                        document.getElementById('show_precio_tn').textContent = data.programacion.detalle_programacion.precio_tn || '--';
                    }

                    // Mostrar el modal
                    const modal = new bootstrap.Modal(document.getElementById('modalShowExpediente'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar los datos del expediente');
                });
        }
    };
});
</script>