<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tisur extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_ticket',
        'fecha_hora_ingreso',
        'placa_tracto',
        'fecha_hora_salida',
        'primer_peso',
        'segundo_peso',
        'razon_social',
        'transportista',
        'carga',
        'numero_bultos',
        'peso_neto',
        'tipo',
        'documento_origen',
        'precio',
        'total',
        'retencion',
        'pago',
        'factura',
        'estado',
        'guia_remision',
        'fecha_pago',
        'orden',
    ];
}
