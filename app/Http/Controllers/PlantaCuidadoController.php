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
        $asignaciones = PlantaCuidado::with(['planta', 'cuidado'])->latest()->get();

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

        PlantaCuidado::create($request->all());

        return redirect()->route('planta-cuidados.index')
            ->with('success', 'Cuidado asignado correctamente.');
    }

    public function destroy(PlantaCuidado $plantaCuidado)
    {
        $plantaCuidado->delete();

        return redirect()->route('planta-cuidados.index')
            ->with('success', 'Asignación eliminada.');
    }
}