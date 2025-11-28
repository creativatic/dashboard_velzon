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

    public function unidades()
    {
        return $this->belongsToMany(Unidad::class, 'conductor_unidad')
                    ->withTimestamps();
    }

}
