<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroCuidado extends Model
{
    protected $fillable = [
        'id_adopcion',
        'id_planta_cuidado',
        'fecha',
        'imagen',
        'descripcion',
        'estado_observado',
    ];

    public function adopcion()
    {
        return $this->belongsTo(Adopcion::class, 'id_adopcion');
    }

    public function plantaCuidado()
    {
        return $this->belongsTo(PlantaCuidado::class, 'id_planta_cuidado');
    }
}