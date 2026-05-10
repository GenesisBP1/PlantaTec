<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecomendacionZona extends Model
{
    protected $fillable = [
        'nombre_lugar',
        'tipo_zona',
        'indicaciones',
        'latitud',
        'longitud',
        'descripcion',
    ];
}