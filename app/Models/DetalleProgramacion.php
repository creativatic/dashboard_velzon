<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleProgramacion extends Model
{
    use HasFactory;

    protected $table = 'detalle_programacions';

    protected $fillable = [
        'programacion_id',
        'frente',
        'precio_frente', 
        'precio_tn',
        'activo',
        'descripcion'
        // Sin created_by ni updated_by
    ];

    protected $casts = [
        'precio_frente' => 'decimal:2',
        'precio_tn' => 'decimal:2',
        'activo' => 'boolean'
    ];

    /**
     * Relación con Programacion
     */
    public function programacion(): BelongsTo
    {
        return $this->belongsTo(Programacion::class);
    }

    /**
     * Scope para detalles activos
     */
    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }
}