<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Planta;
use App\Models\Adopcion;
use App\Models\Notificacion;
use App\Models\RegistroCuidado;
use App\Models\RecomendacionCuidado;
use App\Models\ReporteProblema;
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

            return view('dashboard.admin', compact(
                'totalPlantas',
                'totalUsuarios',
                'totalAdopciones',
                'problemasActivos',
                'plantaMasAdoptada'
            ));
        }

        $misAdopciones = Adopcion::with([
                'planta.plantaCuidados.cuidado',
                'registrosCuidados',
                'reportesProblemas'
            ])
            ->where('id_usuario', auth()->id())
            ->where('estado_adopcion', 'activa')
            ->get();

        $misPlantas = $misAdopciones->count();

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

                $proximosCuidados[] = [
                    'planta' => $adopcion->planta->nombre,
                    'cuidado' => $plantaCuidado->cuidado->nombre,
                    'fecha' => $proximaFecha,
                ];
            }
        }

        $proximosCuidados = collect($proximosCuidados)
            ->sortBy('fecha');

        $cuidadosPendientesHoy = $proximosCuidados
            ->filter(function ($cuidado) {
                return Carbon::parse($cuidado['fecha'])->isToday();
            })
            ->count();

        $proximosCuidados = $proximosCuidados->take(5);

        return view('dashboard.usuario', compact(
            'misPlantas',
            'misNotificaciones',
            'misCuidados',
            'misRecomendaciones',
            'problemasActivos',
            'cuidadosPendientesHoy',
            'ultimasPlantas',
            'actividadReciente',
            'proximosCuidados'
        ));
    }
}