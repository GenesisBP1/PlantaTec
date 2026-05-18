<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';

    protected $fillable = [
        'id_usuario',
        'tipo',
        'nombre_lugar',
        'descripcion',
        'latitud',
        'longitud',
        'es_publica',
    ];

    protected $casts = [
        'es_publica' => 'boolean',
        'latitud' => 'decimal:7',
        'longitud' => 'decimal:7',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class, 'id_ubicacion');
    }
}