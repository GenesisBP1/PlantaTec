<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function index()
    {
        $ubicaciones = Ubicacion::latest()->get();
        
        // Preparar datos para la tabla
        $tableUbicacionesRows = $ubicaciones->map(function($ubicacion) {
            $tipoClass = $ubicacion->tipo === 'publico' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300';
            $tipoText = $ubicacion->tipo === 'publico' ? 'Pública' : 'Privada';
            return [
                '<div class="flex items-center gap-2"><svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span class="font-medium">' . $ubicacion->nombre_lugar . '</span></div>',
                '<span class="inline-block px-3 py-1 rounded-full text-xs font-semibold ' . $tipoClass . '">' . $tipoText . '</span>',
                $ubicacion->usuario?->name ?? 'Sistema',
                '<span class="text-xs font-mono text-gray-600 dark:text-gray-400">' . number_format($ubicacion->latitud, 4) . ', ' . number_format($ubicacion->longitud, 4) . '</span>',
            ];
        })->toArray();
        
        $tableUbicacionesActions = $ubicaciones->map(function($ubicacion) {
            return [
                'view' => route('ubicaciones.show', $ubicacion->id),
                'edit' => route('ubicaciones.edit', $ubicacion->id),
                'delete' => route('ubicaciones.destroy', $ubicacion->id),
            ];
        })->toArray();
        
        return view('ubicaciones.index', compact('ubicaciones', 'tableUbicacionesRows', 'tableUbicacionesActions'));
    }

    public function create()
    {
        return view('ubicaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'nombre_lugar' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'id_recomendacion_zona' => 'nullable|exists:recomendaciones_zona,id',
        ]);

        $data = $request->all();

        // Si se selecciona una zona recomendada, llenar los datos
        if ($request->id_recomendacion_zona) {
            $zona = \App\Models\RecomendacionZona::find($request->id_recomendacion_zona);
            if ($zona) {
                $data['nombre_lugar'] = $zona->nombre_lugar;
                $data['descripcion'] = $zona->descripcion;
                $data['latitud'] = $zona->latitud;
                $data['longitud'] = $zona->longitud;
            }
        }

        Ubicacion::create($data);

        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación registrada correctamente.');
    }

    public function show(Ubicacion $ubicacione)
    {
        $ubicacion = $ubicacione;
        return view('ubicaciones.show', compact('ubicacion'));
    }

    public function edit(Ubicacion $ubicacione)
    {
        $ubicacion = $ubicacione;
        return view('ubicaciones.edit', compact('ubicacion'));
    }

    public function update(Request $request, Ubicacion $ubicacione)
    {
        $ubicacion = $ubicacione;

        $request->validate([
            'tipo' => 'required|string',
            'nombre_lugar' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'id_recomendacion_zona' => 'nullable|exists:recomendaciones_zona,id',
        ]);

        $data = $request->all();

        // Si se selecciona una zona recomendada, llenar los datos
        if ($request->id_recomendacion_zona) {
            $zona = \App\Models\RecomendacionZona::find($request->id_recomendacion_zona);
            if ($zona) {
                $data['nombre_lugar'] = $zona->nombre_lugar;
                $data['descripcion'] = $zona->descripcion;
                $data['latitud'] = $zona->latitud;
                $data['longitud'] = $zona->longitud;
            }
        }

        $ubicacion->update($data);

        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación actualizada correctamente.');
    }

    public function destroy(Ubicacion $ubicacione)
    {
        $ubicacione->delete();

        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación eliminada correctamente.');
    }
}