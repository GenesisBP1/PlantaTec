<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Adopcion;
use App\Models\Ubicacion;
use App\Models\Planta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdopcionMapaController extends Controller
{
    /**
     * Crear adopción con ubicación en el mapa
     */
    public function crearAdopcionConUbicacion(Request $request)
    {
        $request->validate([
            'id_planta' => 'required|exists:plantas,id',
            'latitud' => 'required|numeric|between:-90,90',
            'longitud' => 'required|numeric|between:-180,180',
            'nombre_lugar' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
            'es_publica' => 'required|boolean',
            'tipo' => 'required|in:publico,privado',
        ]);

        try {
            DB::beginTransaction();

            // Crear ubicación
            $ubicacion = Ubicacion::create([
                'id_usuario' => Auth::id(),
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
                'nombre_lugar' => $request->nombre_lugar,
                'descripcion' => $request->descripcion,
                'es_publica' => $request->es_publica,
                'tipo' => $request->tipo,
            ]);

            // Crear adopción
            $adopcion = Adopcion::create([
                'id_usuario' => Auth::id(),
                'id_planta' => $request->id_planta,
                'id_ubicacion' => $ubicacion->id,
                'fecha_adopcion' => now(),
                'estado_adopcion' => 'activa',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Planta adoptada correctamente en la ubicación seleccionada',
                'data' => [
                    'adopcion' => $adopcion,
                    'ubicacion' => $ubicacion,
                ],
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al crear la adopción: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Obtener adopciones con ubicación para mostrar en mapa
     */
    public function getAdopcionesEnMapa()
    {
        $user = Auth::user();

        $adopciones = Adopcion::with(['usuario', 'planta', 'ubicacion'])
            ->whereNotNull('id_ubicacion')
            ->when($user->rol !== 'admin', function ($query) use ($user) {
                return $query->where(function ($q) use ($user) {
                    $q->where('adopciones.id_usuario', $user->id)
                      ->orWhereHas('ubicacion', function ($uQ) {
                          $uQ->where('es_publica', true);
                      });
                });
            })
            ->get();

        return response()->json([
            'success' => true,
            'data' => $adopciones->map(function ($adopcion) {
                return [
                    'id' => $adopcion->id,
                    'ubicacion' => [
                        'id' => $adopcion->ubicacion->id,
                        'latitud' => (float)$adopcion->ubicacion->latitud,
                        'longitud' => (float)$adopcion->ubicacion->longitud,
                        'nombre' => $adopcion->ubicacion->nombre_lugar,
                        'es_publica' => $adopcion->ubicacion->es_publica,
                    ],
                    'planta' => [
                        'id' => $adopcion->planta->id,
                        'nombre' => $adopcion->planta->nombre,
                        'imagen' => $adopcion->planta->imagen,
                    ],
                    'usuario' => [
                        'id' => $adopcion->usuario->id,
                        'nombre' => $adopcion->usuario->name,
                    ],
                    'fecha_adopcion' => $adopcion->fecha_adopcion->format('d/m/Y H:i'),
                    'estado' => $adopcion->estado_adopcion,
                ];
            }),
        ]);
    }
}
