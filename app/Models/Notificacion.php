<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = [
        'id_usuario',
        'id_recomendacion_cuidado',
        'titulo',
        'mensaje',
        'tipo',
        'leida',
        'fecha_envio'
    ];

    protected $casts = [
        'leida' => 'boolean',
        'fecha_envio' => 'datetime', // 👈 esto convierte el string a Carbon
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}