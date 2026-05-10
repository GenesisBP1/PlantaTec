<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuidado extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function plantaCuidados()
    {
        return $this->hasMany(PlantaCuidado::class, 'id_cuidado');
    }
}