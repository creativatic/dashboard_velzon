<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epp extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'talla',
        'unidades_medidas',
        'categoria',
        'stock',
        'descripcion',
        'estado',
    ];

    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'epp_persona')
                    ->withPivot('fecha_entrega', 'fecha_devolucion', 'cantidad', 'observacion')
                    ->withTimestamps();
    }
}