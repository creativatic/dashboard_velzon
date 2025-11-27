<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;
    // use SoftDeletes; // Si lo estás usando
    protected $table = 'unidades';

    protected $fillable = [
        'placa_tracto',
        'placa_carreta',
        'marca_vehiculo',
        'tipo_plataforma',
        'constancia_mtc_tracto',
        'constancia_mtc_carreta',
        'proveedor_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    // Una unidad tiene un conductor (one-to-one)
    public function conductor()
    {
        return $this->hasOne(Conductor::class, 'unidad_id');
    }
}
