<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;


class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'razon_social',
        'ruc_transporte',
        'cuenta_banco',
        'cci_banco',
        'banco',
    ];

    // Un proveedor tiene muchas programaciones
    public function programacions()
    {
        return $this->hasMany(Programacion::class);
    }

    // Un unidad tiene un solo proveedor
    public function unidades()
    {
        return $this->hasMany(Unidad::class);
    }
    
    //✅Reglas de validación
    public static function rules($id = null)
    {
        return [
            'razon_social' => 'required|string|max:100',
            'ruc_transporte' => [
                'required',
                'string',
                'size:11',
                Rule::unique('proveedores')->ignore($id),
            ],
            'banco' => 'nullable|string|max:50',
            'cuenta_banco' => 'nullable|string|max:50',
            'cci_banco' => 'nullable|string|max:50',
        ];
    }


}
