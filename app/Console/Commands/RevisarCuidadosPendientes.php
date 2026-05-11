<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Adopcion;
use App\Models\RegistroCuidado;
use App\Models\RecomendacionCuidado;
use App\Models\Notificacion;
use Carbon\Carbon;

class RevisarCuidadosPendientes extends Command
{
    protected $signature = 'cuidados:revisar';

    protected $description = 'Revisa cuidados pendientes y genera recomendaciones automáticas';

    public function handle()
    {
        $adopciones = Adopcion::with('planta.plantaCuidados.cuidado')
            ->where('estado_adopcion', 'activa')
            ->get();

        foreach ($adopciones as $adopcion) {
            foreach ($adopcion->planta->plantaCuidados as $plantaCuidado) {

                $ultimoRegistro = RegistroCuidado::where('id_adopcion', $adopcion->id)
                    ->where('id_planta_cuidado', $plantaCuidado->id)
                    ->latest('fecha')
                    ->first();

                if ($ultimoRegistro) {
    $diasSinCuidado = (int) Carbon::parse($ultimoRegistro->fecha)->diffInDays(now());
} else {
    $diasSinCuidado = (int) Carbon::parse($adopcion->fecha_adopcion)->diffInDays(now());
}

                if ($diasSinCuidado >= $plantaCuidado->frecuencia) {

                    $existe = RecomendacionCuidado::where('id_adopcion', $adopcion->id)
                        ->where('id_planta_cuidado', $plantaCuidado->id)
                        ->where('estado', 'pendiente')
                        ->exists();

                    if (!$existe) {
                        $prioridad = 'media';

                        if ($diasSinCuidado >= ($plantaCuidado->frecuencia + 4)) {
                            $prioridad = 'urgente';
                        } elseif ($diasSinCuidado >= ($plantaCuidado->frecuencia + 2)) {
                            $prioridad = 'alta';
                        }

                        $recomendacion = RecomendacionCuidado::create([
                            'id_adopcion' => $adopcion->id,
                            'id_planta_cuidado' => $plantaCuidado->id,
'mensaje' => 'No se ha registrado el cuidado "' . $plantaCuidado->cuidado->nombre . '" desde hace ' . $diasSinCuidado . ' días.',
                            'prioridad' => $prioridad,
                            'estado' => 'pendiente',
                            'fecha_generada' => now(),
                        ]);

                        Notificacion::create([
                            'id_usuario' => $adopcion->id_uphp artisan cuidados:revisarsuario,
                            'id_recomendacion_cuidado' => $recomendacion->id,
                            'titulo' => 'Cuidado pendiente: ' . $adopcion->planta->nombre,
'mensaje' => 'Tu planta ' . $adopcion->planta->nombre . ' necesita atención. ' . $recomendacion->mensaje,
                            'tipo' => 'cuidado_pendiente',
                            'leida' => false,
                            'fecha_envio' => now(),
                        ]);
                    }
                }
            }
        }

        $this->info('Revisión de cuidados completada.');
    }
}