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
        // Trabajamos en UTC para coincidir con las fechas guardadas en la BD
        $hoyUTC = Carbon::now('UTC')->startOfDay();
        $notificacionesCreadas = 0;

        $adopciones = Adopcion::where('estado_adopcion', 'activa')
            ->with(['usuario', 'planta.plantaCuidados.cuidado'])
            ->get();

        foreach ($adopciones as $adopcion) {
            $usuarioId = $adopcion->id_usuario;
            // Parsear fecha de adopción en UTC
            $fechaAdopcionUTC = Carbon::parse($adopcion->fecha_adopcion)->startOfDay();

            foreach ($adopcion->planta->plantaCuidados as $plantaCuidado) {
                $ultimoRegistro = RegistroCuidado::where('id_adopcion', $adopcion->id)
                    ->where('id_planta_cuidado', $plantaCuidado->id)
                    ->latest('fecha')
                    ->first();

                if ($ultimoRegistro) {
                    // La fecha del registro ya está en UTC, la parseamos y sumamos frecuencia
                    $proximaFechaUTC = Carbon::parse($ultimoRegistro->fecha)
                        ->startOfDay()
                        ->addDays($plantaCuidado->frecuencia);
                } else {
                    $proximaFechaUTC = $fechaAdopcionUTC->copy()->addDays($plantaCuidado->frecuencia);
                }

                // Diferencia en días (negativo = atrasado)
                $diferencia = $hoyUTC->diffInDays($proximaFechaUTC, false);

                $titulo = null;
                $mensaje = null;
                $tipo = null;

                if ($diferencia == 0) {
                    $titulo = "Cuidado programado para hoy";
                    $mensaje = "Hoy debes realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}.";
                    $tipo = 'hoy';
                } elseif ($diferencia == -1) {
                    $titulo = "Cuidado atrasado 1 día";
                    $mensaje = "Ayer debiste realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}. Por favor, regístralo cuanto antes.";
                    $tipo = 'atraso';
                } elseif ($diferencia < -1) {
                    $diasAtraso = abs($diferencia);
                    $titulo = "Cuidado atrasado {$diasAtraso} días";
                    $mensaje = "Estás {$diasAtraso} días atrasado con el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}. Registra el cuidado lo antes posible.";
                    $tipo = 'atraso';
                } elseif ($diferencia == 1) {
                    $titulo = "Cuidado programado para mañana";
                    $mensaje = "Mañana debes realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}. Prepárate.";
                    $tipo = 'proximo';
                } else {
                    continue;
                }

                // Evitar duplicados para el mismo usuario, mismo cuidado, mismo día
                $yaNotificada = Notificacion::where('id_usuario', $usuarioId)
                    ->where('titulo', $titulo)
                    ->where('tipo', $tipo)
                    ->whereDate('fecha_envio', $hoyUTC) // comparamos fecha en UTC
                    ->exists();

                if (!$yaNotificada) {
                    Notificacion::create([
                        'id_usuario' => $usuarioId,
                        'titulo' => $titulo,
                        'mensaje' => $mensaje,
                        'tipo' => $tipo,
                        'leida' => false,
                        'fecha_envio' => Carbon::now('UTC'), // también UTC
                    ]);
                    $notificacionesCreadas++;
                }
            }
        }

        $this->info("Se generaron {$notificacionesCreadas} notificaciones nuevas.");
    }
}