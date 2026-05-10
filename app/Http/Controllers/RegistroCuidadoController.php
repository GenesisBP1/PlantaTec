<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\RegistroCuidado;
use App\Models\RecomendacionCuidado;
use App\Models\Notificacion;
use App\Models\ReporteProblema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroCuidadoController extends Controller
{
    public function create(Request $request)
    {
        $adopcion = Adopcion::with('planta.plantaCuidados.cuidado')
            ->where('id_usuario', auth()->id())
            ->findOrFail($request->adopcion_id);

        $cuidados = $adopcion->planta->plantaCuidados;

        return view('registro_cuidados.create', compact('adopcion', 'cuidados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_adopcion'        => 'required|exists:adopciones,id',
            'id_planta_cuidado'  => 'required|exists:planta_cuidados,id',
            'fecha'              => 'required|date',
            'imagen'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'descripcion'        => 'nullable|string',
            'estado_observado'   => 'nullable|string|max:255',
        ]);

        // Preparamos los datos (excluimos 'imagen')
        $datos = $request->except('imagen');

        DB::beginTransaction();

        try {
            // 1. Guardar imagen si existe
            if ($request->hasFile('imagen')) {
                $datos['imagen'] = $request->file('imagen')->store('cuidados', 'public');
            }

            // 2. Crear el registro de cuidado
            $registro = RegistroCuidado::create($datos);

            // 3. Actualizar reportes de problemas activos de esta adopción a "en_revision"
            ReporteProblema::where('id_adopcion', $request->id_adopcion)
                ->where('estado', 'activo')
                ->update(['estado' => 'en_revision']);

            // 4. Obtener IDs de recomendaciones pendientes que se están atendiendo
            $recomendacionesAtendidas = RecomendacionCuidado::where('id_adopcion', $request->id_adopcion)
                ->where('id_planta_cuidado', $request->id_planta_cuidado)
                ->where('estado', 'pendiente')
                ->pluck('id');

            if ($recomendacionesAtendidas->isNotEmpty()) {
                // 5. Marcar recomendaciones como atendidas
                RecomendacionCuidado::whereIn('id', $recomendacionesAtendidas)
                    ->update(['estado' => 'atendida']);

                // 6. Marcar notificaciones relacionadas como leídas
                Notificacion::whereIn('id_recomendacion_cuidado', $recomendacionesAtendidas)
                    ->update(['leida' => true]);
            }

            DB::commit();

            return redirect()->route('adopciones.show', $request->id_adopcion)
                ->with('success', 'Cuidado registrado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Opcional: registrar el error en log
            // \Log::error('Error al registrar cuidado: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Ocurrió un error al guardar el cuidado. Intente nuevamente.')
                ->withInput();
        }
    }
}