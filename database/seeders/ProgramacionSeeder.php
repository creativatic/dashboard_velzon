<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Programacion;
use App\Models\Proveedor;
use App\Models\DetalleProgramacion;

class ProgramacionSeeder extends Seeder
{
    public function run(): void
    {
        $proveedor = Proveedor::first();
        $detalle = DetalleProgramacion::first();

        Programacion::create([
            'fecha_programacion'   => now(),
            'guia_remision'        => 'EG07 - 00003332',

            'tipo_mineral'         => 'HIERRO GRANULADO',
            'tipo_operacion'       => 'nacional',
            'conformidad_adelanto' => 'Ok',
            'guia_transportista'   => 'EG03 - 00000170',
            'grupo_cargio'         => 'Carguio 13,09',

            'monto_adelanto'       => 1200.50,
            'fecha_pago_adelantos' => now(),
            'glosa_banco'          => 'Transferencia registrada',
            'notas'                => 'Adelanto procesado correctamente',

            'detalle_programacion_id' => $detalle?->id,
            'proveedor_id'            => $proveedor?->id,
        ]);

        Programacion::create([
            'fecha_programacion'   => now(),
            'guia_remision'        => 'FG09 - 00006662',

            'tipo_mineral'         => 'HIERRO GRANULADO',
            'tipo_operacion'       => 'nacional',
            'conformidad_adelanto' => 'Pendiente',
            'guia_transportista'   => 'EG03 - 00000170',
            'grupo_cargio'         => 'Carguio 13,09',

            'monto_adelanto'       => 0,
            'glosa_banco'          => 'Pendiente',
            'notas'                => 'Pendiente de transferencia bancaria',

            'detalle_programacion_id' => $detalle?->id,
            'proveedor_id'            => $proveedor?->id,
        ]);
    }
}
