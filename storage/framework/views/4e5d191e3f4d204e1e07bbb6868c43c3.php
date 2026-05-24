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
                <p class="pt-header-label">Tratamientos</p>
                <h2 class="pt-header-title">Detalle del tratamiento</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        /* ========== ESTILOS ESPECÍFICOS PARA DETALLE DE TRATAMIENTO ========== */
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
        .pt-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
        .pt-detail-item {
            background: #f8faf6;
            border: 1px solid #dbe7df;
            border-radius: 1.2rem;
            padding: 1rem 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }
        .pt-detail-item.full {
            grid-column: 1 / -1;
        }
        .pt-detail-item strong {
            color: #166534;
            font-size: 0.85rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .pt-detail-item span {
            color: #374151;
            font-size: 0.95rem;
            line-height: 1.5;
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
        @media (max-width: 768px) {
            .pt-detail-grid { grid-template-columns: 1fr; }
            .pt-form-card { padding: 1.25rem; }
            .pt-form-title { font-size: 1.6rem; }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">Tratamiento registrado</h3>
                    <p class="pt-form-subtitle">
                        Información completa del tratamiento registrado.
                    </p>
                </div>

                <div class="pt-detail-grid">
                    <div class="pt-detail-item">
                        <strong>Problema</strong>
                        <span><?php echo e($tratamiento->problema->nombre ?? 'Sin problema'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Planta</strong>
                        <span><?php echo e($tratamiento->planta->nombre ?? 'General'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Cuidado</strong>
                        <span><?php echo e($tratamiento->cuidado->nombre ?? 'Sin cuidado específico'); ?></span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span><?php echo e($tratamiento->descripcion ?? 'Sin descripción'); ?></span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Indicaciones</strong>
                        <span><?php echo e($tratamiento->indicaciones ?? 'Sin indicaciones'); ?></span>
                    </div>
                </div>

                <div class="pt-form-actions">
                    <a href="<?php echo e(route('tratamientos.edit', $tratamiento)); ?>" class="pt-btn pt-btn-yellow">Editar</a>
                    <a href="<?php echo e(route('tratamientos.index')); ?>" class="pt-btn pt-btn-dark">Volver</a>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/tratamientos/show.blade.php ENDPATH**/ ?>