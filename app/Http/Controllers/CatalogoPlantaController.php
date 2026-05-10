<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use App\Models\Adopcion;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class CatalogoPlantaController extends Controller
{
    public function index()
    {
        $plantas = Planta::latest()->get();

        return view('catalogo.index', compact('plantas'));
    }

    public function show(Planta $planta)
    {
        return view('catalogo.show', compact('planta'));
    }

    public function adoptar(Request $request, Planta $planta)
    {
        $ubicacionId = null;    
    
        if ($request->filled('tipo') || $request->filled('nombre_lugar')) { 
    
            $request->validate([
                'tipo' => 'required|string',
                'nombre_lugar' => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'latitud' => 'nullable|numeric',
                'longitud' => 'nullable|numeric',
            ]);
    
            $ubicacion = Ubicacion::create([
                'tipo' => $request->tipo,
                'nombre_lugar' => $request->nombre_lugar,
                'descripcion' => $request->descripcion,
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
            ]);
    
            $ubicacionId = $ubicacion->id;
        }
    
        Adopcion::create([
            'id_usuario' => auth()->id(),
            'id_planta' => $planta->id,
            'id_ubicacion' => $ubicacionId,
            'estado_adopcion' => 'activa',
        ]);
    
        return redirect()->route('adopciones.index')
            ->with('success', 'Planta adoptada correctamente.');
    }
}