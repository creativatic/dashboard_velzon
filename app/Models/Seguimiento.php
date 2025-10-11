<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'programacion_id',
        'carguio',
        'material',
        'frente',
        'estado',
        'placa',
        'conductor',
        'telefono',
        'notas',
    ];

    // ✅ Relación inversa (muchos a uno)
    public function programacion()
    {
        return $this->belongsTo(Programacion::class);
    }
}
