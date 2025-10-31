@extends('layouts.plantilla')

@section('title', 'Reporte de EPPs')

@section('content')
<div class="container">
    <h1 class="mb-4">Reporte de Control de EPPs</h1>

    {{-- 🔍 Buscador por DNI --}}
    <div class="input-group mb-4" style="max-width: 400px;">
        <input type="text" id="dni_buscar" class="form-control" placeholder="Ingrese DNI del trabajador">
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
                    <th>EPP</th>
                    <th>Cantidad Entregada</th> {{-- Nombres de columna actualizados --}}
                     <th>Cantidad Devuelta</th> {{-- ✅ NUEVA COLUMNA --}}
                    <th>Fecha Última Entrega</th>
                    <th>Fecha Última Devolución</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody_entregas"></tbody>
        </table>

        <div class="alert alert-info mt-3">
            <p class="mb-1">
                <strong>Total EPPs entregados (por EPP):</strong> <span id="total_epps"></span>
            </p>
            {{-- ✅ CAMPO DE TOTAL DE VUELTOS: AÑADIDO Y LISTO PARA RECIBIR DATOS --}}
            <p class="mb-0">
                <strong>Total EPPs devueltos (ítems):</strong> <span id="total_epps_devueltos">0</span>
            </p>
        </div>
    </div>

    <div id="mensaje_error" class="alert alert-danger d-none"></div>
</div>

{{-- 🔹 Incluir modal externo --}}
@include('dashboard_detalles.show')

<script>
function buscarPorDni() {
    const dni = document.getElementById('dni_buscar').value.trim();
    const infoPersona = document.getElementById('info_persona');
    const tablaEntregas = document.getElementById('tabla_entregas');
    const mensajeError = document.getElementById('mensaje_error');

    if (!dni) {
        alert('Por favor ingrese un DNI');
        return;
    }
    
    // Limpiar totales y mensajes de error
    document.getElementById('total_epps').innerHTML = '';
    document.getElementById('total_epps_devueltos').textContent = '0';
    
    fetch(`/dashboard/buscar/${dni}`)
        .then(res => {
            if (!res.ok) throw new Error('No se encontró el registro');
            return res.json();
        })
        .then(data => {
            // Mostrar datos de persona
            document.getElementById('nombre_persona').textContent = data.persona.nombres;
            document.getElementById('dni_persona').textContent = data.persona.dni;
            document.getElementById('cargo_persona').textContent = data.persona.cargo ?? '-';
            document.getElementById('area_persona').textContent = data.persona.area ?? '-';
            infoPersona.classList.remove('d-none');

            // Mostrar entregas en la tabla
            const tbody = document.getElementById('tbody_entregas');
            tbody.innerHTML = '';
            data.entregas.forEach(e => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${e.epp}</td>
                    <td>${e.total_entregado}</td>
                    <td>${e.total_devuelto_epp}</td> <td>${e.ultima_entrega ?? '-'}</td>
                    <td>${e.ultima_devolucion ?? '<span class="badge bg-warning text-dark">Pendiente</span>'}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="verDetalles('${data.persona.id}', '${e.epp_id}', '${e.epp}')">
                            Ver
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            tablaEntregas.classList.remove('d-none');

            // Mostrar totales agrupados (ahora mostrando el resumen por EPP)
            document.getElementById('total_epps').innerHTML = `
                <ul class="mb-0">
                    ${data.entregas.map(e => `<li><strong>${e.epp}:</strong> ${e.total_entregado} Entregados / ${e.total_devuelto_epp} Devueltos</li>`).join('')}
                </ul>
            `;
            
            // Si quieres seguir mostrando el total global, usa el nuevo campo del controlador
            document.getElementById('total_epps_devueltos').textContent = data.total_devuelto_global ?? 0;

            mensajeError.classList.add('d-none');
        })
        .catch(() => {
            infoPersona.classList.add('d-none');
            tablaEntregas.classList.add('d-none');
            document.getElementById('total_epps').innerHTML = '';
            document.getElementById('total_epps_devueltos').textContent = '0';
            mensajeError.textContent = 'No se encontró ningún registro con ese DNI.';
            mensajeError.classList.remove('d-none');
        });
}

// Función verDetalles: sin cambios
function verDetalles(personaId, eppId, eppNombre) {
    // 💡 Paso 1: Muestra el nombre del EPP que se está consultando en el modal
    document.getElementById('modalDetallesLabel').textContent = `Detalles de Entregas de EPP: ${eppNombre}`;
    
    fetch(`/dashboard/detalles/${personaId}/${eppId}`)
        .then(res => {
            if (!res.ok) throw new Error('Error al obtener detalles');
            return res.json();
        })
        .then(data => {
            const tbody = document.getElementById('tbody_detalles');
            tbody.innerHTML = ''; // Limpiar contenido previo

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">Sin registros de entregas para este EPP.</td></tr>`;
            } else {
                // 💡 Paso 2: Inyectar los datos en el tbody
                data.forEach(d => {
                    const tr = document.createElement('tr');
                    
                    // Asegúrate de que los nombres de las propiedades coincidan.
                    tr.innerHTML = `
                        <td>${d.cantidad ?? '-'}</td>
                        <td>${d.fecha_entrega ?? '-'}</td>
                        <td>${d.fecha_devolucion ?? '<span class="badge bg-warning text-dark">Pendiente</span>'}</td>
                        <td>${d.observacion ?? '-'}</td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            // 💡 Paso 3: Abrir el modal
            const modal = new bootstrap.Modal(document.getElementById('modalDetalles'));
            modal.show();
        })
        .catch((error) => {
            console.error("Error al cargar detalles:", error);
            alert('No se pudieron cargar los detalles. Verifique la consola para más información.');
        });
}
</script>
@endsection