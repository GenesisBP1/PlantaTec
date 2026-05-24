<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Planta;
use App\Models\Adopcion;
use App\Models\Notificacion;
use App\Models\RegistroCuidado;
use App\Models\RecomendacionCuidado;
use App\Models\ReporteProblema;
use App\Models\Ubicacion;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->rol === 'admin') {
            $totalPlantas = Planta::count();
            $totalUsuarios = User::where('rol', 'usuario')->count();
            $totalAdopciones = Adopcion::count();
            $problemasActivos = ReporteProblema::whereIn('estado', ['activo', 'en_revision'])->count();
            $plantaMasAdoptada = Planta::withCount('adopciones')
                ->orderByDesc('adopciones_count')
                ->first();

            $usuarios = User::where('rol', 'usuario')->get();

            return view('dashboard.admin', compact(
                'totalPlantas',
                'totalUsuarios',
                'totalAdopciones',
                'problemasActivos',
                'plantaMasAdoptada',
                'usuarios'
            ));
        }

        // Usuario normal
        $misAdopciones = Adopcion::with([
                'planta.plantaCuidados.cuidado',
                'registrosCuidados',
                'reportesProblemas'
            ])
            ->where('id_usuario', auth()->id())
            ->where('estado_adopcion', 'activa')
            ->get();

        $misPlantas = $misAdopciones->count();

        // Generar notificaciones de cuidados pendientes
        $this->generarNotificacionesCuidados($misAdopciones);
        // Generar notificaciones de tratamientos pendientes (atrasos)
        $this->generarNotificacionesTratamientos($misAdopciones);

        $misNotificaciones = Notificacion::where('id_usuario', auth()->id())
            ->where('leida', false)
            ->count();

        $misCuidados = RegistroCuidado::whereHas('adopcion', function ($q) {
            $q->where('id_usuario', auth()->id());
        })->count();

        $misRecomendaciones = RecomendacionCuidado::whereHas('adopcion', function ($q) {
            $q->where('id_usuario', auth()->id());
        })->where('estado', 'pendiente')->count();

        $problemasActivos = ReporteProblema::whereHas('adopcion', function ($q) {
            $q->where('id_usuario', auth()->id());
        })
            ->whereIn('estado', ['activo', 'en_revision'])
            ->count();

        $ultimasPlantas = Adopcion::where('id_usuario', auth()->id())
            ->with('planta')
            ->latest()
            ->take(3)
            ->get();

        $actividadReciente = RegistroCuidado::whereHas('adopcion', function ($q) {
            $q->where('id_usuario', auth()->id());
        })
            ->with('adopcion.planta')
            ->latest()
            ->take(5)
            ->get();

        $proximosCuidados = [];
        $cuidadosPendientesHoy = 0;

        foreach ($misAdopciones as $adopcion) {
            foreach ($adopcion->planta->plantaCuidados as $plantaCuidado) {
                $ultimoRegistro = RegistroCuidado::where('id_adopcion', $adopcion->id)
                    ->where('id_planta_cuidado', $plantaCuidado->id)
                    ->latest('fecha')
                    ->first();

                $fechaBase = $ultimoRegistro
                    ? Carbon::parse($ultimoRegistro->fecha)
                    : Carbon::parse($adopcion->fecha_adopcion);

                $proximaFecha = $fechaBase->copy()->addDays($plantaCuidado->frecuencia);

                if ($proximaFecha->isToday()) {
                    $cuidadosPendientesHoy++;
                }

                $proximosCuidados[] = [
                    'planta' => $adopcion->planta->nombre,
                    'cuidado' => $plantaCuidado->cuidado->nombre,
                    'fecha' => $proximaFecha,
                ];
            }
        }

        $proximosCuidados = collect($proximosCuidados)->sortBy('fecha')->take(5);

        // Ubicaciones públicas y propias para mostrar en el mapa del usuario
        $ubicacionesMapa = Adopcion::with(['planta', 'ubicacion'])
            ->whereHas('ubicacion', function ($q) {
                $q->whereNotNull('latitud')
                  ->whereNotNull('longitud');
            })
            ->where(function ($q) {
                $q->whereHas('ubicacion', function ($ubicacion) {
                    $ubicacion->where('tipo', 'publico');
                })
                ->orWhere('id_usuario', auth()->id());
            })
            ->get();

        return view('dashboard.usuario', compact(
            'misPlantas',
            'misNotificaciones',
            'misCuidados',
            'misRecomendaciones',
            'problemasActivos',
            'cuidadosPendientesHoy',
            'ultimasPlantas',
            'actividadReciente',
            'proximosCuidados',
            'ubicacionesMapa'
        ));
    }

    /**
     * Genera notificaciones de cuidados pendientes (hoy, atrasados, mañana)
     */
    private function generarNotificacionesCuidados($adopciones)
    {
        $hoy = Carbon::today();
        $usuarioId = auth()->id();

        foreach ($adopciones as $adopcion) {
            foreach ($adopcion->planta->plantaCuidados as $plantaCuidado) {
                $ultimoRegistro = RegistroCuidado::where('id_adopcion', $adopcion->id)
                    ->where('id_planta_cuidado', $plantaCuidado->id)
                    ->latest('fecha')
                    ->first();

                if ($ultimoRegistro) {
                    $proximaFecha = Carbon::parse($ultimoRegistro->fecha)->startOfDay()->addDays($plantaCuidado->frecuencia);
                } else {
                    $proximaFecha = Carbon::parse($adopcion->fecha_adopcion)->startOfDay()->addDays($plantaCuidado->frecuencia);
                }

                $diferencia = $hoy->diffInDays($proximaFecha, false);

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
                    $mensaje = "Mañana debes realizar el cuidado: {$plantaCuidado->cuidado->nombre} para tu planta {$adopcion->planta->nombre}.";
                    $tipo = 'proximo';
                }

                if ($titulo) {
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

    /**
     * Genera notificaciones de tratamientos atrasados (rojo urgente)
     */
    private function generarNotificacionesTratamientos($adopciones)
    {
        $hoy = Carbon::today();
        $usuarioId = auth()->id();

        foreach ($adopciones as $adopcion) {
            // Reportes de problemas activos o en revisión de esta adopción
            $reportes = $adopcion->reportesProblemas()
                ->whereIn('estado', ['activo', 'en_revision'])
                ->get();

            foreach ($reportes as $reporte) {
                $tratamiento = $reporte->tratamientoSugerido();
                if (!$tratamiento) continue;

                // Última aplicación registrada
                $ultimaAplicacion = $reporte->seguimientoTratamientos()
                    ->latest('fecha_aplicacion')
                    ->first();

                if ($ultimaAplicacion) {
                    $proximaFecha = Carbon::parse($ultimaAplicacion->fecha_aplicacion)
                        ->startOfDay()
                        ->addDays($tratamiento->frecuencia_dias);
                } else {
                    $proximaFecha = Carbon::parse($reporte->created_at)
                        ->startOfDay()
                        ->addDays($tratamiento->frecuencia_dias);
                }

                $diferencia = $hoy->diffInDays($proximaFecha, false);

                // Solo atrasos (diferencia < 0)
                if ($diferencia < 0) {
                    $diasAtraso = abs($diferencia);
                    $titulo = $diasAtraso == 1 ? "Tratamiento atrasado 1 día" : "Tratamiento atrasado {$diasAtraso} días";
                    $mensaje = "El tratamiento '{$tratamiento->descripcion}' para el problema '{$reporte->problema->nombre}' en tu planta {$adopcion->planta->nombre} está atrasado. Aplica el tratamiento lo antes posible.";
                    $tipo = 'tratamiento_atraso'; // clave para el estilo rojo

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
                // Opcional: notificación para mañana (diferencia == 1) - puedes agregarla si quieres
            }
        }
    }
}