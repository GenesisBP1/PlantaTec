<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function index()
    {
        $ubicaciones = Ubicacion::latest()->get();
        return view('ubicaciones.index', compact('ubicaciones'));
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
        ]);

        Ubicacion::create($request->all());

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
        ]);

        $ubicacion->update($request->all());

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