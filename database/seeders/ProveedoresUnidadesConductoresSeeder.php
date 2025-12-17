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
                    'razon_social' => 'TRANSPORTES CUARENTA S.A.C.',
                    'ruc_transporte' => '20607606596',
                    'cuenta_banco' => '3003003615486',
                    'cci_banco' => '00330000300361548619',
                    'banco' => 'INTERBANK',
                ],
                [
                    'razon_social' => 'BARRACA LAS GEMELAS E.I.R.L',
                    'ruc_transporte' => '20450586464',
                    'cuenta_banco' => '0011-0201-0100055735',
                    'cci_banco' => '011-201-000100055735-13',
                    'banco' => 'BBVA',
                ],
                [
                    'razon_social' => 'RENATO WILFREDO PAREDES SANCHEZ',
                    'ruc_transporte' => '10770686216',
                    'cuenta_banco' => '25032011880063',
                    'cci_banco' => '00225013201188006391',
                    'banco' => 'BCP',
                ],
                [
                    'razon_social' => 'MARÍA CRISTINA  RUIZ MERINO',
                    'ruc_transporte' => '10453903163',
                    'cuenta_banco' => '215-97737660003',
                    'cci_banco' => '002-21519773766000325',
                    'banco' => 'BCP',
                ],
                [
                    'razon_social' => 'HECTOR AYALA TTITO',
                    'ruc_transporte' => '10253182577',
                    'cuenta_banco' => '28507680435081',
                    'cci_banco' => '00228510768043508156',
                    'banco' => 'BCP',
                ],
                [
                    'razon_social' => 'MAQUINARIAS JEDAM SAC',
                    'ruc_transporte' => '20564305473',
                    'cuenta_banco' => '500-0872506',
                    'cci_banco' => '009-151-205000872506-24',
                    'banco' => 'SCOTIABANK',
                ],
                [
                    'razon_social' => 'POWERCON GROUP SAC',
                    'ruc_transporte' => '20603752768',
                    'cuenta_banco' => '1918144444',
                    'cci_banco' => '00219100814444006951',
                    'banco' => 'BCP',
                ],
                [
                    'razon_social' => 'GRÚAS Y TRANSPORTE GTSG SAC',
                    'ruc_transporte' => '20613490613',
                    'cuenta_banco' => '0011-0241-0200855834',
                    'cci_banco' => '011-241-000200855834-74',
                    'banco' => 'BBVA',
                ],
                [
                    'razon_social' => 'EMPRESA DE TRANSPORTE RIALVA SMR EIRL',
                    'ruc_transporte' => '20574719993',
                    'cuenta_banco' => '2202165985056',
                    'cci_banco' => '002-220-002165985056-20',
                    'banco' => 'BCP',
                ],
                [
                    'razon_social' => 'REPUESTOS Y SERVICIOS NICOS EIRL',
                    'ruc_transporte' => '20539682521',
                    'cuenta_banco' => '001107640200295557789',
                    'cci_banco' => '01176400020029555',
                    'banco' => 'BBVA',
                ],
                [
                    'razon_social' => 'OLQUI TRANSER EIRL',
                    'ruc_transporte' => '20606110791',
                    'cuenta_banco' => '5003007814798',
                    'cci_banco' => '00350000300781479867',
                    'banco' => 'INTERBANK',
                ],
                [
                    'razon_social' => 'FLORES CHITE BRILLYTH YOLIZA',
                    'ruc_transporte' => '10296898894',
                    'cuenta_banco' => '215-92140385-0-91',
                    'cci_banco' => '00221519214038509126',
                    'banco' => 'BCP',
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
