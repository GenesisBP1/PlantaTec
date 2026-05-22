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
                <p class="pt-header-label">Plantas</p>
                <h2 class="pt-header-title">Editar planta</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">Actualizar planta</h3>
                    <p class="pt-form-subtitle">
                        Modifica la información de la planta registrada.
                    </p>
                </div>

                <form action="<?php echo e(route('plantas.update', $planta)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Nombre</label>
                            <input type="text"
                                   name="nombre"
                                   value="<?php echo e($planta->nombre); ?>"
                                   required>
                        </div>

                        <div class="pt-form-group">
                            <label>Especie</label>
                            <input type="text"
                                   name="especie"
                                   value="<?php echo e($planta->especie); ?>"
                                   required>
                        </div>

                        <div class="pt-form-group">
                            <label>Tipo de zona</label>
                            <input type="text"
                                   name="tipo_zona"
                                   value="<?php echo e($planta->tipo_zona); ?>">
                        </div>

                        <div class="pt-form-group">
                            <label>Imagen</label>
                            <input type="text"
                                   name="imagen"
                                   value="<?php echo e($planta->imagen); ?>">
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="4"><?php echo e($planta->descripcion); ?></textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Estado</label>
                            <select name="estado">
                                <option value="saludable" <?php echo e($planta->estado == 'saludable' ? 'selected' : ''); ?>>
                                    Saludable
                                </option>

                                <option value="observacion" <?php echo e($planta->estado == 'observacion' ? 'selected' : ''); ?>>
                                    Observación
                                </option>

                                <option value="problema" <?php echo e($planta->estado == 'problema' ? 'selected' : ''); ?>>
                                    Problema
                                </option>

                                <option value="tratamiento" <?php echo e($planta->estado == 'tratamiento' ? 'selected' : ''); ?>>
                                    Tratamiento
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">
                            Actualizar
                        </button>

                        <a href="<?php echo e(route('plantas.index')); ?>" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/plantas/edit.blade.php ENDPATH**/ ?>