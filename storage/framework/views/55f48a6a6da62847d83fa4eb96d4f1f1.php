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
                <h2 class="pt-header-title">Registrar planta</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Registrar planta</h3>
                    <p class="pt-form-subtitle">
                        Agrega una nueva planta al catálogo del sistema.
                    </p>
                </div>

                <form action="<?php echo e(route('plantas.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" required>
                        </div>

                        <div class="pt-form-group">
                            <label>Especie</label>
                            <input type="text" name="especie" required>
                        </div>

                        <div class="pt-form-group">
                            <label>Tipo de zona</label>
                            <input type="text" name="tipo_zona">
                        </div>

                        <div class="pt-form-group">
                            <label>Imagen</label>
                            <input type="text"
                                   name="imagen"
                                   placeholder="URL o nombre de imagen">
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="4"></textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Estado</label>
                            <select name="estado" required>
                                <option value="saludable">Saludable</option>
                                <option value="observacion">Observación</option>
                                <option value="problema">Problema</option>
                                <option value="tratamiento">Tratamiento</option>
                            </select>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/plantas/create.blade.php ENDPATH**/ ?>