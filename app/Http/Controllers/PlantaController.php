<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use Illuminate\Http\Request;

class PlantaController extends Controller
{
    public function index()
    {
        $plantas = Planta::latest()->get();
        
        // Preparar datos para la tabla
        $tablePlantasRows = $plantas->map(function($planta) {
            return [
                '<div class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center text-white font-bold text-sm">🌿</div><span class="font-medium">' . $planta->nombre . '</span></div>',
                $planta->especie,
                $planta->tipo_zona ?? 'Sin clasificar',
                '<span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">' . ($planta->estado ?? 'Activa') . '</span>',
            ];
        })->toArray();
        
        $tablePlantasActions = $plantas->map(function($planta) {
            return [
                'view' => route('plantas.show', $planta->id),
                'edit' => route('plantas.edit', $planta->id),
                'delete' => route('plantas.destroy', $planta->id),
            ];
        })->toArray();
        
        return view('plantas.index', compact('plantas', 'tablePlantasRows', 'tablePlantasActions'));
    }

    public function create()
    {
        return view('plantas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'tipo_zona' => 'nullable|string|max:255',
            'imagen' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
        ]);

        Planta::create($request->all());

        return redirect()->route('plantas.index')
            ->with('success', 'Planta registrada correctamente.');
    }

    public function show(Planta $planta)
    {
        return view('plantas.show', compact('planta'));
    }

    public function edit(Planta $planta)
    {
        return view('plantas.edit', compact('planta'));
    }

    public function update(Request $request, Planta $planta)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'tipo_zona' => 'nullable|string|max:255',
            'imagen' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
        ]);

        $planta->update($request->all());

        return redirect()->route('plantas.index')
            ->with('success', 'Planta actualizada correctamente.');
    }

    public function destroy(Planta $planta)
    {
        $planta->delete();

        return redirect()->route('plantas.index')
            ->with('success', 'Planta eliminada correctamente.');
    }

    public function destacadas()
{
    $destacadas = Planta::latest()->take(3)->get();
    return response()->json($destacadas);
}
}