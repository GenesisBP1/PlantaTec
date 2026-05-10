<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    protected $fillable = [
        'nombre',
        'especie',
        'tipo_zona',
        'imagen',
        'descripcion',
        'estado',
    ];

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class, 'id_planta');
    }
    
    public function plantaCuidados()
    {
        return $this->hasMany(PlantaCuidado::class, 'id_planta');
    }
    
    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class, 'id_planta');
    }
}
