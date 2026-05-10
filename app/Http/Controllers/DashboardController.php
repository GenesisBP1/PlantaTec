<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Planta;
use App\Models\Adopcion;
use App\Models\Notificacion;
use App\Models\RegistroCuidado;
use App\Models\RecomendacionCuidado;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->rol === 'admin') {
            $totalPlantas = Planta::count();
            $totalUsuarios = User::where('rol', 'usuario')->count();
            $totalAdopciones = Adopcion::count();
            $recomendacionesPendientes = RecomendacionCuidado::where('estado', 'pendiente')->count();

            return view('dashboard.admin', compact(
                'totalPlantas',
                'totalUsuarios',
                'totalAdopciones',
                'recomendacionesPendientes'
            ));
        }

       // En el método index(), dentro del else (usuario normal)

$misPlantas = Adopcion::where('id_usuario', auth()->id())
    ->where('estado_adopcion', 'activa')
    ->count();

$misNotificaciones = Notificacion::where('id_usuario', auth()->id())
    ->where('leida', false)
    ->count();

$misCuidados = RegistroCuidado::whereHas('adopcion', function ($q) {
    $q->where('id_usuario', auth()->id());
})->count();

$misRecomendaciones = RecomendacionCuidado::whereHas('adopcion', function ($q) {
    $q->where('id_usuario', auth()->id());
})->where('estado', 'pendiente')->count();

// Últimas 3 plantas adoptadas (para mostrar en el dashboard)
$ultimasPlantas = Adopcion::where('id_usuario', auth()->id())
    ->with('planta')
    ->latest()
    ->take(3)
    ->get();

// Actividad reciente (últimos cuidados)
$actividadReciente = RegistroCuidado::whereHas('adopcion', function ($q) {
    $q->where('id_usuario', auth()->id());
})->with('adopcion.planta')->latest()->take(5)->get();

return view('dashboard.usuario', compact(
    'misPlantas',
    'misNotificaciones',
    'misCuidados',
    'misRecomendaciones',
    'ultimasPlantas',
    'actividadReciente'
));
    }
}