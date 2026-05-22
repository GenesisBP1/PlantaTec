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
                <h2 class="pt-header-title">Nueva zona pública</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Registrar zona pública</h3>
                    <p class="pt-form-subtitle">
                        Agrega una zona recomendada para plantar o ubicar adopciones públicas.
                    </p>
                </div>

                <?php if($errors->any()): ?>
                    <div class="pt-alert-error">
                        <p><strong>Revisa los campos del formulario:</strong></p>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('recomendaciones-zona.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Nombre del lugar *</label>
                            <input
                                type="text"
                                name="nombre_lugar"
                                value="<?php echo e(old('nombre_lugar')); ?>"
                                required
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Tipo de zona</label>
                            <input
                                type="text"
                                name="tipo_zona"
                                value="<?php echo e(old('tipo_zona')); ?>"
                                placeholder="Ej: Parque urbano, Jardín botánico..."
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Indicaciones</label>
                            <textarea
                                name="indicaciones"
                                rows="3"
                                placeholder="Recomendaciones para plantar..."
                            ><?php echo e(old('indicaciones')); ?></textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Latitud</label>
                            <input
                                type="text"
                                name="latitud"
                                value="<?php echo e(old('latitud')); ?>"
                                placeholder="Ej: 25.8792"
                            >
                        </div>

                        <div class="pt-form-group">
                            <label>Longitud</label>
                            <input
                                type="text"
                                name="longitud"
                                value="<?php echo e(old('longitud')); ?>"
                                placeholder="Ej: -97.5044"
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción completa</label>
                            <textarea
                                name="descripcion"
                                rows="4"
                                placeholder="Información adicional sobre el lugar..."
                            ><?php echo e(old('descripcion')); ?></textarea>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="<?php echo e(route('recomendaciones-zona.index')); ?>" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>

                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar zona
                        </button>
                    </div>
                </form>
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/recomendaciones-zona/create.blade.php ENDPATH**/ ?>