<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Problema;
use App\Models\ReporteProblema;
use App\Models\Tratamiento;
use App\Models\TratamientoReporte;
use Illuminate\Http\Request;

class ReporteProblemaController extends Controller
{
    public function index()
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403, 'No tienes permiso para ver los reportes.');
        }

        $reportes = ReporteProblema::with([
            'adopcion.usuario',
            'adopcion.planta',
            'problema',
        ])->latest()->get();

        $tableReportesRows = $reportes->map(function ($reporte) {
            $gravedadClass = match (strtolower($reporte->gravedad ?? 'leve')) {
                'grave' => 'pt-badge pt-badge-danger',
                'media', 'moderada' => 'pt-badge pt-badge-warning',
                default => 'pt-badge pt-badge-success',
            };

            $estadoClass = match (strtolower($reporte->estado ?? 'pendiente')) {
                'resuelto' => 'pt-badge pt-badge-success',
                'en_revision' => 'pt-badge pt-badge-warning',
                default => 'pt-badge pt-badge-info',
            };

            return [
                e($reporte->adopcion->usuario->name ?? 'Usuario no disponible'),
                e($reporte->adopcion->planta->nombre ?? 'Planta no disponible'),
                e($reporte->problema->nombre ?? 'Problema no disponible'),
                '<span class="' . $gravedadClass . '">' . ucfirst($reporte->gravedad ?? 'leve') . '</span>',
                '<span class="' . $estadoClass . '">' . ucfirst(str_replace('_', ' ', $reporte->estado ?? 'pendiente')) . '</span>',
                $reporte->created_at ? $reporte->created_at->format('d/m/Y') : 'Sin fecha',
            ];
        })->toArray();

        $tableReportesActions = $reportes->map(function ($reporte) {
            return [
                'view' => route('reporte-problemas.show', $reporte->id),
                   'edit' => route('reporte-problemas.edit', $reporte->id),
                'delete' => route('reporte-problemas.destroy', $reporte->id),   
                ];
        })->toArray();

        return view('reporte_problemas.index', compact(
            'reportes',
            'tableReportesRows',
            'tableReportesActions'
        ));
    }

    public function create(Request $request)
    {
        $adopcion = Adopcion::with('planta')
            ->where('id_usuario', auth()->id())
            ->findOrFail($request->adopcion_id);

        $problemas = Problema::all();

        return view('reporte_problemas.create', compact('adopcion', 'problemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_adopcion' => 'required|exists:adopciones,id',
            'id_problema' => 'required|exists:problemas,id',
            'descripcion' => 'nullable|string',
            'gravedad' => 'required|in:leve,media,grave',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $datos = $request->except('imagen');

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('problemas', 'public');
        }

        $reporte = ReporteProblema::create($datos);

        $reporte->load('adopcion');

        $tratamientos = Tratamiento::where('id_problema', $reporte->id_problema)
            ->where(function ($query) use ($reporte) {
                $query->where('id_planta', $reporte->adopcion->id_planta)
                    ->orWhereNull('id_planta');
            })
            ->get();

        foreach ($tratamientos as $tratamiento) {
            TratamientoReporte::create([
                'id_reporte_problema' => $reporte->id,
                'id_tratamiento' => $tratamiento->id,
                'frecuencia_dias' => $tratamiento->frecuencia_dias ?? 1,
                'fecha_inicio' => now()->toDateString(),
                'fecha_proxima' => now()->addDays($tratamiento->frecuencia_dias ?? 1)->toDateString(),
                'estado' => 'pendiente',
            ]);
        }

        return redirect()->route('reporte-problemas.show', $reporte)
            ->with('success', 'Problema reportado correctamente.');
    }

    public function show(ReporteProblema $reporteProblema)
    {
        $reporteProblema->load([
            'adopcion.usuario',
            'adopcion.planta',
            'problema',
            'tratamientosReportes.tratamiento',
        ]);

        if (
            auth()->user()->rol !== 'admin' &&
            $reporteProblema->adopcion->id_usuario !== auth()->id()
        ) {
            abort(403, 'No tienes permiso para ver este reporte.');
        }

        return view('reporte_problemas.show', compact('reporteProblema'));
    }

    public function resolver(ReporteProblema $reporteProblema)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403, 'No tienes permiso para resolver reportes.');
        }

        $reporteProblema->update([
            'estado' => 'resuelto',
        ]);

        return redirect()->route('reporte-problemas.index')
            ->with('success', 'Problema marcado como resuelto.');
    }

    public function subirEvidenciaTratamiento(Request $request, TratamientoReporte $tratamientoReporte)
    {
        $tratamientoReporte->load('reporteProblema.adopcion');

        if (
            auth()->user()->rol !== 'admin' &&
            $tratamientoReporte->reporteProblema->adopcion->id_usuario !== auth()->id()
        ) {
            abort(403, 'No tienes permiso para registrar esta evidencia.');
        }

        $request->validate([
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'descripcion' => 'nullable|string',
        ]);

        $datos = [
            'descripcion' => $request->descripcion,
            'estado' => 'evidenciado',
            'fecha_proxima' => now()
                ->addDays($tratamientoReporte->frecuencia_dias ?? 1)
                ->toDateString(),
        ];

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')
                ->store('tratamientos_reportes', 'public');
        }

        $tratamientoReporte->update($datos);

        $reporte = $tratamientoReporte->reporteProblema;

        $reporte->update([
            'estado' => 'en_revision',
        ]);

        return redirect()->route('reporte-problemas.show', $reporte)
            ->with('success', 'Evidencia del tratamiento registrada correctamente.');
    }

    public function aplicarTratamiento(Request $request, ReporteProblema $reporteProblema)
    {
        $request->validate([
            'id_tratamiento' => 'required|exists:tratamientos,id',
            'fecha_aplicacion' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'observaciones' => 'nullable|string',
        ]);

        $data = $request->only(['id_tratamiento', 'fecha_aplicacion', 'observaciones']);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('tratamientos', 'public');
        }

        $data['estado'] = 'aplicado';

        $reporteProblema->seguimientoTratamientos()->create($data);

        return redirect()->back()
            ->with('success', 'Aplicación de tratamiento registrada correctamente.');
    }

    public function edit(ReporteProblema $reporteProblema)
{
    if (auth()->user()->rol !== 'admin') {
        abort(403, 'No tienes permiso para editar reportes.');
    }

    $reporteProblema->load([
        'adopcion.planta',
        'problema',
    ]);

    $problemas = Problema::all();

    return view('reporte_problemas.edit', compact('reporteProblema', 'problemas'));
}

public function update(Request $request, ReporteProblema $reporteProblema)
{
    if (auth()->user()->rol !== 'admin') {
        abort(403, 'No tienes permiso para actualizar reportes.');
    }

    $request->validate([
        'id_problema' => 'required|exists:problemas,id',
        'descripcion' => 'nullable|string',
        'gravedad' => 'required|in:leve,media,grave',
        'estado' => 'required|in:pendiente,en_revision,resuelto',
    ]);

    $reporteProblema->update([
        'id_problema' => $request->id_problema,
        'descripcion' => $request->descripcion,
        'gravedad' => $request->gravedad,
        'estado' => $request->estado,
    ]);

    return redirect()->route('reporte-problemas.index')
        ->with('success', 'Reporte actualizado correctamente.');
}
public function destroy(ReporteProblema $reporteProblema)
{
    if (auth()->user()->rol !== 'admin') {
        abort(403, 'No tienes permiso para eliminar reportes.');
    }

    $reporteProblema->delete();

    return redirect()->route('reporte-problemas.index')
        ->with('success', 'Reporte eliminado correctamente.');  
}
}