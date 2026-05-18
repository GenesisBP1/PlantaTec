<?php

namespace App\Http\Controllers;

use App\Models\RecomendacionZona;
use Illuminate\Http\Request;

class RecomendacionZonaController extends Controller
{
    public function index()
    {
        $zonas = RecomendacionZona::latest()->get();
        
        // Preparar datos para la tabla
        $tableZonasRows = $zonas->map(function($zona) {
            return [
                '<div class="flex items-center gap-2"><svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span class="font-medium">' . $zona->nombre_lugar . '</span></div>',
                '<span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">' . ($zona->tipo_zona ?? 'Sin tipo') . '</span>',
                substr($zona->descripcion ?? '', 0, 50) . (strlen($zona->descripcion ?? '') > 50 ? '...' : ''),
                '<span class="text-xs font-mono text-gray-600 dark:text-gray-400">' . number_format($zona->latitud, 4) . ', ' . number_format($zona->longitud, 4) . '</span>',
            ];
        })->toArray();
        
        $tableZonasActions = $zonas->map(function($zona) {
            return [
                'edit' => route('recomendaciones-zona.edit', $zona->id),
                'delete' => route('recomendaciones-zona.destroy', $zona->id),
            ];
        })->toArray();
        
        return view('recomendaciones-zona.index', compact('zonas', 'tableZonasRows', 'tableZonasActions'));
    }

    public function create()
    {
        return view('recomendaciones-zona.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_lugar' => 'required|string|max:255',
            'tipo_zona'    => 'nullable|string|max:255',
            'indicaciones' => 'nullable|string',
            'latitud'      => 'nullable|numeric',
            'longitud'     => 'nullable|numeric',
            'descripcion'  => 'nullable|string',
        ]);

        RecomendacionZona::create($request->all());
        return redirect()->route('recomendaciones-zona.index')
            ->with('success', 'Zona agregada correctamente.');
    }

    public function edit(RecomendacionZona $recomendaciones_zona)
    {
        $zona = $recomendaciones_zona;
        return view('recomendaciones-zona.edit', compact('zona'));
    }

    public function update(Request $request, RecomendacionZona $recomendaciones_zona)
    {
        $request->validate([
            'nombre_lugar' => 'required|string|max:255',
            'tipo_zona'    => 'nullable|string|max:255',
            'indicaciones' => 'nullable|string',
            'latitud'      => 'nullable|numeric',
            'longitud'     => 'nullable|numeric',
            'descripcion'  => 'nullable|string',
        ]);

        $recomendaciones_zona->update($request->all());
        return redirect()->route('recomendaciones-zona.index')
            ->with('success', 'Zona actualizada.');
    }

    public function destroy(RecomendacionZona $recomendaciones_zona)
    {
        $recomendaciones_zona->delete();
        return redirect()->route('recomendaciones-zona.index')
            ->with('success', 'Zona eliminada.');
    }
}