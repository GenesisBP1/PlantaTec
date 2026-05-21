<?php

namespace App\Http\Controllers;

use App\Models\Problema;
use Illuminate\Http\Request;

class ProblemaController extends Controller
{
    public function index()
{
    $problemas = Problema::latest()->get();

    $tableProblemasRows = $problemas->map(function ($problema) {
        return [
            '<strong>' . e($problema->nombre) . '</strong>',
            e($problema->descripcion ?? 'Sin descripción'),
        ];
    })->toArray();

    $tableProblemasActions = $problemas->map(function ($problema) {
        return [
            'view' => route('problemas.show', $problema->id),
            'edit' => route('problemas.edit', $problema->id),
            'delete' => route('problemas.destroy', $problema->id),
        ];
    })->toArray();

    return view('problemas.index', compact('problemas', 'tableProblemasRows', 'tableProblemasActions'));
}

    public function create()
    {
        return view('problemas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Problema::create($request->all());

        return redirect()->route('problemas.index')
            ->with('success', 'Problema registrado correctamente.');
    }

    public function edit(Problema $problema)
    {
        return view('problemas.edit', compact('problema'));
    }

    public function update(Request $request, Problema $problema)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $problema->update($request->all());

        return redirect()->route('problemas.index')
            ->with('success', 'Problema actualizado correctamente.');
    }

    public function destroy(Problema $problema)
    {
        $problema->delete();

        return redirect()->route('problemas.index')
            ->with('success', 'Problema eliminado correctamente.');
    }
    public function show(Problema $problema)
{
    return view('problemas.show', compact('problema'));
}
}