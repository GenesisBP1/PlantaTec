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
        // Obtener todas las zonas recomendadas (para el select público)
        $zonasRecomendadas = RecomendacionZona::all();
        return view('catalogo.show', compact('planta', 'zonasRecomendadas'));
    }

    public function adoptar(Request $request, Planta $planta)
    {
        $ubicacionId = null;

        // Validar que si envía tipo debe enviar también nombre_lugar
        if ($request->filled('tipo')) {
            $request->validate([
                'tipo'         => 'required|string|in:publico,privado',
                'nombre_lugar' => 'required|string|max:255',
                'descripcion'  => 'nullable|string',
                'latitud'      => 'nullable|numeric',
                'longitud'     => 'nullable|numeric',
            ]);

            // Si es público, latitud y longitud son obligatorios (vienen del select)
            if ($request->tipo === 'publico') {
                $request->validate([
                    'latitud'  => 'required|numeric',
                    'longitud' => 'required|numeric',
                ]);
            }

            $ubicacion = Ubicacion::create([
                'tipo'         => $request->tipo,
                'nombre_lugar' => $request->nombre_lugar,
                'descripcion'  => $request->descripcion,
                'latitud'      => $request->latitud,
                'longitud'     => $request->longitud,
            ]);

            $ubicacionId = $ubicacion->id;
        }

        Adopcion::create([
            'id_usuario'      => auth()->id(),
            'id_planta'       => $planta->id,
            'id_ubicacion'    => $ubicacionId,
            'estado_adopcion' => 'activa',
        ]);

        return redirect()->route('adopciones.index')
            ->with('success', 'Planta adoptada correctamente.');
    }

    public function destacadas()
    {
        $plantas = Planta::where('destacada', true)->get();
        return view('catalogo.destacadas', compact('plantas'));
    }
}