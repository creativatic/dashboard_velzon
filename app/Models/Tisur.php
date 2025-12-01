<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tisur extends Model
{
    use HasFactory;

    // Nombre de tabla por convención: 'tisurs' -> no es necesario declarar $table
    protected $fillable = [
        'numero_ticket',
        'fecha_hora_ingreso',
        'placa_tracto',
        'fecha_hora_salida',
        'primer_peso',
        'segundo_peso',
        'razon_social',
        'transportista',
        'tipo_carga_tisur',   // antes 'carga'
        'numero_bultos',
        'peso_neto',
        'tipo_plataforma',    // antes 'tipo'
        'documento_origen',
        'precio_tisur',       // antes 'precio'
        'total_tisur',        // antes 'total'
        'retencion_tisur',    // antes 'retencion'
        'pago_tisur',         // antes 'pago'
        'factura_tisur',      // antes 'factura'
        'estado',
        'fecha_pago',
        'orden_tisur',        // antes 'orden'
    ];

    protected $casts = [
        'fecha_hora_ingreso'  => 'datetime:Y-m-d H:i:s',
        'fecha_hora_salida'   => 'datetime:Y-m-d H:i:s',
        'fecha_pago'          => 'date:Y-m-d',
        'primer_peso'         => 'decimal:5',
        'segundo_peso'        => 'decimal:5',
        'numero_bultos'       => 'decimal:5',
        'peso_neto'           => 'decimal:5',
        'precio_tisur'        => 'decimal:5',
        'total_tisur'         => 'decimal:5',
        'retencion_tisur'     => 'decimal:5',
        'pago_tisur'          => 'decimal:5',
    ];

    /**
     * Un Tisur tiene muchos Expedientes (según tu especificación).
     */
    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

}
