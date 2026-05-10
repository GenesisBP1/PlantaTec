<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Problema;
use App\Models\ReporteProblema;
use App\Models\Tratamiento;
use Illuminate\Http\Request;

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

        return redirect()->route('reporte-problemas.show', $reporte)
            ->with('success', 'Problema reportado correctamente.');
    }

    public function show(ReporteProblema $reporteProblema)
    {
        $reporteProblema->load('adopcion.planta', 'problema');

        if ($reporteProblema->adopcion->id_usuario !== auth()->id() && auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $tratamientos = Tratamiento::where('id_problema', $reporteProblema->id_problema)
            ->where(function ($query) use ($reporteProblema) {
                $query->where('id_planta', $reporteProblema->adopcion->id_planta)
                      ->orWhereNull('id_planta');
            })
            ->get();

        return view('reporte_problemas.show', compact('reporteProblema', 'tratamientos'));
    }

    public function index()
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $reportes = ReporteProblema::with(['adopcion.usuario', 'adopcion.planta', 'problema'])
            ->latest()
            ->get();

        return view('reporte_problemas.index', compact('reportes'));
    }

    public function resolver(ReporteProblema $reporteProblema)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }
    
        $reporteProblema->update([
            'estado' => 'resuelto'
        ]);
    
        return redirect()->route('reporte-problemas.index')
            ->with('success', 'Problema marcado como resuelto.');
    }
}