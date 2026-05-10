<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::where('id_usuario', auth()->id())
            ->latest()
            ->get();

        return view('notificaciones.index', compact('notificaciones'));
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