<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapaController extends Controller
{
    /**
     * Mostrar el mapa principal
     */
    public function index()
    {
        return view('mapas.index');
    }

    /**
     * Obtener ubicaciones públicas y las del usuario (API JSON)
     */
    public function getUbicaciones()
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['success' => true, 'data' => []]);
        }

        // Construir query base
        $query = Ubicacion::with(['usuario', 'adopciones.planta']);

        // Usar whereRaw con paréntesis para agrupar condiciones
        if ($user->rol === 'admin') {
            // Admin: mostrar TODAS las ubicaciones
            // Sin filtro adicional
        } else {
            // Usuario normal: mostrar públicas O sus propias
            $query->where(function ($q) use ($user) {
                $q->where('es_publica', true)
                  ->orWhere('id_usuario', $user->id);
            });
        }
        
        $ubicaciones = $query->get();

        return response()->json([
            'success' => true,
            'data' => $ubicaciones->map(function ($ubicacion) use ($user) {
                return [
                    'id' => $ubicacion->id,
                    'latitud' => (float)$ubicacion->latitud,
                    'longitud' => (float)$ubicacion->longitud,
                    'nombre_lugar' => $ubicacion->nombre_lugar,
                    'descripcion' => $ubicacion->descripcion,
                    'tipo' => $ubicacion->tipo,
                    'es_publica' => $ubicacion->es_publica,
                    'usuario_nombre' => $ubicacion->usuario?->name ?? 'Desconocido',
                    'usuario_id' => $ubicacion->id_usuario,
                    'adopciones' => $ubicacion->adopciones->map(function ($adopcion) {
                        return [
                            'id' => $adopcion->id,
                            'planta_nombre' => $adopcion->planta->nombre,
                            'planta_imagen' => $adopcion->planta->imagen,
                            'fecha_adopcion' => $adopcion->fecha_adopcion->format('d/m/Y'),
                            'estado' => $adopcion->estado_adopcion,
                        ];
                    })->toArray(),
                ];
            })->toArray(),
        ]);
    }

    /**
     * Guardar ubicación seleccionada en el mapa
     */
    public function guardarUbicacion(Request $request)
    {
        $request->validate([
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'nombre_lugar' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'es_publica' => 'required|boolean',
            'tipo' => 'required|in:publico,privado',
        ]);

        $ubicacion = Ubicacion::create([
            'id_usuario' => Auth::id(),
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'nombre_lugar' => $request->nombre_lugar,
            'descripcion' => $request->descripcion,
            'es_publica' => $request->es_publica,
            'tipo' => $request->tipo,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ubicación guardada correctamente',
            'data' => $ubicacion,
        ]);
    }

    /**
     * Obtener ubicaciones cercanas (radio de búsqueda)
     */
    public function getUbicacionesCercanas(Request $request)
    {
        $request->validate([
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'radio' => 'numeric|min:0.1|max:50', // en km
        ]);

        $latitud = $request->latitud;
        $longitud = $request->longitud;
        $radio = $request->radio ?? 5; // 5km por defecto

        $user = Auth::user();

        // Fórmula de Haversine para calcular distancia entre dos puntos GPS
        $query = Ubicacion::with(['usuario', 'adopciones.planta'])
            ->where('es_publica', true)
            ->selectRaw(
                "*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitud ) ) * 
                cos( radians( longitud ) - radians(?) ) + sin( radians(?) ) * 
                sin( radians( latitud ) ) ) ) AS distancia",
                [$latitud, $longitud, $latitud]
            )
            ->having('distancia', '<=', $radio)
            ->orderBy('distancia');

        // Si no es admin, agregar ubicaciones privadas del usuario
        if ($user->rol !== 'admin') {
            $query->orWhere('id_usuario', $user->id)
                ->selectRaw(
                    "*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitud ) ) * 
                    cos( radians( longitud ) - radians(?) ) + sin( radians(?) ) * 
                    sin( radians( latitud ) ) ) ) AS distancia",
                    [$latitud, $longitud, $latitud]
                )
                ->having('distancia', '<=', $radio)
                ->orderBy('distancia');
        }

        $ubicaciones = $query->get();

        return response()->json([
            'success' => true,
            'data' => $ubicaciones,
        ]);
    }

    /**
     * Actualizar privacidad de ubicación
     */
    public function updatePrivacidad(Request $request, Ubicacion $ubicacion)
    {
        // Solo el propietario o admin puede cambiar privacidad
        if (Auth::id() !== $ubicacion->id_usuario && Auth::user()->rol !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permiso para cambiar esto',
            ], 403);
        }

        $request->validate([
            'es_publica' => 'required|boolean',
        ]);

        $ubicacion->update([
            'es_publica' => $request->es_publica,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Privacidad actualizada',
            'data' => $ubicacion,
        ]);
    }

    /**
     * Eliminar ubicación
     */
    public function destroy(Ubicacion $ubicacion)
    {
        // Solo el propietario o admin puede eliminar
        if (Auth::id() !== $ubicacion->id_usuario && Auth::user()->rol !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permiso para eliminar esto',
            ], 403);
        }

        $ubicacion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ubicación eliminada',
        ]);
    }

    /**
     * Obtener zonas recomendadas (API JSON)
     */
    public function getZonasRecomendadas()
    {
        $zonas = \App\Models\RecomendacionZona::all();

        return response()->json([
            'success' => true,
            'data' => $zonas->map(function ($zona) {
                return [
                    'id' => $zona->id,
                    'latitud' => (float)$zona->latitud,
                    'longitud' => (float)$zona->longitud,
                    'nombre_lugar' => $zona->nombre_lugar,
                    'descripcion' => $zona->descripcion,
                    'tipo_zona' => $zona->tipo_zona,
                    'es_zona_recomendada' => true,
                ];
            })->toArray(),
        ]);
    }
}
