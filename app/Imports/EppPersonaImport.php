<?php

namespace App\Imports;

use App\Models\Persona;
use App\Models\Epp;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class EppPersonaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Normalizar claves: quitar espacios, convertir a minúsculas
        $cleanRow = [];
        foreach ($row as $key => $value) {
            if ($key === null) continue;
            $normalized = preg_replace('/\s+/', '', strtolower($key));
            $cleanRow[$normalized] = $value;
        }

        // === VALIDAR COLUMNA DNI ===
        if (!array_key_exists('dni', $cleanRow)) {
            throw new \Exception("Columna 'dni' no existe. Encabezados detectados: " . implode(', ', array_keys($cleanRow)));
        }

        // Convertir DNI float a texto
        $dni = trim((string)$cleanRow['dni']);
        $dni = trim(str_replace('.0', '', (string)($cleanRow['dni'] ?? '')));

        if ($dni === '' || !is_numeric($dni)) {
            // Saltar fila sin DNI
            return null;
        }

        // === PERSONA: BUSCAR O CREAR ===
        $persona = Persona::where('dni', $dni)->first();

        if (!$persona) {
            $persona = Persona::create([
                'dni'     => $dni,
                'nombres' => $cleanRow['nombres_apellidos'] ?? 'SIN NOMBRE',
                'cargo'   => null,
                'area'    => null,
                'estado'  => 1, // o el valor que uses
            ]);
        }

        // === VALIDAR EPP ===
        if (!isset($cleanRow['epp']) || trim($cleanRow['epp']) === '') {
            // Saltar fila sin EPP
            return null;
        }

        $nombreEpp = trim($cleanRow['epp']);

        $epp = Epp::firstOrCreate(
            ['nombre' => $nombreEpp],
            [
                'codigo' => 'EPP-' . str_pad((Epp::max('id') + 1), 4, '0', STR_PAD_LEFT),
                'stock'  => 0,
            ]
        );

        // === CANTIDAD ===
        $cantidad = intval($cleanRow['cantidad'] ?? 0);

        // === FECHA ENTREGA ===
        $fechaEntrega = null;
        if (!empty($cleanRow['fecha_entrega'])) {
            try {
                if (is_numeric($cleanRow['fecha_entrega'])) {
                    $fechaEntrega = Carbon::instance(Date::excelToDateTimeObject($cleanRow['fecha_entrega']));
                } else {
                    $fechaEntrega = Carbon::parse($cleanRow['fecha_entrega']);
                }
            } catch (\Exception $e) {
                $fechaEntrega = null;
            }
        }

        // === INSERTAR REGISTRO EN TABLA PIVOTE ===
        DB::table('epp_persona')->insert([
            'persona_id' => $persona->id,
            'epp_id'     => $epp->id,
            'cantidad'   => $cantidad,
            'fecha_entrega' => $fechaEntrega,
            'numero_vale'   => $cleanRow['numero_vale'] ?? null,
            'orden_trabajo' => $cleanRow['orden_trabajo'] ?? null,
            'observacion'   => $cleanRow['observacion'] ?? null,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        if ($cantidad > 0) {
            $epp->decrement('stock', $cantidad);
        }

        return null;
    }
}
