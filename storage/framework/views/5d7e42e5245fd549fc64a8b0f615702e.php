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
                <h2 class="pt-header-title">Editar problema</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        /* ========== ESTILOS ESPECÍFICOS DEL FORMULARIO DE PROBLEMAS ========== */
        /* (El layout base ya trae reset, navbar, colores, etc.) */
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
        }
        .pt-form-intro {
            margin-bottom: 1.8rem;
        }
        .pt-form-title {
            font-size: 2rem;
            font-weight: 900;
            color: #1e3a2f;
            margin: 0.4rem 0;
        }
        .pt-form-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
        }
        .pt-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
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
            transition: 0.2s;
        }
        .pt-form-group input:focus,
        .pt-form-group select:focus,
        .pt-form-group textarea:focus {
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
        }
        .pt-form-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .pt-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1rem;
            border-radius: 0.9rem;
            font-size: 0.875rem;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .pt-btn-yellow { background: #d97706; color: white; }
        .pt-btn-yellow:hover { background: #b45309; }
        .pt-btn-dark { background: #475569; color: white; }
        .pt-btn-dark:hover { background: #334155; }
        .pt-alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 1rem;
            border-radius: 1rem;
            margin: 1rem 0;
        }
        .pt-alert-error ul {
            margin: 0;
            padding-left: 1.2rem;
        }
        @media (max-width: 768px) {
            .pt-form-grid { grid-template-columns: 1fr; }
            .pt-form-card { padding: 1.25rem; }
            .pt-form-title { font-size: 1.6rem; }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">Actualizar problema</h3>
                    <p class="pt-form-subtitle">
                        Modifica la información del problema registrado.
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

                <form action="<?php echo e(route('problemas.update', $problema)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="pt-form-grid">
                        <div class="pt-form-group full">
                            <label>Nombre</label>
                            <input type="text" name="nombre" value="<?php echo e(old('nombre', $problema->nombre)); ?>" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="5"><?php echo e(old('descripcion', $problema->descripcion)); ?></textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Imagen (opcional)</label>
                            <input type="text" name="imagen" value="<?php echo e(old('imagen', $problema->imagen)); ?>" placeholder="URL o referencia">
                        </div>
                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">Actualizar</button>
                        <a href="<?php echo e(route('problemas.index')); ?>" class="pt-btn pt-btn-dark">Cancelar</a>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/problemas/edit.blade.php ENDPATH**/ ?>