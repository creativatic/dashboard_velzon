<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrTisur extends Model
{
    use HasFactory;

    protected $table = 'qr_tisurs';

    protected $fillable = [
        'programacion_id',
        'placa_tracto',
        'licencia',
        'dni',
        'nombres_conductor',
        'apellidos_conductor',
        'ruc_transporte',
        'razon_social_transporte',
        'created_by',
        'updated_by'
    ];

    /**
     * Relación con Programacion
     */
    public function programacion(): BelongsTo
    {
        return $this->belongsTo(Programacion::class);
    }

    /**
     * Relación con User (creador)
     */
    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relación con User (actualizador)
     */
    public function actualizador()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}