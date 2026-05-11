<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
{
    $notificacionesPendientes = Notificacion::with('recomendacionCuidado.adopcion.planta')
        ->where('id_usuario', auth()->id())
        ->where('leida', false)
        ->latest()
        ->get();

    $notificacionesLeidas = Notificacion::with('recomendacionCuidado.adopcion.planta')
        ->where('id_usuario', auth()->id())
        ->where('leida', true)
        ->latest()
        ->get();

    return view('notificaciones.index', compact(
        'notificacionesPendientes',
        'notificacionesLeidas'
    ));
}

    public function update(Request $request, Notificacion $notificacione)
    {
        $notificacion = $notificacione;

        $notificacion->update([
            'leida' => true
        ]);

        return redirect()->route('notificaciones.index')
            ->with('success', 'Notificación marcada como leída.');
    }
}