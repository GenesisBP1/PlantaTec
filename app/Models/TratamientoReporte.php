<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TratamientoReporte extends Model
{
    protected $fillable = [
        'id_reporte_problema',
        'id_tratamiento',
        'frecuencia_dias',
        'fecha_inicio',
        'fecha_proxima',
        'estado',
        'imagen',
        'descripcion',
    ];

    public function reporteProblema()
    {
        return $this->belongsTo(ReporteProblema::class, 'id_reporte_problema');
    }

    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'id_tratamiento');
    }
}