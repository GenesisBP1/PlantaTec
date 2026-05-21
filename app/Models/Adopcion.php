<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroCuidado;
use Carbon\Carbon;

class Adopcion extends Model
{
    protected $table = 'adopciones';

    protected $fillable = [
        'id_usuario',
        'id_planta',
        'id_ubicacion',
        'fecha_adopcion',
        'estado_adopcion',
    ];

    protected $casts = [
        'fecha_adopcion' => 'datetime',
    ];
    

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function planta()
    {
        return $this->belongsTo(Planta::class, 'id_planta');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    public function registrosCuidados()
    {
        return $this->hasMany(RegistroCuidado::class, 'id_adopcion');
    }

    public function recomendacionesCuidado()
    {
        return $this->hasMany(RecomendacionCuidado::class, 'id_adopcion');
    }

    public function reportesProblemas()
    {
        return $this->hasMany(ReporteProblema::class, 'id_adopcion');
    }

    
public function cuidadosPendientes()
{
    $pendientes = [];
    $hoy = Carbon::today();

    foreach ($this->planta->plantaCuidados as $pc) {
        $ultimoRegistro = RegistroCuidado::where('id_adopcion', $this->id)
            ->where('id_planta_cuidado', $pc->id)
            ->latest('fecha')
            ->first();

        if ($ultimoRegistro) {
            $proximaFecha = Carbon::parse($ultimoRegistro->fecha)->addDays($pc->frecuencia);
        } else {
            $proximaFecha = Carbon::parse($this->fecha_adopcion)->addDays($pc->frecuencia);
        }

        $diferencia = $hoy->diffInDays($proximaFecha, false);

        if ($diferencia <= 0) {
            // Atrasado o hoy
            $estado = $diferencia == 0 ? 'hoy' : 'atrasado';
            $diasAtraso = abs($diferencia);
        } elseif ($diferencia == 1) {
            $estado = 'manana';
            $diasAtraso = 0;
        } else {
            continue; // no pendiente aún
        }

        $pendientes[] = [
            'cuidado' => $pc->cuidado->nombre,
            'frecuencia' => $pc->frecuencia,
            'proxima_fecha' => $proximaFecha->format('Y-m-d'),
            'estado' => $estado,
            'dias_atraso' => $diasAtraso ?? 0,
            'planta_nombre' => $this->planta->nombre,
            'adopcion_id' => $this->id,
            'planta_cuidado_id' => $pc->id,
        ];
    }
    return $pendientes;
}
}