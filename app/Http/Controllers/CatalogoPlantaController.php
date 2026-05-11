<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use App\Models\Adopcion;
use App\Models\Ubicacion;
use App\Models\RecomendacionZona;
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
        $zonasRecomendadas = RecomendacionZona::all();
    
        return view('catalogo.show', compact('planta', 'zonasRecomendadas'));
    }

    public function adoptar(Request $request, Planta $planta)
    {
        $request->validate([
            'tipo' => 'required|in:publico,privado',
        ]);

        if ($request->tipo === 'publico') {
            $request->validate([
                'id_recomendacion_zona' => 'required|exists:recomendaciones_zona,id',
            ]);

            $zona = RecomendacionZona::findOrFail($request->id_recomendacion_zona);

            $ubicacion = Ubicacion::create([
                'tipo' => 'publico',
                'nombre_lugar' => $zona->nombre_lugar,
                'descripcion' => $zona->descripcion,
                'latitud' => $zona->latitud,
                'longitud' => $zona->longitud,
            ]);
        }

        if ($request->tipo === 'privado') {
            $request->validate([
                'nombre_lugar_privado' => 'required|string|max:255',
                'descripcion_privada' => 'nullable|string',
            ]);

            $ubicacion = Ubicacion::create([
                'tipo' => 'privado',
                'nombre_lugar' => $request->nombre_lugar_privado,
                'descripcion' => $request->descripcion_privada,
                'latitud' => null,
                'longitud' => null,
            ]);
        }

        Adopcion::create([
            'id_usuario' => auth()->id(),
            'id_planta' => $planta->id,
            'id_ubicacion' => $ubicacion->id,
            'estado_adopcion' => 'activa',
        ]);

        return redirect()->route('adopciones.index')
            ->with('success', 'Planta adoptada correctamente.');
    }
}