<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [
        'id_problema',
        'id_planta',
        'descripcion',
        'indicaciones',
    ];

    public function problema()
    {
        return $this->belongsTo(Problema::class, 'id_problema');
    }

    public function planta()
    {
        return $this->belongsTo(Planta::class, 'id_planta');
    }
}