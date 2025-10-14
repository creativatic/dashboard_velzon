<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    use HasFactory;

    protected $table = 'programacions';

    protected $fillable = [
        'fecha_programacion',
        'dni',
        'guia_remision',
        'placa_tracto',
        'placa_carreta',
        'marca_vehiculo',
        'tipo_plataforma',
        'constancia_mtc_tracto',
        'constancia_mtc_carreta',
        'razon_social_transporte',
        'ruc_transporte',
        'nombres_conductor',
        'apellidos_conductor',
        'licencia',
        'telefono_conductor',
        'cuenta_banco',
        'cci_banco',
        'banco',
        'tipo_mineral',
        'tipo_operacion',
        'conformidad_adelanto',
        'guia_transportista',
        'grupo_cargio',
        'detalle_programacion_id',
    ];

    // Una programación puede tener muchos adelantos
    public function adelantos()
    {
        return $this->hasMany(Adelantos::class);
    }

    // ✅ Cada programación pertenece a un detalle
    public function detalleProgramacion()
    {
        return $this->belongsTo(DetalleProgramacion::class, 'detalle_programacion_id');
    }

    // Una programación puede tener varios expedientes
    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

    // Una programación tiene un seguimiento
    public function seguimiento()
    {
        return $this->hasOne(Seguimiento::class);
    }


    public function obtenerPrecioFrente($frente)
    {
        return $this->detalles()
            ->where('frente', $frente)
            ->where('activo', true)
            ->value('precio_frente');
    }

    public function obtenerPrecioTn($frente)
    {
        return $this->detalles()
            ->where('frente', $frente)
            ->where('activo', true)
            ->value('precio_tn');
    }

}
