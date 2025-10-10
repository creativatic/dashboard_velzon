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

    public function adelantos()
    {
        return $this->hasMany(Adelantos::class);
    }

    public function qrTisurs()
    {
        return $this->hasMany(QrTisur::class);
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleProgramacion::class);
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
