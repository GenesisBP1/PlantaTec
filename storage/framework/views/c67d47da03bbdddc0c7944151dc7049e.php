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
                <h2 class="pt-header-title">Asignar cuidado a planta</h2>
            </div>
            <div class="pt-header-actions">
                <a href="<?php echo e(route('planta-cuidados.index')); ?>" class="pt-btn pt-btn-light">Volver al listado</a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        /* ========== ESTILOS EXCLUSIVOS PARA EL FORMULARIO ========== */
        .pt-form-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .pt-form-card {
            background: #ffffff;
            border-radius: 1.75rem;
            border: 1px solid #dbe7df;
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
            padding: 2rem;
            transition: all 0.2s ease;
        }
        .pt-form-card:hover {
            box-shadow: 0 20px 35px rgba(0, 32, 0, 0.12);
        }
        .pt-form-intro {
            margin-bottom: 1.8rem;
            border-left: 4px solid #2b7840;
            padding-left: 1.2rem;
        }
        .pt-form-title {
            font-size: 1.8rem;
            font-weight: 900;
            color: #1e3a2f;
            margin: 0.4rem 0;
        }
        .pt-form-subtitle {
            color: #6b7280;
            font-size: 0.9rem;
        }
        .pt-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        .pt-form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .pt-form-group.full {
            grid-column: 1 / -1;
        }
        .pt-form-group label {
            font-weight: 800;
            color: #374151;
            font-size: 0.92rem;
        }
        .pt-form-group input,
        .pt-form-group select,
        .pt-form-group textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 1rem;
            border: 1px solid #cde0d4;
            background: #ffffff;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
        }
        .pt-form-group input:focus,
        .pt-form-group select:focus,
        .pt-form-group textarea:focus {
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
        }
        .pt-alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .pt-alert-error ul {
            margin: 0.5rem 0 0 1.5rem;
        }
        .pt-form-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .pt-btn-dark {
            background: #475569;
            color: white;
        }
        .pt-btn-dark:hover {
            background: #334155;
        }
        @media (max-width: 768px) {
            .pt-form-grid {
                grid-template-columns: 1fr;
            }
            .pt-form-card {
                padding: 1.25rem;
            }
            .pt-form-title {
                font-size: 1.5rem;
            }
            .pt-form-actions {
                justify-content: stretch;
            }
            .pt-form-actions .pt-btn {
                flex: 1;
                text-align: center;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container pt-form-container">
            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Asignar cuidado</h3>
                    <p class="pt-form-subtitle">
                        Relaciona una planta con un cuidado, frecuencia e instrucciones específicas.
                    </p>
                </div>

                <?php if($errors->any()): ?>
                    <div class="pt-alert-error">
                        <strong>Revisa los campos del formulario:</strong>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('planta-cuidados.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Planta <span class="pt-badge green" style="font-size:0.7rem;">*</span></label>
                            <select name="id_planta" required>
                                <option value="">Selecciona una planta</option>
                                <?php $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($planta->id); ?>" <?php echo e(old('id_planta') == $planta->id ? 'selected' : ''); ?>>
                                        <?php echo e($planta->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Cuidado <span class="pt-badge green" style="font-size:0.7rem;">*</span></label>
                            <select name="id_cuidado" required>
                                <option value="">Selecciona un cuidado</option>
                                <?php $__currentLoopData = $cuidados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuidado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cuidado->id); ?>" <?php echo e(old('id_cuidado') == $cuidado->id ? 'selected' : ''); ?>>
                                        <?php echo e($cuidado->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Frecuencia (días) <span class="pt-badge green" style="font-size:0.7rem;">*</span></label>
                            <input type="number" name="frecuencia" value="<?php echo e(old('frecuencia')); ?>" placeholder="Ejemplo: 3" min="1" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Instrucciones</label>
                            <textarea name="instrucciones_esp" rows="4" placeholder="Ejemplo: regar sin encharcar"><?php echo e(old('instrucciones_esp')); ?></textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Evidencia (opcional)</label>
                            <input type="text" name="evidencia" value="<?php echo e(old('evidencia')); ?>" placeholder="Texto o referencia">
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="<?php echo e(route('planta-cuidados.index')); ?>" class="pt-btn pt-btn-dark">Cancelar</a>
                        <button type="submit" class="pt-btn pt-btn-green">Guardar</button>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/planta_cuidados/create.blade.php ENDPATH**/ ?>