<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Problema;
use App\Models\ReporteProblema;
use App\Models\Tratamiento;
use App\Models\TratamientoReporte;
use Illuminate\Http\Request;
use App\Models\SeguimientoTratamiento;


class ReporteProblemaController extends Controller
{
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

        /*
         * Crear tratamientos pendientes automáticamente
         * según el problema reportado y la planta adoptada.
         */
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

    public function index()
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403, 'No tienes permiso para ver los reportes.');
        }

        $reportes = ReporteProblema::with([
            'adopcion.usuario',
            'adopcion.planta',
            'problema',
        ])
            ->latest()
            ->get();

        return view('reporte_problemas.index', compact('reportes'));
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

    /*
     * El problema no se marca como resuelto automáticamente.
     * Se mantiene en revisión para que el usuario siga subiendo evidencias
     * según la frecuencia del tratamiento.
     */
    $reporte->update([
        'estado' => 'en_revision',
    ]);

    return redirect()->route('reporte-problemas.show', $reporte)
        ->with('success', 'Evidencia del tratamiento registrada correctamente. La próxima evidencia ya fue programada.');
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

    return redirect()->back()->with('success', 'Aplicación de tratamiento registrada correctamente.');
}
}