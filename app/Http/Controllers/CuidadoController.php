<?php

namespace App\Http\Controllers;

use App\Models\Cuidado;
use Illuminate\Http\Request;

class CuidadoController extends Controller
{
    public function index()
    {
        $cuidados = Cuidado::latest()->get();
        
        // Preparar datos para la tabla
        $tableCuidadosRows = $cuidados->map(function($cuidado) {
            return [
                '<div class="flex items-center gap-2"><svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/></svg><span class="font-medium">' . $cuidado->nombre . '</span></div>',
                substr($cuidado->descripcion ?? 'Sin descripción', 0, 60) . (strlen($cuidado->descripcion ?? '') > 60 ? '...' : ''),
            ];
        })->toArray();
        
        $tableCuidadosActions = $cuidados->map(function($cuidado) {
            return [
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
}