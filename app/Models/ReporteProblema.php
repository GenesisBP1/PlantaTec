<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TratamientoReporte;
use App\Models\SeguimientoTratamiento;
use App\Models\Tratamiento;

class ReporteProblema extends Model
{
    protected $table = 'reporte_problemas';

    protected $fillable = [
        'id_adopcion',
        'id_problema',
        'descripcion',
        'gravedad',
        'estado',
        'imagen',
    ];

    public function adopcion()
    {
        return $this->belongsTo(Adopcion::class, 'id_adopcion');
    }

    public function problema()
    {
        return $this->belongsTo(Problema::class, 'id_problema');
    }

    public function tratamientosReportes()
{
    return $this->hasMany(TratamientoReporte::class, 'id_reporte_problema');
}

public function seguimientoTratamientos()
{
    return $this->hasMany(SeguimientoTratamiento::class, 'id_reporte_problema');
}

/**
 * Obtiene el tratamiento sugerido para este problema,
 * priorizando el específico por planta, o el genérico si no existe.
 */
public function tratamientoSugerido()
{
    // Tratamiento específico para esta planta
    $tratamiento = Tratamiento::where('id_problema', $this->id_problema)
        ->where('id_planta', $this->adopcion->id_planta)
        ->first();

    if (!$tratamiento) {
        // Tratamiento genérico (para cualquier planta)
        $tratamiento = Tratamiento::where('id_problema', $this->id_problema)
            ->whereNull('id_planta')
            ->first();
    }
    return $tratamiento;
}
}