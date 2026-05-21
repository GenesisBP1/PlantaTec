<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use App\Models\Adopcion;
use App\Models\Ubicacion;
use App\Models\RecomendacionZona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogoPlantaController extends Controller
{
    public function index(Request $request)
    {
        $query = Planta::query();

        if ($request->filled('term')) {
            $term = $request->term;
            $query->where(function($q) use ($term) {
                $q->where('nombre', 'like', "%{$term}%")
                  ->orWhere('especie', 'like', "%{$term}%");
            });
        }

        if ($request->filled('zona') && $request->zona !== '') {
            $query->where('tipo_zona', $request->zona);
        }

        $plantas = $query->latest()->get();

        if ($request->ajax()) {
            return view('catalogo.partials.plantas_grid', compact('plantas'));
        }

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

        try {
            DB::beginTransaction();

            if ($request->tipo === 'publico') {
                $metodo = $request->input('metodo_ubicacion_publica', 'zona');

                if ($metodo === 'zona') {
                    $request->validate([
                        'id_recomendacion_zona' => 'required|exists:recomendaciones_zona,id',
                    ]);

                    $zona = RecomendacionZona::findOrFail($request->id_recomendacion_zona);

                    $ubicacion = Ubicacion::create([
                        'id_usuario' => auth()->id(),
                        'tipo' => 'publico',
                        'nombre_lugar' => $zona->nombre_lugar,
                        'descripcion' => $zona->descripcion,
                        'latitud' => $zona->latitud,
                        'longitud' => $zona->longitud,
                        'es_publica' => true,
                    ]);
                } else {
                    $request->validate([
                        'latitud' => 'required|numeric|between:-90,90',
                        'longitud' => 'required|numeric|between:-180,180',
                        'nombre_lugar' => 'required|string|max:255',
                    ]);

                    $ubicacion = Ubicacion::create([
                        'id_usuario' => auth()->id(),
                        'tipo' => 'publico',
                        'nombre_lugar' => $request->nombre_lugar,
                        'descripcion' => $request->descripcion ?? null,
                        'latitud' => $request->latitud,
                        'longitud' => $request->longitud,
                        'es_publica' => true,
                    ]);
                }
            } elseif ($request->tipo === 'privado') {
                $metodo = $request->input('metodo_ubicacion_privada', 'nombre');

                if ($metodo === 'nombre') {
                    $request->validate([
                        'nombre_lugar_privado' => 'required|string|max:255',
                    ]);

                    $ubicacion = Ubicacion::create([
                        'id_usuario' => auth()->id(),
                        'tipo' => 'privado',
                        'nombre_lugar' => $request->nombre_lugar_privado,
                        'descripcion' => $request->descripcion_privada,
                        'latitud' => null,
                        'longitud' => null,
                        'es_publica' => false,
                    ]);
                } else {
                    $request->validate([
                        'latitud_privada' => 'required|numeric|between:-90,90',
                        'longitud_privada' => 'required|numeric|between:-180,180',
                        'nombre_lugar_privado_mapa' => 'required|string|max:255',
                    ]);

                    $ubicacion = Ubicacion::create([
                        'id_usuario' => auth()->id(),
                        'tipo' => 'privado',
                        'nombre_lugar' => $request->nombre_lugar_privado_mapa,
                        'descripcion' => $request->descripcion_privada_mapa,
                        'latitud' => $request->latitud_privada,
                        'longitud' => $request->longitud_privada,
                        'es_publica' => false,
                    ]);
                }
            }

            $adopcion = Adopcion::create([
                'id_usuario' => auth()->id(),
                'id_planta' => $planta->id,
                'id_ubicacion' => $ubicacion->id,
                'fecha_adopcion' => now(),
                'estado_adopcion' => 'activa',
            ]);

            DB::commit();

            return redirect()->route('adopciones.index')
                ->with('success', 'Planta adoptada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al adoptar planta: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()
                ->with('error', 'Error al adoptar la planta: ' . $e->getMessage());
        }
    }

    public function buscar(Request $request)
    {
        $termino = $request->get('q');
        if (!$termino || strlen($termino) < 2) {
            return response()->json([]);
        }

        $plantas = Planta::where('nombre', 'like', "%{$termino}%")
            ->orWhere('especie', 'like', "%{$termino}%")
            ->limit(8)
            ->get(['id', 'nombre', 'especie', 'imagen']);

        return response()->json($plantas);
    }
}