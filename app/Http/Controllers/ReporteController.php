<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programacion;

class ReporteController extends Controller
{
    public function reporteQr()
    {
        $programaciones = Programacion::all();
        return view('reportes.reporte_qr', compact('programaciones'));
    }
}
