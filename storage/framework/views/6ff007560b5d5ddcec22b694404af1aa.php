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
                <p class="pt-header-label">Reportes de problemas</p>
                <h2 class="pt-header-title">Editar reporte</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">
            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de reporte</p>
                    <h3 class="pt-form-title">
                        <?php echo e($reporteProblema->adopcion->planta->nombre ?? 'Planta no disponible'); ?>

                    </h3>
                    <p class="pt-form-subtitle">
                        Modifica el diagnóstico, gravedad o estado del reporte.
                    </p>
                </div>

                <form action="<?php echo e(route('reporte-problemas.update', $reporteProblema)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="pt-form-grid">
                        <div class="pt-form-group full">
                            <label>Problema</label>
                            <select name="id_problema" required>
                                <?php $__currentLoopData = $problemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($problema->id); ?>"
                                        <?php echo e(old('id_problema', $reporteProblema->id_problema) == $problema->id ? 'selected' : ''); ?>>
                                        <?php echo e($problema->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Gravedad</label>
                            <select name="gravedad" required>
                                <option value="leve" <?php echo e(old('gravedad', $reporteProblema->gravedad) == 'leve' ? 'selected' : ''); ?>>Leve</option>
                                <option value="media" <?php echo e(old('gravedad', $reporteProblema->gravedad) == 'media' ? 'selected' : ''); ?>>Media</option>
                                <option value="grave" <?php echo e(old('gravedad', $reporteProblema->gravedad) == 'grave' ? 'selected' : ''); ?>>Grave</option>
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Estado</label>
                            <select name="estado" required>
                                <option value="pendiente" <?php echo e(old('estado', $reporteProblema->estado) == 'pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                                <option value="en_revision" <?php echo e(old('estado', $reporteProblema->estado) == 'en_revision' ? 'selected' : ''); ?>>En revisión</option>
                                <option value="resuelto" <?php echo e(old('estado', $reporteProblema->estado) == 'resuelto' ? 'selected' : ''); ?>>Resuelto</option>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="4"><?php echo e(old('descripcion', $reporteProblema->descripcion)); ?></textarea>
                        </div>
                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">
                            Actualizar
                        </button>

                        <a href="<?php echo e(route('reporte-problemas.index')); ?>" class="pt-btn pt-btn-dark">
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/reporte_problemas/edit.blade.php ENDPATH**/ ?>