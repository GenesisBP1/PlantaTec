<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlantaController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\CuidadoController;
use App\Http\Controllers\RegistroCuidadoController;
use App\Http\Controllers\ProblemaController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\RecomendacionZonaController;
use App\Http\Controllers\RecomendacionCuidadoController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogoPlantaController;
use App\Http\Controllers\PlantaCuidadoController;
use App\Http\Controllers\ReporteProblemaController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\Api\AdopcionMapaController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Models\Adopcion;

Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('adopciones', AdopcionController::class);
    Route::resource('registro-cuidados', RegistroCuidadoController::class);
    Route::resource('notificaciones', NotificacionController::class);

    // Rutas del Mapa Interactivo
    Route::get('/mapa', [MapaController::class, 'index'])->name('mapa.index');
    Route::get('/api/mapa/ubicaciones', [MapaController::class, 'getUbicaciones'])->name('api.mapa.ubicaciones');
    Route::get('/api/mapa/zonas-recomendadas', [MapaController::class, 'getZonasRecomendadas'])->name('api.mapa.zonas-recomendadas');
    Route::post('/api/mapa/ubicaciones', [MapaController::class, 'guardarUbicacion'])->name('api.mapa.guardar');
    Route::get('/api/mapa/ubicaciones-cercanas', [MapaController::class, 'getUbicacionesCercanas'])->name('api.mapa.cercanas');
    Route::put('/api/mapa/ubicaciones/{ubicacion}/privacidad', [MapaController::class, 'updatePrivacidad'])->name('api.mapa.privacidad');
    Route::delete('/api/mapa/ubicaciones/{ubicacion}', [MapaController::class, 'destroy'])->name('api.mapa.destroy');

    // Rutas de adopciones con ubicación (API)
    Route::post('/api/adopciones/crear-con-ubicacion', [AdopcionMapaController::class, 'crearAdopcionConUbicacion'])->name('api.adopciones.crear-con-ubicacion');
    Route::get('/api/adopciones/en-mapa', [AdopcionMapaController::class, 'getAdopcionesEnMapa'])->name('api.adopciones.en-mapa');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Catálogo de plantas
    Route::get('/catalogo-plantas', [CatalogoPlantaController::class, 'index'])->name('catalogo.plantas');
    Route::get('/catalogo-plantas/{planta}', [CatalogoPlantaController::class, 'show'])->name('catalogo.plantas.show');
    Route::post('/catalogo-plantas/{planta}/adoptar', [CatalogoPlantaController::class, 'adoptar'])->name('catalogo.plantas.adoptar');

    // Búsqueda (autocompletado)
    Route::get('/catalogo-plantas/buscar', [CatalogoPlantaController::class, 'buscar'])->name('catalogo.plantas.buscar');

    // Reporte de problemas
    Route::get('/reporte-problemas/create', [ReporteProblemaController::class, 'create'])->name('reporte-problemas.create');
    Route::post('/reporte-problemas', [ReporteProblemaController::class, 'store'])->name('reporte-problemas.store');
    Route::get('/reporte-problemas/{reporteProblema}', [ReporteProblemaController::class, 'show'])->name('reporte-problemas.show');


    Route::post('/reporte-problemas/{reporteProblema}/aplicar-tratamiento', [ReporteProblemaController::class, 'aplicarTratamiento'])
    ->name('reporte-problemas.aplicar-tratamiento');
    // Evidencia de tratamientos de reportes
    Route::post('/tratamientos-reportes/{tratamientoReporte}/evidencia', [ReporteProblemaController::class, 'subirEvidenciaTratamiento'])
        ->name('tratamientos-reportes.evidencia');

    // API para obtener cuidados de una adopción
    Route::get('/api/plantas-cuidados/{adopcionId}', function ($adopcionId) {
        $adopcion = Adopcion::findOrFail($adopcionId);
        $cuidados = $adopcion->planta->plantaCuidados()->with('cuidado')->get()->map(function($pc) {
            return [
                'id' => $pc->id,
                'nombre' => $pc->cuidado->nombre,
                'frecuencia' => $pc->frecuencia
            ];
        });
        return response()->json($cuidados);
    })->name('api.plantas-cuidados');
});

// Rutas exclusivas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('plantas', PlantaController::class);
    Route::resource('ubicaciones', UbicacionController::class);
    Route::resource('cuidados', CuidadoController::class);
    Route::resource('problemas', ProblemaController::class);
    Route::resource('planta-cuidados', PlantaCuidadoController::class);
    Route::resource('tratamientos', TratamientoController::class);
    Route::resource('recomendaciones-zona', RecomendacionZonaController::class);
    Route::resource('recomendaciones-cuidado', RecomendacionCuidadoController::class);
    Route::get('/reportes-problemas', [ReporteProblemaController::class, 'index'])->name('reporte-problemas.index');
    Route::put('/reportes-problemas/{reporteProblema}/resolver', [ReporteProblemaController::class, 'resolver'])->name('reporte-problemas.resolver');

    // Rutas de administración de usuarios (solo admin)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('usuarios', UsuarioController::class);
    });
});

require __DIR__.'/auth.php';