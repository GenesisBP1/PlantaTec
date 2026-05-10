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


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('adopciones', AdopcionController::class);
    Route::resource('registro-cuidados', RegistroCuidadoController::class);
    Route::resource('notificaciones', NotificacionController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/catalogo-plantas', [CatalogoPlantaController::class, 'index'])
    ->name('catalogo.plantas');

    Route::get('/catalogo-plantas/{planta}', [CatalogoPlantaController::class, 'show'])
    ->name('catalogo.plantas.show');

    Route::post('/catalogo-plantas/{planta}/adoptar', [CatalogoPlantaController::class, 'adoptar'])
    ->name('catalogo.plantas.adoptar');

Route::get('/reporte-problemas/create', [ReporteProblemaController::class, 'create'])
    ->name('reporte-problemas.create');

Route::post('/reporte-problemas', [ReporteProblemaController::class, 'store'])
    ->name('reporte-problemas.store');

Route::get('/reporte-problemas/{reporteProblema}', [ReporteProblemaController::class, 'show'])
    ->name('reporte-problemas.show');
    
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('plantas', PlantaController::class);
    Route::resource('ubicaciones', UbicacionController::class);
    Route::resource('cuidados', CuidadoController::class);
    Route::resource('problemas', ProblemaController::class);
    Route::resource('planta-cuidados', PlantaCuidadoController::class);
    Route::resource('tratamientos', TratamientoController::class);
    Route::resource('recomendaciones-zona', RecomendacionZonaController::class);
    Route::resource('recomendaciones-cuidado', RecomendacionCuidadoController::class);
    Route::get('/reportes-problemas', [ReporteProblemaController::class, 'index'])
    ->name('reporte-problemas.index');
    Route::put('/reportes-problemas/{reporteProblema}/resolver', [ReporteProblemaController::class, 'resolver'])
    ->name('reporte-problemas.resolver');
});

require __DIR__.'/auth.php';