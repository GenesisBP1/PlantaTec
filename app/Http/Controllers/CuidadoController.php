<?php

namespace App\Http\Controllers;

use App\Models\Cuidado;
use Illuminate\Http\Request;

class CuidadoController extends Controller
{
    public function index()
{
    $cuidados = Cuidado::latest()->get();

    $tableCuidadosRows = $cuidados->map(function($cuidado) {
        return [
            '<div class="pt-table-name">
                <span class="pt-table-icon">🌿</span>
                <span>' . e($cuidado->nombre) . '</span>
            </div>',

            e($cuidado->descripcion ?? 'Sin descripción'),
        ];
    })->toArray();

    $tableCuidadosActions = $cuidados->map(function($cuidado) {
        return [
            'view' => route('cuidados.show', $cuidado->id),
            'edit' => route('cuidados.edit', $cuidado->id),
            'delete' => route('cuidados.destroy', $cuidado->id),
        ];
    })->toArray();

    return view('cuidados.index', compact('cuidados', 'tableCuidadosRows', 'tableCuidadosActions'));
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
    public function show(Cuidado $cuidado)
{
    return view('cuidados.show', compact('cuidado'));
}
}
