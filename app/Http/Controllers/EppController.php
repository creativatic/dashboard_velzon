<?php

namespace App\Http\Controllers;

use App\Models\Epp;
use Illuminate\Http\Request;

class EppController extends Controller
{
    public function index(Request $request)
    {
        $query = Epp::query();

        // Si hay búsqueda por nombre o código
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($qBuilder) use ($q) {
                $qBuilder->where('nombre', 'LIKE', "%{$q}%")
                        ->orWhere('codigo', 'LIKE', "%{$q}%");
            });
        }

        // --- CAMBIO AQUÍ ---
        // Primero ordenamos por estado (1 primero, 0 al final) 
        // y luego por nombre para mantener el orden alfabético interno
        $epps = $query->orderBy('estado', 'desc')
                    ->orderBy('nombre', 'asc')
                    ->paginate(10)
                    ->withQueryString();

        return view('epps.index', compact('epps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:50|unique:epps,codigo',
            'talla' => 'nullable|string|max:50',
            'categoria' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'unidades_medidas' => 'nullable|string|max:20',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        Epp::create($request->all());
        return redirect()->route('epps.index')->with('success', 'EPP agregado correctamente.');
    }


    public function update(Request $request, Epp $epp)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:50|unique:epps,codigo,' . $epp->id,
            'talla' => 'nullable|string|max:50',
            'categoria' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'unidades_medidas' => 'nullable|string|max:20',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $epp->update($request->all());
        return redirect()->route('epps.index')->with('success', 'EPP actualizado correctamente.');
    }

    public function destroy(Epp $epp)
    {
        $epp->delete();
        return redirect()->route('epps.index')->with('success', 'EPP eliminado correctamente.');
    }

    public function buscar($term)
    {
        return response()->json(
            Epp::where('estado', 1) // ✅ SOLO EPP ACTIVOS
                ->where('nombre', 'LIKE', "%{$term}%")
                ->select('id', 'nombre', 'stock', 'unidades_medidas')
                ->limit(10)
                ->get()
        );
    }

    public function autocomplete(Request $request)
    {
        $term = $request->input('term');

        $resultados = Epp::where('nombre', 'LIKE', "%{$term}%")
            ->orWhere('codigo', 'LIKE', "%{$term}%")
            ->limit(10)
            ->get();

        return response()->json(
            $resultados->map(function ($epp) {
                return [
                    'id' => $epp->id,
                    'label' => $epp->nombre,
                    'codigo' => $epp->codigo,
                ];
            })
        );
    }


}
