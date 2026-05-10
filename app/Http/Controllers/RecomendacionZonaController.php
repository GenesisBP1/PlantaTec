<?php

namespace App\Http\Controllers;

use App\Models\RecomendacionZona;
use Illuminate\Http\Request;

class RecomendacionZonaController extends Controller
{
    public function index()
    {
        $zonas = RecomendacionZona::latest()->paginate(10);
        return view('recomendaciones-zona.index', compact('zonas'));
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