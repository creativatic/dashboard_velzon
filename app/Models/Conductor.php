<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table = 'conductores'; // ← AGREGAR ESTO

    protected $fillable = [
        'unidad_id',
        'dni',
        'licencia',
        'nombres',
        'apellidos',
        'telefono',
    ];

    // Un conductor pertenece a una unidad
    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }
}
