<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecomendacionCuidado extends Model
{
    protected $table = 'recomendaciones_cuidado';
    protected $fillable = [
        'id_adopcion',
        'id_planta_cuidado',
        'mensaje',
        'prioridad',
        'estado',
        'fecha_generada',
    ];

    public function adopcion()
    {
        return $this->belongsTo(Adopcion::class, 'id_adopcion');
    }

    public function plantaCuidado()
    {
        return $this->belongsTo(PlantaCuidado::class, 'id_planta_cuidado');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'id_recomendacion_cuidado');
    }
}