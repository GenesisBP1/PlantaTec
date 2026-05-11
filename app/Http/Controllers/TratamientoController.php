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
        // Cargar relaciones: problema y planta
        $tratamientos = Tratamiento::with(['problema', 'planta'])->latest()->get();

        return view('tratamientos.index', compact('tratamientos'));
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
}