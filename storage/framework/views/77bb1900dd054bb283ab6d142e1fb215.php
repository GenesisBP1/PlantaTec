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
                <p class="pt-header-label">Detalle de adopción</p>
                <h2 class="pt-header-title"><?php echo e($adopcion->planta->nombre); ?></h2>
                <p class="pt-header-subtitle">
                    Información general de la planta adoptada · <?php echo e(now()->format('d M Y')); ?>

                </p>
            </div>

            <div class="pt-header-actions">
                <a href="<?php echo e(route('adopciones.index')); ?>" class="pt-btn pt-btn-light">
                    Volver
                </a>

                <a href="<?php echo e(route('registro-cuidados.create', ['adopcion_id' => $adopcion->id])); ?>" class="pt-btn pt-btn-green">
                    Registrar cuidado
                </a>
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
                                <a href="<?php echo e(route('registro-cuidados.create', ['adopcion_id' => $adopcion->id])); ?>" class="pt-btn pt-btn-green">
                                    Registrar cuidado general
                                </a>

                                <a href="<?php echo e(route('reporte-problemas.create', ['adopcion_id' => $adopcion->id])); ?>" class="pt-btn pt-btn-red">
                                    Reportar problema
                                </a>
                            </div>
                        </div>

                    </div>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/adopciones/index.blade.php ENDPATH**/ ?>