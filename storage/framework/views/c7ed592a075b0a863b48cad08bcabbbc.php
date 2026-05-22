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
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Adopciones</p>
                <h2 class="pt-header-title">Detalle de adopción</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-card pt-adoption-detail">
                <div class="pt-card-header">
                    <h3 class="pt-card-title"><?php echo e($adopcion->planta->nombre); ?></h3>
                </div>

                <div class="pt-card-body">
                    <div class="pt-adoption-flex">
                        <div class="pt-adoption-image">
                            <?php
                                $imagenUrl = 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&fit=crop';

                                if ($adopcion->planta->imagen) {
                                    if (filter_var($adopcion->planta->imagen, FILTER_VALIDATE_URL)) {
                                        $imagenUrl = $adopcion->planta->imagen;
                                    } elseif (file_exists(public_path('storage/' . $adopcion->planta->imagen))) {
                                        $imagenUrl = asset('storage/' . $adopcion->planta->imagen);
                                    }
                                }
                            ?>

                            <img src="<?php echo e($imagenUrl); ?>" alt="<?php echo e($adopcion->planta->nombre); ?>">
                        </div>

                        <div class="pt-adoption-info">
                            <div class="pt-info-grid-small">
                                <div class="pt-info-box">
                                    <strong>Especie</strong>
                                    <span><?php echo e($adopcion->planta->especie); ?></span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Estado adopción</strong>
                                    <span><?php echo e(ucfirst($adopcion->estado_adopcion)); ?></span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Ubicación</strong>
                                    <span><?php echo e($adopcion->ubicacion->nombre_lugar ?? 'No registrada'); ?></span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Fecha adopción</strong>
                                    <span><?php echo e(\Carbon\Carbon::parse($adopcion->fecha_adopcion)->format('d/m/Y')); ?></span>
                                </div>
                            </div>

                            <p class="pt-description">
                                <strong>Descripción:</strong>
                                <?php echo e($adopcion->planta->descripcion ?? 'Sin descripción.'); ?>

                            </p>

                            <div class="pt-btn-group">
                                <a href="<?php echo e(route('registro-cuidados.create', ['adopcion_id' => $adopcion->id])); ?>"
                                   class="pt-btn pt-btn-green">
                                    Registrar cuidado general
                                </a>

                                <a href="<?php echo e(route('reporte-problemas.create', ['adopcion_id' => $adopcion->id])); ?>"
                                   class="pt-btn pt-btn-red">
                                    Reportar problema
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Plan de cuidados</h3>
                </div>

                <div class="pt-card-body">
                    <?php
                        $cuidadosAsignados = $adopcion->planta->plantaCuidados;
                    ?>

                    <?php if($cuidadosAsignados->count()): ?>
                        <div class="pt-table-wrapper">
                            <table class="pt-table">
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
                                                <strong><?php echo e($pc->cuidado->nombre); ?></strong>

                                                <?php if($pc->instrucciones_esp): ?>
                                                    <br>
                                                    <small><?php echo e(Str::limit($pc->instrucciones_esp, 80)); ?></small>
                                                <?php endif; ?>
                                            </td>

                                            <td>Cada <?php echo e($pc->frecuencia); ?> días</td>

                                            <td><?php echo e($proximaFecha->format('d/m/Y')); ?></td>

                                            <td>
                                                <a href="<?php echo e(route('registro-cuidados.create', [
                                                    'adopcion_id' => $adopcion->id,
                                                    'cuidado_id' => $pc->id
                                                ])); ?>"
                                                   class="pt-small-btn green">
                                                    Registrar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="pt-muted">No hay cuidados asignados a esta planta.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Historial de cuidados</h3>
                </div>

                <div class="pt-card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $adopcion->registrosCuidados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="pt-history-item">
                            <div class="pt-history-content">
                                <p class="pt-history-title">
                                    <?php echo e($registro->plantaCuidado->cuidado->nombre); ?>


                                    <span>
                                        <?php echo e(\Carbon\Carbon::parse($registro->fecha)->format('d/m/Y H:i')); ?>

                                    </span>
                                </p>

                                <p class="pt-history-text">
                                    <?php echo e($registro->descripcion ?? 'Sin descripción'); ?>

                                </p>

                                <?php if($registro->estado_observado): ?>
                                    <p class="pt-muted">
                                        Estado observado: <?php echo e($registro->estado_observado); ?>

                                    </p>
                                <?php endif; ?>
                            </div>

                            <?php if($registro->imagen): ?>
                                <img src="<?php echo e(asset('storage/' . $registro->imagen)); ?>"
                                     class="pt-history-image"
                                     alt="Evidencia de cuidado">
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="pt-muted">Aún no se han registrado cuidados.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Problemas reportados</h3>
                </div>

                <div class="pt-card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $adopcion->reportesProblemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reporte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="pt-problem-item">
                            <div class="pt-problem-header">
                                <div>
                                    <strong><?php echo e($reporte->problema->nombre); ?></strong>

                                    <span class="pt-status-badge
                                        <?php if($reporte->estado === 'activo'): ?> active
                                        <?php elseif($reporte->estado === 'en_revision'): ?> review
                                        <?php else: ?> solved <?php endif; ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $reporte->estado))); ?>

                                    </span>
                                </div>

                                <span class="pt-muted">
                                    Gravedad: <?php echo e(ucfirst($reporte->gravedad)); ?>

                                </span>
                            </div>

                            <p class="pt-history-text">
                                <?php echo e($reporte->descripcion ?? 'Sin descripción'); ?>

                            </p>

                            <a href="<?php echo e(route('reporte-problemas.show', $reporte)); ?>"
                               class="pt-link green">
                                Ver diagnóstico
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="pt-muted">No hay problemas reportados.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Tratamientos aplicados</h3>
                </div>

                <div class="pt-card-body">
                    <p class="pt-muted">
                        Tratamientos registrados derivados de los problemas reportados.
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
                        <div class="pt-table-wrapper">
                            <table class="pt-table">
                                <thead>
                                    <tr>
                                        <th>Problema</th>
                                        <th>Tratamiento</th>
                                        <th>Frecuencia</th>
                                        <th>Fecha registro</th>
                                        <th>Estado</th>
                                        <th>Evidencia</th>
                                        <th>Acción</th>
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
                                                <small>
                                                    Gravedad: <?php echo e(ucfirst($tratamientoReporte->reporte_original->gravedad ?? 'Sin gravedad')); ?>

                                                </small>
                                            </td>

                                            <td>
                                                <strong>
                                                    <?php echo e($tratamientoReporte->tratamiento->descripcion ?? 'Tratamiento sin descripción'); ?>

                                                </strong>

                                                <?php if($tratamientoReporte->descripcion): ?>
                                                    <br>
                                                    <small>
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
                                                <span class="pt-status-badge
                                                    <?php if($estadoTratamiento === 'pendiente'): ?> review
                                                    <?php elseif($estadoTratamiento === 'evidenciado'): ?> solved
                                                    <?php elseif($estadoTratamiento === 'resuelto'): ?> solved
                                                    <?php else: ?> review <?php endif; ?>">
                                                    <?php echo e(ucfirst($tratamientoReporte->estado ?? 'pendiente')); ?>

                                                </span>
                                            </td>

                                            <td>
                                                <?php if($tratamientoReporte->imagen): ?>
                                                    <img src="<?php echo e(asset('storage/' . $tratamientoReporte->imagen)); ?>"
                                                         class="pt-table-image"
                                                         alt="Evidencia del tratamiento">
                                                <?php else: ?>
                                                    <span class="pt-muted">Sin imagen</span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <a href="<?php echo e(route('reporte-problemas.show', $tratamientoReporte->reporte_original->id)); ?>"
                                                   class="pt-small-btn green">
                                                    Ver diagnóstico
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="pt-empty center">
                            No hay tratamientos asignados todavía.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
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