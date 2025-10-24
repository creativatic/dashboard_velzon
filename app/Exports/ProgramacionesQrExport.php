<?php

namespace App\Exports;

use App\Models\Programacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon; // ⬅️ Necesario para manejar fechas

class ProgramacionesQrExport implements FromCollection, WithHeadings, WithMapping
{
    protected $fechaInicio;
    protected $fechaFin;

    // 1. CONSTRUCTOR: Recibe las fechas
    public function __construct($fechaInicio = null, $fechaFin = null)
    {
        $this->fechaInicio = $fechaInicio ? Carbon::parse($fechaInicio)->startOfDay() : null;
        $this->fechaFin = $fechaFin ? Carbon::parse($fechaFin)->endOfDay() : null;
    }

    /**
    * Define la colección de datos a exportar, aplicando el filtro de fecha.
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Programacion::where('conformidad_adelanto', 'Ok');

        // Aplicar filtro por fecha si ambas están presentes
        if ($this->fechaInicio && $this->fechaFin) {
            // El campo fecha_programacion es DateTime, por eso usamos whereBetween
            // NOTA: Si tu campo es solo DATE, podrías necesitar ajustar el formato de las fechas
            $query->whereBetween('fecha_programacion', [$this->fechaInicio, $this->fechaFin]);
        }
        
        return $query->orderBy('fecha_programacion', 'desc')->get();
    }

    /**
     * Define los encabezados de las columnas...
     * (El resto de esta clase NO cambia)
     */
    public function headings(): array
    {
        return [
            'Placa Tracto',
            'Licencia',
            'DNI',
            'Nombres Conductor',
            'Apellidos Conductor',
            'RUC Transporte',
            'Razón Social Transporte',
            'Tipo Operación',
            'Placa Carreta',
            'Guía Remisión',
            'Grupo Carguío',
        ];
    }
    
    /**
     * Mapea cada objeto Programacion a una fila en el Excel...
     */
    public function map($programacion): array
    {
        return [
            $programacion->placa_tracto ?? '',
            $programacion->licencia ?? '',
            $programacion->dni ?? '',
            $programacion->nombres_conductor ?? '',
            $programacion->apellidos_conductor ?? '',
            $programacion->ruc_transporte ?? '',
            $programacion->razon_social_transporte ?? '',
            ucfirst($programacion->tipo_operacion ?? ''),
            $programacion->placa_carreta ?? '',
            $programacion->guia_remision ?? '',
            $programacion->grupo_cargio ?? '',
        ];
    }
}