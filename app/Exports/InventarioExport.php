<?php

namespace App\Exports;

use App\Models\Epp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InventarioExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Epp::orderBy('nombre', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'Codigo',
            'Nombre',
            'Unidad Medida',
            'Stock',
            'Categoria',
            'Talla',
            'Estado',
        ];
    }

    public function map($epp): array
    {
        return [
            $epp->codigo,
            $epp->nombre,
            $epp->unidades_medidas,
            $epp->stock,
            $epp->categoria,
            $epp->talla,
            $epp->estado ? 'Activo' : 'Inactivo',
        ];
    }
}