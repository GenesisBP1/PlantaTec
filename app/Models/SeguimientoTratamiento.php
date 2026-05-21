<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguimientoTratamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_reporte_problema',
        'id_tratamiento',
        'fecha_aplicacion',
        'imagen',
        'observaciones',
        'estado',
    ];

    protected $casts = [
        'fecha_aplicacion' => 'datetime',
        'estado' => 'string',
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