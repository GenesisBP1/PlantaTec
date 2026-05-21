<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use Illuminate\Http\Request;

class AdopcionController extends Controller
{
    public function index(Request $request)
    {
        $query = Adopcion::with(['planta', 'ubicacion', 'usuario']);

        if (auth()->user()->rol !== 'admin') {
            $query->where('id_usuario', auth()->id());
        }

        if ($request->filled('estado')) {
            $query->where('estado_adopcion', $request->estado);
        }

        $adopciones = $query->latest()->get();

        return view('adopciones.index', compact('adopciones'));
    }

    public function show(Adopcion $adopcione)
    {
        $adopcion = $adopcione;

        // Permitir ver a admin o al dueño de la adopción
        if (auth()->user()->rol !== 'admin' && $adopcion->id_usuario !== auth()->id()) {
            abort(403, 'No tienes permiso para ver esta adopción.');
        }

        $adopcion->load([
            'planta',
            'ubicacion',
            'registrosCuidados.plantaCuidado.cuidado',
            'reportesProblemas.problema',
            'reportesProblemas.tratamientosReportes.tratamiento',
        ]);

        return view('adopciones.show', compact('adopcion'));
    }

    public function destroy(Adopcion $adopcione)
    {
        $adopcion = $adopcione;

        // Administrador puede cancelar cualquier adopción; usuario normal solo las suyas
        if (auth()->user()->rol !== 'admin' && $adopcion->id_usuario !== auth()->id()) {
            abort(403, 'No tienes permiso para cancelar esta adopción.');
        }

        $adopcion->update([
            'estado_adopcion' => 'cancelada'
        ]);

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción cancelada correctamente.');
    }

    public function update(Request $request, Adopcion $adopcione)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $adopcione->update([
            'estado_adopcion' => $request->estado_adopcion
        ]);

        return redirect()->route('adopciones.index')
            ->with('success', 'Estado actualizado correctamente.');
    }
    public function edit($id)
    {
        $adopcion = Adopcion::with(['usuario', 'planta', 'ubicacion'])->findOrFail($id);
        $ubicaciones = Ubicacion::all();
        
        return view('adopciones.edit', compact('adopcion', 'ubicaciones'));
    }
}