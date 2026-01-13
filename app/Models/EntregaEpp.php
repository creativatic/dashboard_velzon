<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregaEpp extends Model
{
    use HasFactory;

    protected $table = 'epp_persona';

    //epp_persona

    protected $fillable = [
        'persona_id',
        'epp_id',
        'fecha_entrega',
        'fecha_devolucion',
        'cantidad',
        'observacion',
        'numero_vale',
        'orden_trabajo'
    ];

    public function personas()
    {
        return $this->belongsTo(Persona::class);
    }

    public function epps()
    {
        return $this->belongsTo(Epp::class);
    }
}
