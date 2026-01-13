@extends('layouts.plantilla')

@section('title', 'Reporte de EPPs')

@section('content')
<div class="container">
    <h1 class="mb-4">Reporte de Control de Productos</h1>

    {{-- 🔍 Buscador por DNI --}}
    <div class="input-group mb-4" style="max-width: 400px; position:relative;">
        <input type="text" id="dni_buscar" class="form-control" placeholder="Ingrese DNI del trabajador" autocomplete="off">

        {{-- 🔽 Resultados de autocompletado --}}
        <div id="resultados_dni_autocomplete"
             class="list-group"
             style="position:absolute; top:38px; width:100%; z-index:1000; display:none;">
        </div>

        <button class="btn btn-success" onclick="buscarPorDni()">Buscar</button>
    </div>

    {{-- Información del trabajador --}}
    <div id="info_persona" class="card mb-3 d-none">
        <div class="card-body">
            <h5 id="nombre_persona" class="card-title"></h5>
            <p class="card-text">
                <strong>DNI:</strong> <span id="dni_persona"></span><br>
                <strong>Cargo:</strong> <span id="cargo_persona"></span><br>
                <strong>Área:</strong> <span id="area_persona"></span>
            </p>
        </div>
    </div>

    {{-- Tabla de entregas --}}
    <div id="tabla_entregas" class="d-none">
        <h5 class="mb-3">Entregas registradas</h5>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-success">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad Entregada</th>
                    <th>Unidad Medida</th>
                    <th>Cantidad Devuelta</th>
                    <th>Fecha Última Entrega</th>
                    <th>Fecha Última Devolución</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody_entregas"></tbody>
        </table>

        <div id="contenedor-paginacion" class="d-none mt-3"></div>

        <div class="alert alert-info mt-3">
            <p class="mb-1">
                <strong>Total Productos entregados (por Producto):</strong>
                <span id="total_epps"></span>
            </p>
            <p class="mb-0">
                <strong>Total Productos devueltos (ítems):</strong>
                <span id="total_epps_devueltos">0</span>
            </p>
        </div>
    </div>

    <div id="mensaje_error" class="alert alert-danger d-none"></div>
</div>

@include('dashboard_detalles.show')

<script>

/* ===========================================================
   🔍 AUTOCOMPLETADO DNI (JS PURO)
   =========================================================== */
document.addEventListener("DOMContentLoaded", () => {

    const input = document.getElementById('dni_buscar');
    const results = document.getElementById('resultados_dni_autocomplete');

    input.addEventListener('keyup', function () {
        const term = this.value.trim();

        if (term.length < 3) {
            results.style.display = 'none';
            return;
        }

        fetch(`/dashboard/autocomplete-dni?term=${term}`)
            .then(res => res.json())
            .then(data => {
                results.innerHTML = '';

                if (data.length === 0) {
                    results.style.display = 'none';
                    return;
                }

                data.forEach(item => {
                    const btn = document.createElement('button');
                    btn.type = "button";
                    btn.classList.add("list-group-item", "list-group-item-action");
                    btn.textContent = item.label;

                    btn.addEventListener("click", () => {
                        input.value = item.value;
                        results.style.display = 'none';
                        buscarPorDni();
                    });

                    results.appendChild(btn);
                });

                results.style.display = 'block';
            })
            .catch(() => results.style.display = 'none');
    });

    // Cerrar el autocompletado si se hace clic afuera
    document.addEventListener("click", function (e) {
        if (!input.contains(e.target) && !results.contains(e.target)) {
            results.style.display = 'none';
        }
    });

});


/* ===========================================================
   🔍 BUSCAR POR DNI
   =========================================================== */
function buscarPorDni(url = null) {

    const dniInput = document.getElementById('dni_buscar');
    const dni = dniInput.value.trim();

    let endpoint = url ?? `/dashboard/buscar/${dni}`;

    const infoPersona = document.getElementById('info_persona');
    const tablaEntregas = document.getElementById('tabla_entregas');
    const mensajeError = document.getElementById('mensaje_error');

    if (!url && !dni) {
        alert('Por favor ingrese un DNI');
        return;
    }

    fetch(endpoint)
        .then(res => {
            if (!res.ok) throw new Error("Error al buscar DNI");
            return res.json();
        })
        .then(data => {

            // Información trabajador
            document.getElementById('nombre_persona').textContent = data.persona.nombres;
            document.getElementById('dni_persona').textContent = data.persona.dni;
            document.getElementById('cargo_persona').textContent = data.persona.cargo ?? '-';
            document.getElementById('area_persona').textContent = data.persona.area ?? '-';
            infoPersona.classList.remove('d-none');

            // Tabla
            const tbody = document.getElementById('tbody_entregas');
            tbody.innerHTML = '';

            data.entregas.forEach(e => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${e.epp}</td>
                    <td>${e.total_entregado}</td>
                    <td>${e.unidades_medidas ?? '-'}</td>
                    <td>${e.total_devuelto_epp}</td>
                    <td>${e.ultima_entrega ?? '-'}</td>
                    <td>${e.ultima_devolucion ?? '<span class="badge bg-warning text-dark">Pendiente</span>'}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"
                                onclick="verDetalles('${data.persona.id}', '${e.epp_id}', '${e.epp}')">
                            Ver
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            tablaEntregas.classList.remove('d-none');

            // Totales
            document.getElementById('total_epps').innerHTML = `
                <ul class="mb-0">
                    ${data.entregas.map(e => `
                        <li><strong>${e.epp}:</strong>
                            ${e.total_entregado} ${e.unidades_medidas ?? ''} entregados /
                            ${e.total_devuelto_epp} ${e.unidades_medidas ?? ''} devueltos
                        </li>
                    `).join('')}
                </ul>
            `;

            document.getElementById('total_epps_devueltos').textContent =
                data.total_devuelto_global ?? 0;

            configurarPaginacion(data.links);
            mensajeError.classList.add('d-none');

        })
        .catch(() => {
            infoPersona.classList.add('d-none');
            tablaEntregas.classList.add('d-none');
            mensajeError.textContent = 'No se encontró ningún registro con ese DNI.';
            mensajeError.classList.remove('d-none');
        });
}


/* ===========================================================
   🔄 PAGINACIÓN
   =========================================================== */
function configurarPaginacion(pagination) {

    let pag = document.getElementById('contenedor-paginacion');

    pag.innerHTML = `
        <div class="d-flex justify-content-between align-items-center">
            <button id="btn-prev" class="btn btn-outline-secondary btn-sm"
                onclick="paginaAnterior()" ${pagination.prev ? '' : 'disabled'}
                data-url="${pagination.prev}">
                ⬅ Anterior
            </button>

            <span class="fw-bold">
                Página ${pagination.current_page} de ${pagination.last_page}
            </span>

            <button id="btn-next" class="btn btn-outline-secondary btn-sm"
                onclick="paginaSiguiente()" ${pagination.next ? '' : 'disabled'}
                data-url="${pagination.next}">
                Siguiente ➡
            </button>
        </div>
    `;

    pag.classList.remove('d-none');
}

function paginaAnterior() {
    const url = document.getElementById('btn-prev').getAttribute('data-url');
    if (url) buscarPorDni(url);
}

function paginaSiguiente() {
    const url = document.getElementById('btn-next').getAttribute('data-url');
    if (url) buscarPorDni(url);
}


/* ===========================================================
   🧾 DETALLES DEL MODAL
   =========================================================== */
function verDetalles(personaId, eppId, eppNombre) {

    document.getElementById('modalDetallesLabel').textContent =
        `Detalles de Entregas de EPP: ${eppNombre}`;

    fetch(`/dashboard/detalles/${personaId}/${eppId}`)
        .then(res => res.json())
        .then(data => {

            const tbody = document.getElementById('tbody_detalles');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="5" class="text-center text-muted">
                        Sin registros de entregas para este EPP.
                    </td></tr>`;
                return;
            }

            data.forEach(d => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${d.cantidad ?? '-'}</td>
                    <td>${d.unidades_medidas ?? '-'}</td>
                    <td>${d.fecha_entrega ?? '-'}</td>
                    <td>${d.fecha_devolucion ?? '<span class="badge bg-warning text-dark">Pendiente</span>'}</td>
                    <td>${d.observacion ?? '-'}</td>
                `;
                tbody.appendChild(tr);
            });

            new bootstrap.Modal(document.getElementById('modalDetalles')).show();
        });
}

</script>

@endsection
