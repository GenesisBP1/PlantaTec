<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de adopción
        </h2>
     <?php $__env->endSlot(); ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;600;700;800&display=swap');

        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --verde-muy-claro: #f4fbf2;
            --gris-verde: #6f8f7a;
            --blanco: #ffffff;
            --sombra-elevada: 0 20px 35px rgba(0, 0, 0, 0.12);
            --border-radius-card: 28px;
            --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .detalle-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 1rem;
        }

        .card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            box-shadow: var(--sombra-elevada);
            overflow: hidden;
            margin-bottom: 2rem;
            border: 1px solid rgba(100, 140, 110, 0.2);
        }

        .card-header {
            background: linear-gradient(115deg, var(--verde-claro), #eef5ea);
            padding: 1.2rem 2rem;
            border-bottom: 1px solid rgba(75, 130, 90, 0.2);
        }

        .card-header h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--verde-profundo);
            margin: 0;
        }

        .card-body {
            padding: 2rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-item {
            background: var(--verde-muy-claro);
            padding: 0.8rem 1rem;
            border-radius: 20px;
        }

        .info-item strong {
            color: var(--verde-medio);
            display: block;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .info-item span {
            font-weight: 600;
            font-size: 1rem;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .btn-primary {
            background: linear-gradient(105deg, var(--verde-medio), #3e8a5a);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 60px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: scale(0.97);
            box-shadow: 0 8px 18px rgba(43, 120, 64, 0.3);
        }

        .btn-danger {
            background: linear-gradient(105deg, #dc2626, #b91c1c);
        }

        .tabla-cuidados {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-cuidados th,
        .tabla-cuidados td {
            padding: 0.8rem;
            text-align: left;
            border-bottom: 1px solid #e2ecd9;
            vertical-align: top;
        }

        .tabla-cuidados th {
            background: var(--verde-claro);
            font-weight: 700;
            color: var(--verde-profundo);
        }

        .badge-estado {
            display: inline-block;
            padding: 0.2rem 0.8rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-activo { background: #fee2e2; color: #b91c1c; }
        .badge-revision { background: #fef3c7; color: #b45309; }
        .badge-resuelto { background: #dcfce7; color: #15803d; }

        .btn-diagnostico {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            background: #16a34a;
            color: white;
            padding: 0.55rem 1rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-diagnostico:hover {
            background: #15803d;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .card-body { padding: 1.2rem; }

            .tabla-cuidados,
            .tabla-cuidados thead,
            .tabla-cuidados tbody,
            .tabla-cuidados tr,
            .tabla-cuidados td,
            .tabla-cuidados th {
                display: block;
            }

            .tabla-cuidados tr {
                margin-bottom: 1rem;
                border: 1px solid #e2ecd9;
                border-radius: 20px;
                padding: 0.5rem;
            }

            .tabla-cuidados td {
                border: none;
                padding: 0.3rem 0.5rem;
            }

            .tabla-cuidados th {
                display: none;
            }
        }
    </style>

    <div class="py-8">
        <div class="detalle-container">

            
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-leaf"></i> <?php echo e($adopcion->planta->nombre); ?></h3>
                </div>

                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <strong>Especie</strong>
                            <span><?php echo e($adopcion->planta->especie); ?></span>
                        </div>

                        <div class="info-item">
                            <strong>Estado adopción</strong>
                            <span><?php echo e(ucfirst($adopcion->estado_adopcion)); ?></span>
                        </div>

                        <div class="info-item">
                            <strong>Ubicación</strong>
                            <span><?php echo e($adopcion->ubicacion->nombre_lugar ?? 'No registrada'); ?></span>
                        </div>

                        <div class="info-item">
                            <strong>Fecha adopción</strong>
                            <span><?php echo e(\Carbon\Carbon::parse($adopcion->fecha_adopcion)->format('d/m/Y')); ?></span>
                        </div>
                    </div>

                    <p>
                        <strong>Descripción:</strong>
                        <?php echo e($adopcion->planta->descripcion ?? 'Sin descripción.'); ?>

                    </p>

                    <div class="btn-group">
                        <a href="<?php echo e(route('registro-cuidados.create', ['adopcion_id' => $adopcion->id])); ?>" class="btn-primary">
                            <i class="fas fa-camera"></i> Registrar cuidado general
                        </a>

                        <a href="<?php echo e(route('reporte-problemas.create', ['adopcion_id' => $adopcion->id])); ?>" class="btn-primary btn-danger">
                            <i class="fas fa-exclamation-triangle"></i> Reportar problema
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-calendar-alt"></i> 📋 Plan de cuidados</h3>
                </div>

                <div class="card-body">
                    <?php
                        $cuidadosAsignados = $adopcion->planta->plantaCuidados;
                    ?>

                    <?php if($cuidadosAsignados->count()): ?>
                        <table class="tabla-cuidados">
                            <thead>
                                <tr>
                                    <th>Cuidado</th>
                                    <th>Frecuencia</th>
                                    <th>Próxima fecha sugerida</th>
                                    <th>Registrar</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $cuidadosAsignados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $ultimoRegistro = $adopcion->registrosCuidados()
                                            ->where('id_planta_cuidado', $pc->id)
                                            ->latest()
                                            ->first();

                                        if ($ultimoRegistro) {
                                            $proximaFecha = \Carbon\Carbon::parse($ultimoRegistro->fecha)->addDays($pc->frecuencia);
                                        } else {
                                            $proximaFecha = \Carbon\Carbon::parse($adopcion->fecha_adopcion)->addDays($pc->frecuencia);
                                        }
                                    ?>

                                    <tr>
                                        <td>
                                            <strong><?php echo e($pc->cuidado->nombre); ?></strong><br>
                                            <small class="text-gray-500">
                                                <?php echo e($pc->instrucciones_esp ?? 'Sin instrucciones adicionales'); ?>

                                            </small>
                                        </td>

                                        <td>Cada <?php echo e($pc->frecuencia); ?> días</td>

                                        <td><?php echo e($proximaFecha->format('d/m/Y')); ?></td>

                                        <td>
                                            <a href="<?php echo e(route('registro-cuidados.create', ['adopcion_id' => $adopcion->id, 'cuidado_id' => $pc->id])); ?>"
                                               class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                                <i class="fas fa-check-circle"></i> Registrar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-gray-500">No hay cuidados asignados a esta planta.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-history"></i> Historial de cuidados</h3>
                </div>

                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $adopcion->registrosCuidados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border-b border-gray-100 py-3 flex flex-wrap gap-3 items-start">
                            <div class="flex-1">
                                <p>
                                    <strong><?php echo e($registro->plantaCuidado->cuidado->nombre); ?></strong>
                                    – <?php echo e(\Carbon\Carbon::parse($registro->fecha)->format('d/m/Y H:i')); ?>

                                </p>

                                <p class="text-gray-600 text-sm">
                                    <?php echo e($registro->descripcion ?? 'Sin descripción'); ?>

                                </p>

                                <?php if($registro->estado_observado): ?>
                                    <p class="text-xs text-gray-500">
                                        Estado observado: <?php echo e($registro->estado_observado); ?>

                                    </p>
                                <?php endif; ?>
                            </div>

                            <?php if($registro->imagen): ?>
                                <div>
                                    <img src="<?php echo e(asset('storage/' . $registro->imagen)); ?>"
                                         class="w-24 h-24 object-cover rounded-lg shadow"
                                         alt="Imagen del cuidado">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-500">Aún no se han registrado cuidados.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-bug"></i> Problemas reportados</h3>
                </div>

                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $adopcion->reportesProblemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reporte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border-b border-gray-100 py-3">
                            <p>
                                <strong><?php echo e($reporte->problema->nombre); ?></strong>
                                <span class="badge-estado
                                    <?php if($reporte->estado === 'activo'): ?> badge-activo
                                    <?php elseif($reporte->estado === 'en_revision'): ?> badge-revision
                                    <?php else: ?> badge-resuelto <?php endif; ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $reporte->estado))); ?>

                                </span>
                            </p>

                            <p>Gravedad: <?php echo e(ucfirst($reporte->gravedad)); ?></p>
                            <p><?php echo e($reporte->descripcion ?? 'Sin descripción'); ?></p>

                            <div class="mt-2">
                                <a href="<?php echo e(route('reporte-problemas.show', $reporte)); ?>" class="text-blue-600 text-sm hover:underline">
                                    Ver diagnóstico
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-500">No hay problemas reportados.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="card">
                <div class="card-header">
                    <h3>Tratamientos</h3>
                </div>

                <div class="card-body">
                    <p class="text-gray-500 mb-6">
                        Aquí se muestran los tratamientos registrados derivados de los problemas reportados en esta planta.
                    </p>

                    <?php
                        $tratamientosReporte = $adopcion->reportesProblemas
                            ->flatMap(function ($reporte) {
                                return $reporte->tratamientosReportes->map(function ($tratamientoReporte) use ($reporte) {
                                    $tratamientoReporte->reporte_original = $reporte;
                                    return $tratamientoReporte;
                                });
                            });
                    ?>

                    <?php if($tratamientosReporte->count() > 0): ?>
                        <div class="overflow-x-auto">
                            <table class="tabla-cuidados">
                                <thead>
                                    <tr>
                                        <th>Problema</th>
                                        <th>Tratamiento</th>
                                        <th>Frecuencia</th>
                                        <th>Fecha de registro</th>
                                        <th>Estado</th>
                                        <th>Evidencia</th>
                                        <th style="min-width: 150px;">Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $tratamientosReporte; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tratamientoReporte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $estadoTratamiento = strtolower($tratamientoReporte->estado ?? 'pendiente');
                                            $fechaRegistro = $tratamientoReporte->updated_at ?? $tratamientoReporte->created_at;
                                        ?>

                                        <tr>
                                            <td>
                                                <strong>
                                                    <?php echo e($tratamientoReporte->reporte_original->problema->nombre ?? 'Problema no disponible'); ?>

                                                </strong>
                                                <br>
                                                <small class="text-gray-500">
                                                    Gravedad: <?php echo e(ucfirst($tratamientoReporte->reporte_original->gravedad ?? 'Sin gravedad')); ?>

                                                </small>
                                            </td>

                                            <td>
                                                <strong>
                                                    <?php echo e($tratamientoReporte->tratamiento->descripcion ?? 'Tratamiento sin descripción'); ?>

                                                </strong>

                                                <?php if($tratamientoReporte->descripcion): ?>
                                                    <br>
                                                    <small class="text-blue-700">
                                                        Último registro: <?php echo e($tratamientoReporte->descripcion); ?>

                                                    </small>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                Cada <?php echo e($tratamientoReporte->frecuencia_dias ?? 1); ?> días
                                            </td>

                                            <td>
                                                <?php if($fechaRegistro): ?>
                                                    <?php echo e(\Carbon\Carbon::parse($fechaRegistro)->format('d/m/Y')); ?>

                                                <?php else: ?>
                                                    Sin fecha
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <span class="badge-estado
                                                    <?php if($estadoTratamiento === 'pendiente'): ?> badge-revision
                                                    <?php elseif($estadoTratamiento === 'evidenciado'): ?> badge-resuelto
                                                    <?php elseif($estadoTratamiento === 'resuelto'): ?> badge-resuelto
                                                    <?php else: ?> badge-revision <?php endif; ?>">
                                                    <?php echo e(ucfirst($tratamientoReporte->estado ?? 'pendiente')); ?>

                                                </span>
                                            </td>

                                            <td>
                                                <?php if($tratamientoReporte->imagen): ?>
                                                    <img src="<?php echo e(asset('storage/' . $tratamientoReporte->imagen)); ?>"
                                                         alt="Evidencia del tratamiento"
                                                         class="w-20 h-20 object-cover rounded-xl border shadow-sm">
                                                <?php else: ?>
                                                    <span class="text-gray-500">Sin imagen</span>
                                                <?php endif; ?>
                                            </td>

                                            <td style="min-width: 150px;">
                                                <a href="<?php echo e(route('reporte-problemas.show', $tratamientoReporte->reporte_original->id)); ?>"
                                                   class="btn-diagnostico">
                                                    Ver diagnóstico
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="bg-gray-50 rounded-xl p-6 text-center text-gray-500">
                            No hay tratamientos asignados todavía.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/adopciones/show.blade.php ENDPATH**/ ?>