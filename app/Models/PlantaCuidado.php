<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantaCuidado extends Model
{
    protected $fillable = [
        'id_planta',
        'id_cuidado',
        'frecuencia',
        'instrucciones_esp',
        'evidencia',
    ];

    public function planta()
    {
        return $this->belongsTo(Planta::class, 'id_planta');
    }

    public function cuidado()
    {
        return $this->belongsTo(Cuidado::class, 'id_cuidado');
    }

    public function registrosCuidados()
    {
        return $this->hasMany(RegistroCuidado::class, 'id_planta_cuidado');
    }

    public function recomendacionesCuidado()
    {
        return $this->hasMany(RecomendacionCuidado::class, 'id_planta_cuidado');
    }
}