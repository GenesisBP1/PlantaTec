<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Adopcion;
use App\Models\RegistroCuidado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        // Generar notificaciones actualizadas antes de listarlas
        $this->generarNotificacionesCuidados();

        $notificaciones = Notificacion::where('id_usuario', auth()->id())
            ->latest('fecha_envio')
            ->get();

        return view('notificaciones.index', compact('notificaciones'));
    }

    public function update(Request $request, Notificacion $notificacione)
    {
        $notificacione->update(['leida' => true]);
        return redirect()->route('notificaciones.index')
            ->with('success', 'Notificación marcada como leída.');
    }

    /**
     * Genera notificaciones de cuidados pendientes (hoy, mañana, atrasos)
     */
    private function generarNotificacionesCuidados()
{
    $hoy = Carbon::today(); // solo fecha, sin horas
    $usuarioId = auth()->id();

    $adopciones = Adopcion::where('id_usuario', $usuarioId)
        ->where('estado_adopcion', 'activa')
        ->with(['planta.plantaCuidados.cuidado'])
        ->get();

    foreach ($adopciones as $adopcion) {
        foreach ($adopcion->planta->plantaCuidados as $plantaCuidado) {
            // Obtener último registro
            $ultimoRegistro = RegistroCuidado::where('id_adopcion', $adopcion->id)
                ->where('id_planta_cuidado', $plantaCuidado->id)
                ->latest('fecha')
                ->first();

            // Calcular próxima fecha (sin horas)
            if ($ultimoRegistro) {
                $proximaFecha = Carbon::parse($ultimoRegistro->fecha)->startOfDay()->addDays($plantaCuidado->frecuencia);
            } else {
                $proximaFecha = Carbon::parse($adopcion->fecha_adopcion)->startOfDay()->addDays($plantaCuidado->frecuencia);
            }

            // Diferencia en días enteros (negativa si atrasado)
            $diferencia = $hoy->diffInDays($proximaFecha, false); // ya devuelve entero

            $titulo = null;
            $mensaje = null;
            $tipo = null;

            if ($diferencia == 0) {
                $titulo = "Cuidado programado para hoy";
                $mensaje = "Hoy debes realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}.";
                $tipo = 'hoy';
            } elseif ($diferencia == -1) {
                $titulo = "Cuidado atrasado 1 día";
                $mensaje = "Ayer debiste realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}. Por favor, regístralo.";
                $tipo = 'atraso';
            } elseif ($diferencia < -1) {
                $diasAtraso = abs($diferencia);
                $titulo = "Cuidado atrasado {$diasAtraso} días";
                $mensaje = "Estás {$diasAtraso} días atrasado con el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}. Registra el cuidado lo antes posible.";
                $tipo = 'atraso';
            } elseif ($diferencia == 1) {
                $titulo = "Cuidado programado para mañana";
                $mensaje = "Mañana debes realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}.";
                $tipo = 'proximo';
            }

            if ($titulo) {
                // Evitar duplicados en el mismo día
                $existe = Notificacion::where('id_usuario', $usuarioId)
                    ->where('titulo', $titulo)
                    ->whereDate('fecha_envio', $hoy)
                    ->exists();

                if (!$existe) {
                    Notificacion::create([
                        'id_usuario' => $usuarioId,
                        'titulo' => $titulo,
                        'mensaje' => $mensaje,
                        'tipo' => $tipo,
                        'leida' => false,
                        'fecha_envio' => now(),
                    ]);
                }
            }
        }
    }
}
}