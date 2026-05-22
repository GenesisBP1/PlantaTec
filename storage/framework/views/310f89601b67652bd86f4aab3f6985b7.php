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
                <p class="pt-header-label">Problemas</p>
                <h2 class="pt-header-title">Detalle del problema</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title"><?php echo e($problema->nombre); ?></h3>
                    <p class="pt-form-subtitle">
                        Información completa del problema registrado.
                    </p>
                </div>

                <div class="pt-detail-grid">

                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span><?php echo e($problema->descripcion ?? 'Sin descripción'); ?></span>
                    </div>

                    <?php if($problema->imagen): ?>
    <?php
        $imagenProblema = filter_var($problema->imagen, FILTER_VALIDATE_URL)
            ? $problema->imagen
            : asset('storage/' . $problema->imagen);
    ?>

    <div class="pt-detail-item full">
        <strong>Imagen</strong>
        <img src="<?php echo e($imagenProblema); ?>"
             alt="<?php echo e($problema->nombre); ?>"
             class="pt-problem-image">
    </div>
<?php endif; ?>

                </div>

                <div class="pt-form-actions">
                    <a href="<?php echo e(route('problemas.edit', $problema)); ?>"
                       class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="<?php echo e(route('problemas.index')); ?>"
                       class="pt-btn pt-btn-dark">
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/problemas/show.blade.php ENDPATH**/ ?>