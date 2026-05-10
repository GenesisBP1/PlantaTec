<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteProblema extends Model
{
    protected $table = 'reporte_problemas';

    protected $fillable = [
        'id_adopcion',
        'id_problema',
        'descripcion',
        'gravedad',
        'estado',
        'imagen',
    ];

    public function adopcion()
    {
        return $this->belongsTo(Adopcion::class, 'id_adopcion');
    }

    public function problema()
    {
        return $this->belongsTo(Problema::class, 'id_problema');
    }
}