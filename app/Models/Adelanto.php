<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adelanto extends Model
{
    use HasFactory;

    protected $fillable = [
        'programacion_id',
        'monto_adelanto',
        'fecha_pago_adelantos',
        'glosa_banco',
        'notas',
        'created_by',
        'updated_by',
    ];

    /**
     * Relación con la programación.
     * Cada adelanto pertenece a una programación.
     */
    public function programacion()
    {
        return $this->belongsTo(Programacion::class);
    }

    /**
     * Relación con el usuario que creó el registro.
     */
    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relación con el usuario que actualizó el registro.
     */
    public function actualizador()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
