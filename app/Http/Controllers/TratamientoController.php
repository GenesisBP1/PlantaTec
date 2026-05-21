<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use App\Models\Problema;
use App\Models\Planta;
use Illuminate\Http\Request;
use App\Models\Cuidado;

class TratamientoController extends Controller
{
    public function index()
{
    $tratamientos = Tratamiento::with(['problema', 'planta', 'cuidado'])
        ->latest()
        ->get();

    $tableTratamientosRows = $tratamientos->map(function ($tratamiento) {
        return [
            $tratamiento->problema->nombre ?? 'Sin problema',
            $tratamiento->planta->nombre ?? 'General',
            $tratamiento->cuidado->nombre ?? 'Sin cuidado específico',
            e($tratamiento->descripcion ?? 'Sin descripción'),
            e($tratamiento->indicaciones ?? 'Sin indicaciones'),
        ];
    })->toArray();

    $tableTratamientosActions = $tratamientos->map(function ($tratamiento) {
        return [
            'view' => route('tratamientos.show', $tratamiento->id),
            'edit' => route('tratamientos.edit', $tratamiento->id),
            'delete' => route('tratamientos.destroy', $tratamiento->id),
        ];
    })->toArray();

    return view('tratamientos.index', compact('tratamientos', 'tableTratamientosRows', 'tableTratamientosActions'));
}

    public function create()
    {
        $problemas = Problema::all();
        $plantas = Planta::all();
        $cuidados = Cuidado::all();

        return view('tratamientos.create', compact('problemas', 'plantas', 'cuidados'));
    }

    public function store(Request $request)
    {
        $request->validate([
    'id_problema' => 'required|exists:problemas,id',
    'id_planta' => 'nullable|exists:plantas,id',
    'id_cuidado' => 'nullable|exists:cuidados,id',
    'descripcion' => 'nullable|string',
    'indicaciones' => 'nullable|string',
    'frecuencia_dias' => 'required|integer|min:1',
]);

        Tratamiento::create($request->all());

        return redirect()->route('tratamientos.index')
            ->with('success', 'Tratamiento registrado correctamente.');
    }

    public function edit(Tratamiento $tratamiento)
    {
        $problemas = Problema::all();
        $plantas = Planta::all();
        $cuidados = Cuidado::all();

        return view('tratamientos.edit', compact('tratamiento', 'problemas', 'plantas'));
    }

    public function update(Request $request, Tratamiento $tratamiento)
    {
        $request->validate([
    'id_problema' => 'required|exists:problemas,id',
    'id_planta' => 'nullable|exists:plantas,id',
    'id_cuidado' => 'nullable|exists:cuidados,id',
    'descripcion' => 'nullable|string',
    'indicaciones' => 'nullable|string',
    'frecuencia_dias' => 'required|integer|min:1',
]);

        $tratamiento->update($request->all());

        return redirect()->route('tratamientos.index')
            ->with('success', 'Tratamiento actualizado correctamente.');
    }

    public function destroy(Tratamiento $tratamiento)
    {
        $tratamiento->delete();

        return redirect()->route('tratamientos.index')
            ->with('success', 'Tratamiento eliminado correctamente.');
    }
    public function show(Tratamiento $tratamiento)
{
    $tratamiento->load(['problema', 'planta', 'cuidado']);

    return view('tratamientos.show', compact('tratamiento'));
}
}