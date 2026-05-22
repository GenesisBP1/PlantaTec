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
                <p class="pt-header-label">Recomendaciones</p>
                <h2 class="pt-header-title">Registrar recomendación de cuidado</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Crear recomendación</h3>
                    <p class="pt-form-subtitle">
                        Registra una recomendación de cuidado para una planta adoptada.
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

                <form method="POST" action="<?php echo e(route('recomendaciones-cuidado.store')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Planta adoptada</label>
                            <select name="id_adopcion" required>
                                <option value="">Selecciona una adopción</option>
                                <?php $__currentLoopData = $adopciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adopcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($adopcion->id); ?>" <?php echo e(old('id_adopcion') == $adopcion->id ? 'selected' : ''); ?>>
                                        <?php echo e($adopcion->planta->nombre ?? 'Sin planta'); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Cuidado</label>
                            <select name="id_planta_cuidado" required>
                                <option value="">Selecciona un cuidado</option>
                                <?php $__currentLoopData = $plantaCuidados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pc->id); ?>" <?php echo e(old('id_planta_cuidado') == $pc->id ? 'selected' : ''); ?>>
                                        <?php echo e($pc->planta->nombre ?? 'Sin planta'); ?> - <?php echo e($pc->cuidado->nombre ?? 'Sin cuidado'); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Mensaje</label>
                            <textarea name="mensaje" rows="5" required><?php echo e(old('mensaje')); ?></textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Prioridad</label>
                            <select name="prioridad" required>
                                <option value="baja" <?php echo e(old('prioridad') == 'baja' ? 'selected' : ''); ?>>Baja</option>
                                <option value="media" <?php echo e(old('prioridad') == 'media' ? 'selected' : ''); ?>>Media</option>
                                <option value="alta" <?php echo e(old('prioridad') == 'alta' ? 'selected' : ''); ?>>Alta</option>
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Estado</label>
                            <select name="estado" required>
                                <option value="pendiente" <?php echo e(old('estado') == 'pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                                <option value="revisada" <?php echo e(old('estado') == 'revisada' ? 'selected' : ''); ?>>Revisada</option>
                                <option value="atendida" <?php echo e(old('estado') == 'atendida' ? 'selected' : ''); ?>>Atendida</option>
                            </select>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar
                        </button>

                        <a href="<?php echo e(route('recomendaciones-cuidado.index')); ?>" class="pt-btn pt-btn-dark">
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/recomendaciones_cuidado/create.blade.php ENDPATH**/ ?>