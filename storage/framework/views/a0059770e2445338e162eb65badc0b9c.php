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
                <p class="pt-header-label">Cuidados por planta</p>
                <h2 class="pt-header-title">Detalle de asignación</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">Asignación de cuidado</h3>
                    <p class="pt-form-subtitle">
                        Información completa de la relación entre planta y cuidado.
                    </p>
                </div>

                <div class="pt-detail-grid">

                    <div class="pt-detail-item">
                        <strong>Planta</strong>
                        <span><?php echo e($asignacion->planta->nombre ?? 'Sin planta registrada'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Cuidado</strong>
                        <span><?php echo e($asignacion->cuidado->nombre ?? 'Sin cuidado registrado'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Frecuencia</strong>
                        <span><?php echo e($asignacion->frecuencia ?? 'Sin frecuencia registrada'); ?> días</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Instrucciones</strong>
                        <span><?php echo e($asignacion->instrucciones_esp ?? 'Sin instrucciones registradas'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Evidencia requerida</strong>
                        <span><?php echo e($asignacion->evidencia ?? 'No especificada'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Fecha de registro</strong>
                        <span>
                            <?php echo e($asignacion->created_at ? $asignacion->created_at->format('d/m/Y') : 'Sin fecha'); ?>

                        </span>
                    </div>

                </div>

                <div class="pt-form-actions">
                    <a href="<?php echo e(route('planta-cuidados.edit', $asignacion)); ?>" class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="<?php echo e(route('planta-cuidados.index')); ?>" class="pt-btn pt-btn-dark">
                        Volver
                    </a>
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/planta_cuidados/show.blade.php ENDPATH**/ ?>