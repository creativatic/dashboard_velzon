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
        'guia_remision',

        // Datos del servicio
        'tipo_mineral',
        'tipo_operacion',
        'conformidad_adelanto',
        'guia_transportista',
        'grupo_cargio',

        // Adelantos
        'monto_adelanto',
        'fecha_pago_adelantos',
        'glosa_banco',
        'notas',

        // Conductor
        'conductor_id',
        'licencia',
        'dni',
        'nombres_conductor',
        'apellidos_conductor',
        'telefono_conductor',

        // Unidad
        'unidad_id',
        'placa_tracto',
        'placa_carreta',
        'marca_vehiculo',
        'tipo_plataforma',
        'constancia_mtc_tracto',
        'constancia_mtc_carreta',

        // Proveedor
        'proveedor_id',
        'razon_social_transporte',
        'ruc_transporte',
        'banco',
        'cuenta_banco',
        'cci_banco',

        // Relaciones
        'detalle_programacion_id',
        'unidad_id',
        'proveedor_id',
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

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    // (opcional) accesores / helpers
    public function proveedorUnidadPrincipal()
    {
        // Devuelve la primera unidad asociada al proveedor (si la hay)
        return $this->proveedor?->unidades?->first();
    }

}
