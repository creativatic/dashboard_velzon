<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volquete extends Model
{
    protected $fillable = [
        'fecha',
        'proveedor_id',
        'detalle_programacion_id',
        'hora_vuelta_1',
        'lampadas_vuelta_1',
        'peso_vuelta_1',
        'hora_vuelta_2',
        'lampadas_vuelta_2',
        'peso_vuelta_2',
        'conformidad',
        'total_lampadas_dia',
        'total_peso_dia',
        'pasadas',
        'total',
        'detraccion',
        'retencion',
        'deposito_a_proveer',
        'deposito_total',
        'fecha_pago',
        'factura',
        'observaciones',
        'comprobante_pago',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalleProgramacion()
    {
        return $this->belongsTo(DetalleProgramacion::class);
    }
}

