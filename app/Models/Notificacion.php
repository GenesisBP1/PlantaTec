<?php

namespace App\Models;

use App\Models\RecomendacionCuidado;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';
    protected $fillable = [
        'id_usuario',
        'id_recomendacion_cuidado',
        'titulo',
        'mensaje',
        'tipo',
        'leida',
        'fecha_envio',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function recomendacionCuidado()
    {
        return $this->belongsTo(RecomendacionCuidado::class, 'id_recomendacion_cuidado');
    }
}