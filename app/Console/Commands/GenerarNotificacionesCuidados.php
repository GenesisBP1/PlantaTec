<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Adopcion;
use App\Models\RegistroCuidado;
use App\Models\Notificacion;
use Carbon\Carbon;

class GenerarNotificacionesCuidados extends Command
{
    protected $signature = 'cuidados:notificar';
    protected $description = 'Genera notificaciones de cuidados pendientes para los usuarios';

    public function handle()
    {
        $hoy = Carbon::today();
        $notificacionesCreadas = 0;

        // Obtener todas las adopciones activas
        $adopciones = Adopcion::where('estado_adopcion', 'activa')
            ->with(['usuario', 'planta.plantaCuidados.cuidado'])
            ->get();

        foreach ($adopciones as $adopcion) {
            $usuarioId = $adopcion->id_usuario;
            $fechaAdopcion = Carbon::parse($adopcion->fecha_adopcion);

            foreach ($adopcion->planta->plantaCuidados as $plantaCuidado) {
                // Obtener el último registro de este cuidado para esta adopción
                $ultimoRegistro = RegistroCuidado::where('id_adopcion', $adopcion->id)
                    ->where('id_planta_cuidado', $plantaCuidado->id)
                    ->latest('fecha')
                    ->first();

                // Calcular próxima fecha de cuidado
                if ($ultimoRegistro) {
                    $ultimaFecha = Carbon::parse($ultimoRegistro->fecha);
                    $proximaFecha = $ultimaFecha->copy()->addDays($plantaCuidado->frecuencia);
                } else {
                    $proximaFecha = $fechaAdopcion->copy()->addDays($plantaCuidado->frecuencia);
                }

                // Determinar estado respecto a hoy
                $diferencia = $hoy->diffInDays($proximaFecha, false); // negativo si atrasado

                $titulo = null;
                $mensaje = null;
                $tipo = null;

                if ($diferencia == 0) {
                    // Hoy es el día
                    $titulo = "Cuidado programado para hoy";
                    $mensaje = "Hoy debes realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}.";
                    $tipo = 'hoy';
                } elseif ($diferencia == -1) {
                    // Ayer era el día (1 día de atraso)
                    $titulo = "Cuidado atrasado 1 día";
                    $mensaje = "Ayer debiste realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}. Por favor, regístralo cuanto antes.";
                    $tipo = 'atraso';
                } elseif ($diferencia < -1) {
                    // Más de un día de atraso
                    $diasAtraso = abs($diferencia);
                    $titulo = "Cuidado atrasado {$diasAtraso} días";
                    $mensaje = "Estás {$diasAtraso} días atrasado con el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}. Registra el cuidado lo antes posible.";
                    $tipo = 'atraso';
                } elseif ($diferencia == 1) {
                    // Mañana es el día
                    $titulo = "Cuidado programado para mañana";
                    $mensaje = "Mañana debes realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}. Prepárate.";
                    $tipo = 'proximo';
                } elseif ($diferencia > 1) {
                    // Futuro lejano, no notificamos aún
                    continue;
                }

                if ($titulo) {
                    // Evitar duplicados: verificar si ya existe una notificación similar para este usuario y este cuidado, dentro del mismo día
                    $yaNotificada = Notificacion::where('id_usuario', $usuarioId)
                        ->where('titulo', $titulo)
                        ->where('tipo', $tipo)
                        ->whereDate('fecha_envio', $hoy)
                        ->exists();

                    if (!$yaNotificada) {
                        Notificacion::create([
                            'id_usuario' => $usuarioId,
                            'titulo' => $titulo,
                            'mensaje' => $mensaje,
                            'tipo' => $tipo,
                            'leida' => false,
                            'fecha_envio' => now(),
                        ]);
                        $notificacionesCreadas++;
                    }
                }
            }
        }

        $this->info("Se generaron {$notificacionesCreadas} notificaciones nuevas.");
    }
}