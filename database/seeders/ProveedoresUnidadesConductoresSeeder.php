<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Proveedor;
use App\Models\Unidad;
use App\Models\Conductor;
use Illuminate\Support\Str;

class ProveedoresUnidadesConductoresSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $proveedores = [
                [
                    'razon_social' => 'TRANSPORTES EL AGUILA S.A.C.',
                    'ruc_transporte' => '20601234567',
                    'cuenta_banco' => '123-45678901',
                    'cci_banco' => '00212345678901234567',
                    'banco' => 'BCP',
                ],
                [
                    'razon_social' => 'LOGISTICA MINERA PERU S.R.L.',
                    'ruc_transporte' => '20599876543',
                    'cuenta_banco' => '456-98765432',
                    'cci_banco' => '00298765432109876543',
                    'banco' => 'Interbank',
                ],
                [
                    'razon_social' => 'TRANSPORTES VIRGEN DEL CARMEN E.I.R.L.',
                    'ruc_transporte' => '20456789321',
                    'cuenta_banco' => '789-12345678',
                    'cci_banco' => '00245678912345678901',
                    'banco' => 'BBVA',
                ],
            ];

            foreach ($proveedores as $provData) {

                $proveedor = Proveedor::firstOrCreate(
                    ['ruc_transporte' => $provData['ruc_transporte']],
                    $provData
                );

                // Crear UNA UNIDAD
                $unidad = Unidad::create([
                    'placa_tracto' => 'ABC-' . rand(100, 999),
                    'placa_carreta' => 'XYZ-' . rand(100, 999),
                    'marca_vehiculo' => 'Volvo',
                    'tipo_plataforma' => 'FURGÓN',
                    'constancia_mtc_tracto' => 'MTC-' . rand(10000, 99999),
                    'constancia_mtc_carreta' => 'MTC-' . rand(10000, 99999),
                    'proveedor_id' => $proveedor->id,
                ]);

                // Crear CONDUCTOR SIN unidad_id
                $conductor = Conductor::create([
                    'dni' => str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                    'licencia' => 'AIIIB-' . rand(100000, 999999),
                    'nombres' => 'Juan ' . rand(1, 99),
                    'apellidos' => 'Perez ' . rand(1, 99),
                    'telefono' => '9' . rand(10000000, 99999999),
                ]);

                // 🌟 ASOCIAR CONDUCTOR Y UNIDAD A TRAVÉS DE LA TABLA PIVOTE
                $conductor->unidades()->attach($unidad->id);
            }
        });
    }
}
