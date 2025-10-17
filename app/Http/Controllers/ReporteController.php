<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programacion;

class ReporteController extends Controller
{
    public function reporteQr()
    {
        $programaciones = Programacion::where('conformidad_adelanto', 'Ok')
            ->orderBy('fecha_programacion', 'desc')
            ->get();

        return view('reportes.reporte_qr', compact('programaciones'));
    }

}
