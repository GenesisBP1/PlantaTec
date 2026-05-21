<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [
        'id_problema',
        'id_planta',
        'id_cuidado',
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

    public function cuidado()
    {
        return $this->belongsTo(Cuidado::class, 'id_cuidado');
    }

    public function seguimientos()
{
    return $this->hasMany(SeguimientoTratamiento::class, 'id_tratamiento');
}
}