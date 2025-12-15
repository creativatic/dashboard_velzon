<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetalleProgramacion;

class DetalleProgramacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detalles = [
            [
                'frente' => 'Huanaco',
                'precio_frente' => 4500,
                'precio_tn' => 0.1240,
                'activo' => true,
                'descripcion' => 'Frente Huanaco: zona con mayor carga y mejor acceso, precio estándar establecido según contrato 2025.'
            ],
            [
                'frente' => 'Intikal',
                'precio_frente' => 3500,
                'precio_tn' => 0.1220,
                'activo' => true,
                'descripcion' => 'Frente Intikal: área de menor tonelaje, precio ajustado para rutas de menor productividad.'
            ],
            [
                'frente' => 'Intikal 0.095',
                'precio_frente' => 3500,
                'precio_tn' => 0.0950,
                'activo' => true,
                'descripcion' => 'Frente Intikal: área de menor tonelaje, precio ajustado para rutas de menor productividad.'
            ],
            [
                'frente' => 'Huanaco 22',
                'precio_frente' => 00,
                'precio_tn' => 22.00,
                'activo' => true,
                'descripcion' => 'Frente Huanaco: área de menor tonelaje, precio ajustado para rutas de menor productividad.'
            ],
        ];

        foreach ($detalles as $detalle) {
            DetalleProgramacion::create($detalle);
        }
    }
}
