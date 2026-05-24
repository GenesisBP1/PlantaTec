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
                <h2 class="pt-header-title">Editar asignación</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        /* ========== ESTILOS ESPECÍFICOS PARA EL FORMULARIO DE EDICIÓN DE ASIGNACIÓN ========== */
        .pt-form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
        }
        .pt-form-card {
            background: #ffffff;
            border-radius: 1.25rem;
            border: 1px solid #f3f4f6;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            padding: 2rem;
        }
        .pt-form-intro {
            margin-bottom: 1.5rem;
        }
        .pt-form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
        }
        .pt-form-subtitle {
            color: #6b7280;
            margin-top: 0.25rem;
        }
        .pt-form-grid {
            display: grid;
            gap: 1.5rem;
        }
        .pt-form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .pt-form-group input[type="text"],
        .pt-form-group input[type="number"],
        .pt-form-group select,
        .pt-form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
            background-color: #f9fafb;
        }
        .pt-form-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }
    </style>


    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">Actualizar cuidado asignado</h3>
                    <p class="pt-form-subtitle">
                        Modifica la planta, cuidado, frecuencia e instrucciones.
                    </p>
                </div>

                <form action="<?php echo e(route('planta-cuidados.update', $asignacion)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Planta</label>
                            <select name="id_planta" required>
                                <option value="">Selecciona una planta</option>
                                <?php $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($planta->id); ?>" <?php echo e(old('id_planta', $asignacion->id_planta) == $planta->id ? 'selected' : ''); ?>>
                                        <?php echo e($planta->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Cuidado</label>
                            <select name="id_cuidado" required>
                                <option value="">Selecciona un cuidado</option>
                                <?php $__currentLoopData = $cuidados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuidado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cuidado->id); ?>" <?php echo e(old('id_cuidado', $asignacion->id_cuidado) == $cuidado->id ? 'selected' : ''); ?>>
                                        <?php echo e($cuidado->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Frecuencia (días)</label>
                            <input type="number" name="frecuencia" min="1" value="<?php echo e(old('frecuencia', $asignacion->frecuencia)); ?>" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Instrucciones</label>
                            <textarea name="instrucciones_esp" rows="4"><?php echo e(old('instrucciones_esp', $asignacion->instrucciones_esp)); ?></textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Evidencia (opcional)</label>
                            <input type="text" name="evidencia" value="<?php echo e(old('evidencia', $asignacion->evidencia)); ?>">
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">Actualizar</button>
                        <a href="<?php echo e(route('planta-cuidados.index')); ?>" class="pt-btn pt-btn-dark">Cancelar</a>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/planta_cuidados/edit.blade.php ENDPATH**/ ?>