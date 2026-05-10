<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecomendacionZona extends Model
{
    use HasFactory;

    protected $table = 'recomendaciones_zona';

    protected $fillable = [
        'nombre_lugar',
        'tipo_zona',
        'indicaciones',
        'latitud',
        'longitud',
        'descripcion',
    ];
}