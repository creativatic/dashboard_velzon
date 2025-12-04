<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programacion;
use Maatwebsite\Excel\Facades\Excel; // ⬅️ Nuevo: Importamos el Facade de Excel
use App\Exports\ProgramacionesQrExport; // ⬅️ Nuevo: Importamos la clase de exportación

class ReporteController extends Controller
{
    public function reporteQr()
    {
        $programaciones = Programacion::with([
            'proveedor',
            'proveedor.unidades',
            'proveedor.unidades.conductores',
            'detalleProgramacion',
            'expedientes.tisur'
        ])
        ->where('conformidad_adelanto', 'Ok')
        ->orderBy('fecha_programacion', 'desc')
        ->get();

        return view('reportes.reporte_qr', compact('programaciones'));
    }


    /**
     * Exporta el reporte de programaciones QR filtrado a Excel.
     */
    public function exportQr(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        
        $fecha = now()->format('Ymd_His');
        $nombreArchivo = "reporte_programaciones_qr_{$fecha}.xlsx";

        // Creamos la instancia de la clase Export y le pasamos las fechas
        return Excel::download(new ProgramacionesQrExport($fechaInicio, $fechaFin), $nombreArchivo);
    }
}