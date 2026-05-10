<?php

namespace App\Http\Controllers;

use App\Models\Cuidado;
use Illuminate\Http\Request;

class CuidadoController extends Controller
{
    public function index()
    {
        $cuidados = Cuidado::latest()->get();
        return view('cuidados.index', compact('cuidados'));
    }

    public function create()
    {
        return view('cuidados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Cuidado::create($request->all());

        return redirect()->route('cuidados.index')
            ->with('success', 'Cuidado registrado correctamente.');
    }

    public function edit(Cuidado $cuidado)
    {
        return view('cuidados.edit', compact('cuidado'));
    }

    public function update(Request $request, Cuidado $cuidado)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $cuidado->update($request->all());

        return redirect()->route('cuidados.index')
            ->with('success', 'Cuidado actualizado correctamente.');
    }

    public function destroy(Cuidado $cuidado)
    {
        $cuidado->delete();

        return redirect()->route('cuidados.index')
            ->with('success', 'Cuidado eliminado correctamente.');
    }
}