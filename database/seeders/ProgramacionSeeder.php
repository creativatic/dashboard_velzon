<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgramacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programacions')->insert([
            [
                'id' => 1,
                'fecha_programacion' => '2025-10-16 13:13:00',
                'dni' => '40286831',
                'guia_remision' => 'EG07 - 00003332',
                'placa_tracto' => 'ACJ-722',
                'placa_carreta' => 'BBI-997',
                'marca_vehiculo' => 'SCANIA',
                'tipo_plataforma' => 'PLATAFORMA',
                'constancia_mtc_tracto' => '15M24053311E',
                'constancia_mtc_carreta' => '04M22001332E',
                'razon_social_transporte' => 'Edeluc Servicios y Negocios Generales E.I.R.L',
                'ruc_transporte' => '10418234780',
                'nombres_conductor' => 'HOSLEYRIVAN',
                'apellidos_conductor' => 'NIMA MONTALBÁN',
                'licencia' => 'H40286831',
                'telefono_conductor' => '952808844',
                'cuenta_banco' => '000-4291629',
                'cci_banco' => '00941900000429162936',
                'banco' => 'BCP',
                'tipo_mineral' => 'HIERRO GRANULADO',
                'tipo_operacion' => 'nacional',
                'conformidad_adelanto' => 'ok',
                'guia_transportista' => 'EG03 - 00000170',
                'grupo_cargio' => 'Carguio 13,09',
                'detalle_programacion_id' => 1,
                'created_at' => Carbon::parse('2025-10-16 13:13:58'),
                'updated_at' => Carbon::parse('2025-10-16 13:13:58'),
            ],
        ]);
    }
}
