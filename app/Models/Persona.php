<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres', 
        'dni', 
        'cargo', 
        'area', 
        'estado'
    ];

    public function epps()
    {
        return $this->belongsToMany(Epp::class, 'epp_persona')
                    ->withPivot('fecha_entrega', 'fecha_devolucion', 'cantidad', 'observacion')
                    ->withTimestamps();
    }
}
