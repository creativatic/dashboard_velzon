<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QrTisur;
use App\Models\Programacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QrTisurController extends Controller
{
    /**
     * Listado general
     */
    public function index()
    {
        $qr_tisurs = QrTisur::with('programacion')->latest()->paginate(10); // ← Cambiado a snake_case
        return view('qr_tisurs.index', compact('qr_tisurs'));
    }
    /**
     * Formulario de creación
     */
    public function create()
    {
        $programaciones = Programacion::orderBy('id', 'desc')->get();
        return view('qr_tisurs.create', compact('programaciones'));
    }

    /**
     * Guardar nuevo registro
     */
    public function store(Request $request)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
            'placa_tracto' => 'required|string|max:20',
            'licencia' => 'required|string|max:20',
            'dni' => 'required|string|max:8',
        ]);

        QrTisur::create([
            ...$request->all(),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('qr_tisurs.index')->with('success', 'QR TISUR registrado correctamente.');
    }

    /**
     * Editar registro
     */
    public function edit(QrTisur $qr_tisur)
    {
        $programaciones = Programacion::orderBy('id', 'desc')->get();
        return view('qr_tisurs.edit', compact('qr_tisur', 'programaciones'));
    }

    /**
     * Actualizar registro
     */
    public function update(Request $request, QrTisur $qr_tisur)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
            'placa_tracto' => 'required|string|max:20',
            'licencia' => 'required|string|max:20',
            'dni' => 'required|string|max:8',
        ]);

        $qr_tisur->update([
            ...$request->all(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('qr_tisurs.index')->with('success', 'QR TISUR actualizado correctamente.');
    }

    /**
     * Eliminar registro
     */
    public function destroy(QrTisur $qr_tisur)
    {
        $qr_tisur->delete();
        return redirect()->route('qr_tisurs.index')->with('success', 'QR TISUR eliminado correctamente.');
    }
}
