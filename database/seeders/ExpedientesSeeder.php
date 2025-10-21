<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpedientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('expedientes')->insert([
            [
                'id' => 1,
                'tisur_id' => 2,
                'programacion_id' => 1,
                'numero_factura_exped' => 'E001-181',
                'total' => 4526.23,
                'detraccion' => 123.23,
                'estado_pago_detraccion' => null,
                'total_con_detraccion' => null,
                'deposito_a_proveer' => null,
                'fecha_pago' => '2025-10-17',
                'fecha_carga' => '2025-10-16',
                'conformidad_exped' => null,
                'archivo' => null,
                'comentarios' => 'test test test',
                'created_at' => '2025-10-16 21:05:16',
                'updated_at' => '2025-10-16 21:05:16',
            ],
            
        ]);
    }
}
