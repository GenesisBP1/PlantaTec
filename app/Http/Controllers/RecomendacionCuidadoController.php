<?php

namespace App\Http\Controllers;

use App\Models\RecomendacionCuidado;
use Illuminate\Http\Request;

class RecomendacionCuidadoController extends Controller
{
    
    public function index()
    {
        $recomendaciones = RecomendacionCuidado::with(['adopcion.planta', 'plantaCuidado.cuidado'])
            ->latest()
            ->get();

        return view('recomendaciones_cuidado.index', compact('recomendaciones'));
    }

    public function destroy(RecomendacionCuidado $recomendacionCuidado)
    {
        $recomendacionCuidado->delete();

        return redirect()->route('recomendaciones-cuidado.index')
            ->with('success', 'Recomendación eliminada correctamente.');
    }
}