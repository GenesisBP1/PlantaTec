<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use Illuminate\Http\Request;

class PlantaController extends Controller
{
    public function index()
    {
        $plantas = Planta::latest()->get();
        return view('plantas.index', compact('plantas'));
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
}