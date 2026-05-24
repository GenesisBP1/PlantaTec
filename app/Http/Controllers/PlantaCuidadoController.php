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
        ->paginate(10);  // ✅ paginación, 10 registros por página

    return view('planta_cuidados.index', compact('asignaciones'));
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