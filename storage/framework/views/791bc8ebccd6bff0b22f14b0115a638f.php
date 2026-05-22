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
                <p class="pt-header-label">Zonas públicas</p>
                <h2 class="pt-header-title">Detalle de zona pública</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title"><?php echo e($zona->nombre_lugar); ?></h3>
                    <p class="pt-form-subtitle">
                        Información completa de la zona recomendada.
                    </p>
                </div>

                <div class="pt-detail-grid">

                    <div class="pt-detail-item">
                        <strong>Tipo de zona</strong>
                        <span><?php echo e($zona->tipo_zona ?? 'Sin tipo registrado'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Latitud</strong>
                        <span><?php echo e($zona->latitud ?? 'No registrada'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Longitud</strong>
                        <span><?php echo e($zona->longitud ?? 'No registrada'); ?></span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span><?php echo e($zona->descripcion ?? 'Sin descripción registrada'); ?></span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Indicaciones</strong>
                        <span><?php echo e($zona->indicaciones ?? 'Sin indicaciones registradas'); ?></span>
                    </div>

                </div>

                <div class="pt-form-actions">
                    <a href="<?php echo e(route('recomendaciones-zona.edit', $zona)); ?>" class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="<?php echo e(route('recomendaciones-zona.index')); ?>" class="pt-btn pt-btn-dark">
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/recomendaciones-zona/show.blade.php ENDPATH**/ ?>