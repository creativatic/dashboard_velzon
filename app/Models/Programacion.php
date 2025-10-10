<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'guia_remision',
        'placa_tracto',
        'placa_carreta',
        'marca_vehiculo',
        'tipo_plataforma',
        'constancia_mtc',
        'constancia_mtc_carreta',
        'razon_social_transporte',
        'ruc_transporte',
        'conductor',
        'licencia',
        'telefono_conductor',
        'cuenta',
        'cci',
        'banco',
        'tipo_mineral',
        'numero_guia',
        'conformidad_adelanto',
        'guia_transportista',
        'logistica',
    ];
}
