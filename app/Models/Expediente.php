<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'programacion_id',
        'tisur_id',
        'fecha_carga',
        'guia_remitente',
        'placa_tracto',
        'placa_carreta',
        'razon_social_empresa',
        'ruc',
        'conductor',
        'licencia',
        'telefono',
        'cuenta_banco',
        'cci_banco',
        'banco',
        'guia_transportista',
        'material',
        'numero_ticke_exped',
        'guia_remision',
        'numero_factura_exped',
        'fecha_ingreso',
        'peso_entrada',
        'segundo_pesaje',
        'peso_neto',
        'costo_tn',
        'total',
        'detraccion',
        'estado_pago_detraccion',
        'total_con_detraccion',
        'deposito_a_proveer',
        'fecha_pago',
        'conformidad_exped',
        'grupo_carguio',
        'archivo',
        'frente',
        'glosa_bancos',
        'comentarios',
        
    ];
    public function tisur()
    {
        return $this->belongsTo(Tisur::class, 'tisur_id');
    }

    public function programacion()
    {
        return $this->belongsTo(Programacion::class,  'programacion_id');
    }
}
