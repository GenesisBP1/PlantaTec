<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}