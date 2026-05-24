<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Adopcion;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Lista de usuarios con búsqueda y estadísticas básicas.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $usuarios = User::where('rol', 'usuario') // solo usuarios normales
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->with(['adopciones' => function ($q) {
                $q->with(['planta', 'registrosCuidados', 'reportesProblemas.problema']);
            }])
            ->paginate(10);

        // Agregar estadísticas calculadas
        foreach ($usuarios as $usuario) {
            $usuario->total_adopciones = $usuario->adopciones->count();
            $usuario->total_cuidados = $usuario->adopciones->sum(fn($a) => $a->registrosCuidados->count());
            $usuario->problemas_activos = $usuario->adopciones->sum(fn($a) => $a->reportesProblemas->where('estado', 'activo')->count());
        }

        return view('admin.usuarios.index', compact('usuarios', 'search'));
    }

    /**
     * Obtiene el resumen de adopciones de un usuario (para el modal).
     */
    public function resumen($id)
    {
        $usuario = User::with(['adopciones.planta', 'adopciones.registrosCuidados', 'adopciones.reportesProblemas.problema'])
            ->findOrFail($id);

        $adopciones = $usuario->adopciones->map(function ($adop) {
            return [
                'id' => $adop->id,
                'planta_nombre' => $adop->planta->nombre,
                'estado_adopcion' => $adop->estado_adopcion,
                'fecha_adopcion' => $adop->fecha_adopcion->format('d/m/Y'),
                'ultimo_cuidado' => $adop->registrosCuidados->sortByDesc('fecha')->first(),
                'problemas_activos' => $adop->reportesProblemas->where('estado', 'activo')->values(),
                'total_cuidados' => $adop->registrosCuidados->count(),
            ];
        });

        return response()->json([
            'usuario' => $usuario->name,
            'email' => $usuario->email,
            'adopciones' => $adopciones
        ]);
    }
}