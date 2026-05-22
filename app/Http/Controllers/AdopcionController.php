<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class AdopcionController extends Controller
{
    public function index(Request $request)
    {
        // Vista para usuario normal
        if (auth()->user()->rol !== 'admin') {
            $adopciones = Adopcion::where('id_usuario', auth()->id())
                ->with([
                    'planta.plantaCuidados.cuidado',
                    'ubicacion',
                    'registrosCuidados',
                ])
                ->latest()
                ->get();

            return view('adopciones.index_user', compact('adopciones'));
        }

        // Vista para administrador
        $adopcionesBase = Adopcion::with([
            'usuario',
            'planta',
            'ubicacion',
            'registrosCuidados.plantaCuidado.cuidado',
            'reportesProblemas.problema',
        ])
            ->latest()
            ->get();

        $resumenUsuarios = $adopcionesBase
            ->groupBy('id_usuario')
            ->map(function ($adopcionesUsuario) {
                $usuario = $adopcionesUsuario->first()->usuario;

                $totalRegistros = $adopcionesUsuario->sum(function ($adopcion) {
                    return $adopcion->registrosCuidados->count();
                });

                $totalProblemas = $adopcionesUsuario->sum(function ($adopcion) {
                    return $adopcion->reportesProblemas->count();
                });

                $problemasResueltos = $adopcionesUsuario->sum(function ($adopcion) {
                    return $adopcion->reportesProblemas
                        ->where('estado', 'resuelto')
                        ->count();
                });

                return [
                    'usuario_id' => $usuario->id ?? null,
                    'nombre' => $usuario->name ?? 'Usuario no disponible',
                    'email' => $usuario->email ?? 'Sin correo',
                    'total_plantas' => $adopcionesUsuario->count(),
                    'total_registros' => $totalRegistros,
                    'total_problemas' => $totalProblemas,
                    'problemas_resueltos' => $problemasResueltos,
                ];
            })
            ->values();

        $usuarioSeleccionadoId = $request->usuario_id;

        $adopcionesUsuarioSeleccionado = collect();
        $usuarioSeleccionado = null;
        $historialCuidados = collect();

        if ($usuarioSeleccionadoId) {
            $adopcionesUsuarioSeleccionado = Adopcion::where('id_usuario', $usuarioSeleccionadoId)
                ->with([
                    'usuario',
                    'planta',
                    'ubicacion',
                    'registrosCuidados.plantaCuidado.cuidado',
                    'reportesProblemas.problema',
                ])
                ->latest()
                ->get();

            $usuarioSeleccionado = $adopcionesUsuarioSeleccionado->first()->usuario ?? null;

            $historialCuidados = $adopcionesUsuarioSeleccionado
                ->flatMap(function ($adopcion) {
                    return $adopcion->registrosCuidados->map(function ($registro) use ($adopcion) {
                        $registro->adopcion_original = $adopcion;
                        return $registro;
                    });
                })
                ->sortByDesc('fecha');
        }

        return view('adopciones.index', compact(
            'resumenUsuarios',
            'usuarioSeleccionado',
            'adopcionesUsuarioSeleccionado',
            'historialCuidados'
        ));
    }

    public function show(Adopcion $adopcione)
    {
        $adopcion = $adopcione;

        // Permitir ver a admin o al dueño de la adopción
        if (auth()->user()->rol !== 'admin' && $adopcion->id_usuario !== auth()->id()) {
            abort(403, 'No tienes permiso para ver esta adopción.');
        }

        $adopcion->load([
            'planta.plantaCuidados.cuidado',
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
            'estado_adopcion' => 'cancelada',
        ]);

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción cancelada correctamente.');
    }

    public function update(Request $request, Adopcion $adopcione)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403, 'No tienes permiso para actualizar esta adopción.');
        }


        $request->validate([
            'estado_adopcion' => 'required|string',
            'id_ubicacion' => 'nullable|exists:ubicaciones,id',
        ]);

        $data = [
            'estado_adopcion' => $request->estado_adopcion,
        ];

        if ($request->filled('id_ubicacion')) {
            $data['id_ubicacion'] = $request->id_ubicacion;
        }

        $adopcione->update($data);

        return redirect()->route('adopciones.index')
            ->with('success', 'Estado actualizado correctamente.');
    }

    public function edit($id)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403, 'No tienes permiso para editar esta adopción.');
        }

        $adopcion = Adopcion::with(['usuario', 'planta', 'ubicacion'])->findOrFail($id);
        $ubicaciones = Ubicacion::all();

        return view('adopciones.edit', compact('adopcion', 'ubicaciones'));
    }
}