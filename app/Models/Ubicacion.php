<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';

    protected $fillable = [
        'tipo',
        'nombre_lugar',
        'descripcion',
        'latitud',
        'longitud',
    ];

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class, 'id_ubicacion');
    }
}