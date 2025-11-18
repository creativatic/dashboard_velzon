<?php

namespace App\Imports;

use App\Models\Persona;
use App\Models\Epp;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class EppPersonaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Obtener persona por DNI
        $persona = Persona::where('dni', $row['dni'])->first();

        if (!$persona) {
            throw new \Exception("DNI no encontrado: " . $row['dni']);
        }

        // Obtener EPP por nombre exacto
        $epp = Epp::where('nombre', $row['epp'])->first();

        if (!$epp) {
            throw new \Exception("EPP no encontrado: " . $row['epp']);
        }

        // Registrar en epp_persona
        DB::table('epp_persona')->insert([
            'persona_id'       => $persona->id,
            'epp_id'           => $epp->id,
            'cantidad'         => $row['cantidad'],
            'fecha_entrega'    => Carbon::parse($row['fecha_entrega']),
            'fecha_devolucion' => $row['fecha_devolucion'] ?? null,
            'numero_vale'      => $row['numero_vale'] ?? null,
            'orden_trabajo'    => $row['orden_trabajo'] ?? null,
            'observacion'      => $row['observacion'] ?? null,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        // Disminuir stock
        $epp->decrement('stock', $row['cantidad']);

        return null;
    }
}
