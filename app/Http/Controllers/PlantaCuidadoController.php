<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use App\Models\Cuidado;
use App\Models\PlantaCuidado;
use Illuminate\Http\Request;

class PlantaCuidadoController extends Controller
{
    public function index()
    {
        $asignaciones = PlantaCuidado::with(['planta', 'cuidado'])
            ->latest()
            ->get();

        $tableAsignacionesRows = $asignaciones->map(function ($asignacion) {
            return [
                '<div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 5a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"/>
                        <path d="M12.574 9.618a2 2 0 00-3.192-2.247A1 1 0 0010 9h.5a1 1 0 00.574-.382z"/>
                    </svg>
                    <span class="font-medium">' . e($asignacion->planta->nombre ?? 'Sin planta') . '</span>
                </div>',

                e($asignacion->cuidado->nombre ?? 'Sin cuidado'),

                'Cada ' . e($asignacion->frecuencia ?? 'N/A') . ' días',

                e(substr($asignacion->instrucciones_esp ?? 'Sin instrucciones', 0, 50)) .
                (strlen($asignacion->instrucciones_esp ?? '') > 50 ? '...' : ''),
            ];
        })->toArray();

        $tableAsignacionesActions = $asignaciones->map(function ($asignacion) {
            return [
                'view' => route('planta-cuidados.show', $asignacion->id),
                'edit' => route('planta-cuidados.edit', $asignacion->id),
                'delete' => route('planta-cuidados.destroy', $asignacion->id),
            ];
        })->toArray();

        return view('planta_cuidados.index', compact(
            'asignaciones',
            'tableAsignacionesRows',
            'tableAsignacionesActions'
        ));
    }

    public function create()
    {
        $plantas = Planta::all();
        $cuidados = Cuidado::all();

        return view('planta_cuidados.create', compact('plantas', 'cuidados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_planta' => 'required|exists:plantas,id',
            'id_cuidado' => 'required|exists:cuidados,id',
            'frecuencia' => 'required|string|max:255',
            'instrucciones_esp' => 'nullable|string',
            'evidencia' => 'nullable|string',
        ]);

        PlantaCuidado::create([
            'id_planta' => $request->id_planta,
            'id_cuidado' => $request->id_cuidado,
            'frecuencia' => $request->frecuencia,
            'instrucciones_esp' => $request->instrucciones_esp,
            'evidencia' => $request->evidencia,
        ]);

        return redirect()->route('planta-cuidados.index')
            ->with('success', 'Cuidado asignado correctamente.');
    }

    public function show($id)
    {
        $asignacion = PlantaCuidado::with(['planta', 'cuidado'])
            ->findOrFail($id);

        return view('planta_cuidados.show', compact('asignacion'));
    }

    public function edit($id)
    {
        $asignacion = PlantaCuidado::findOrFail($id);
        $plantas = Planta::all();
        $cuidados = Cuidado::all();

        return view('planta_cuidados.edit', compact('asignacion', 'plantas', 'cuidados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_planta' => 'required|exists:plantas,id',
            'id_cuidado' => 'required|exists:cuidados,id',
            'frecuencia' => 'required|string|max:255',
            'instrucciones_esp' => 'nullable|string',
            'evidencia' => 'nullable|string',
        ]);

        $asignacion = PlantaCuidado::findOrFail($id);

        $asignacion->update([
            'id_planta' => $request->id_planta,
            'id_cuidado' => $request->id_cuidado,
            'frecuencia' => $request->frecuencia,
            'instrucciones_esp' => $request->instrucciones_esp,
            'evidencia' => $request->evidencia,
        ]);

        return redirect()->route('planta-cuidados.index')
            ->with('success', 'Asignación actualizada correctamente.');
    }

    public function destroy($id)
    {
        $asignacion = PlantaCuidado::findOrFail($id);
        $asignacion->delete();

        return redirect()->route('planta-cuidados.index')
            ->with('success', 'Asignación eliminada correctamente.');
    }
}