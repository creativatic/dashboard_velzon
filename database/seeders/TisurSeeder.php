<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TisurSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tisurs')->insert([
            [
                'id' => 1,
                'numero_ticket'     => 'MB01883333',
                'fecha_hora_ingreso'=> '2025-10-16 16:36:00',
                'placa_tracto'      => 'V9C-705',
                'fecha_hora_salida' => '2025-10-17 16:36:00',
                'primer_peso'       => '40380.00000',
                'segundo_peso'      => '40380.00000',
                'razon_social'      => 'SEVEN SEAS PERU MINERAL S.A.C.',
                'transportista'     => 'TRANS. JULICES C & H R.R.L.',
                'tipo_carga_tisur'  => 'MINERAL DE HIERRO',
                'numero_bultos'     => '40380.00',
                'peso_neto'         => '40380.00000',
                'tipo_plataforma'   => 'METALERO',
                'documento_origen'  => 'SSPM 05.25 - B&H',
                'precio_tisur'      => '0.07195',
                'total_tisur'       => '2501.54000',
                'retencion_tisur'   => '125.08000',
                'pago_tisur'        => '2376.46000',
                'factura_tisur'     => 'E001-835',
                'estado'            => 'Pendiente',
                'fecha_pago'        => '2025-10-30',
                'orden_tisur'       => 'P0015-006',
            ],
            [
                'id' => 2,
                'numero_ticket'     => 'MB00002222',
                'fecha_hora_ingreso'=> '2025-10-16 16:36:00',
                'placa_tracto'      => 'BVN-781',
                'fecha_hora_salida' => '2025-10-16 08:14:00',
                'primer_peso'       => '46310.00000',
                'segundo_peso'      => '46310.00000',
                'razon_social'      => 'SEVEN SEAS PERU MINERAL S.A.C.',
                'transportista'     => 'TRANS. JULICES C & H R.R.L.',
                'tipo_carga_tisur'  => 'MINERAL DE HIERRO',
                'numero_bultos'     => '40380.00',
                'peso_neto'         => '46310.00000',
                'tipo_plataforma'   => 'AUTODESCARGABLE',
                'documento_origen'  => 'SSPM 05.25 - B&H',
                'precio_tisur'      => '0.06195',
                'total_tisur'       => '2501.54000',
                'retencion_tisur'   => '125.08000',
                'pago_tisur'        => '2376.46000',
                'factura_tisur'     => '-',
                'estado'            => 'Pendiente',
                'fecha_pago'        => '2025-10-30',
                'orden_tisur'       => 'P0015-006',
            ],
        ]);
    }
}
