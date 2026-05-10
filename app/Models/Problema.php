<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problema extends Model
{
    protected $fillable = [
        'nombre',
        'imagen',
        'descripcion',
    ];

    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class, 'id_problema');
    }
}