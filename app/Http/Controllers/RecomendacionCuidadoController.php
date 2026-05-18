<?php

namespace App\Http\Controllers;

use App\Models\RecomendacionCuidado;
use Illuminate\Http\Request;

class RecomendacionCuidadoController extends Controller
{
    
    public function index()
    {
        $recomendaciones = RecomendacionCuidado::with(['adopcion.planta', 'plantaCuidado.cuidado'])
            ->latest()
            ->get();
        
        // Preparar datos para la tabla
        $tableRecomendacionesRows = $recomendaciones->map(function($recomendacion) {
            $prioridadClass = match($recomendacion->prioridad) {
                'alta' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                'media' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300',
                'baja' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                default => 'bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-300'
            };
            $estadoClass = $recomendacion->estado === 'completado' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300';
            return [
                $recomendacion->adopcion->planta->nombre ?? 'Sin planta',
                $recomendacion->plantaCuidado->cuidado->nombre ?? 'Sin cuidado',
                substr($recomendacion->mensaje, 0, 50) . (strlen($recomendacion->mensaje) > 50 ? '...' : ''),
                '<span class="inline-block px-3 py-1 rounded-full text-xs font-semibold ' . $prioridadClass . '">' . ucfirst($recomendacion->prioridad) . '</span>',
                '<span class="inline-block px-3 py-1 rounded-full text-xs font-semibold ' . $estadoClass . '">' . ucfirst($recomendacion->estado) . '</span>',
            ];
        })->toArray();
        
        $tableRecomendacionesActions = $recomendaciones->map(function($recomendacion) {
            return [
                'delete' => route('recomendaciones-cuidado.destroy', $recomendacion->id),
            ];
        })->toArray();

        return view('recomendaciones_cuidado.index', compact('recomendaciones', 'tableRecomendacionesRows', 'tableRecomendacionesActions'));
    }

    public function destroy(RecomendacionCuidado $recomendacionCuidado)
    {
        $recomendacionCuidado->delete();

        return redirect()->route('recomendaciones-cuidado.index')
            ->with('success', 'Recomendación eliminada correctamente.');
    }
}