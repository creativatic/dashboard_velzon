<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KardexExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('epp_persona as ep')
            ->join('personas as p', 'ep.persona_id', '=', 'p.id')
            ->join('epps as e', 'ep.epp_id', '=', 'e.id')
            ->select(
                'ep.id',
                'ep.numero_vale',
                'ep.orden_trabajo',
                'p.nombres as persona',
                'e.nombre as epp',
                DB::raw("CONCAT(ep.cantidad, ' ', e.unidades_medidas) as cantidad_entregada"),
                'ep.fecha_entrega',
                'ep.fecha_devolucion',
                'ep.observacion',
                'ep.created_at',
                'ep.updated_at'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'N° Vale',
            'Orden Trabajo',
            'Persona',
            'EPP',
            'Cantidad Entregada',
            'Fecha Entrega',
            'Fecha Devolución',
            'Observación',
            'Creado',
            'Actualizado'
        ];
    }
}