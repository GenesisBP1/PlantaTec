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
                <h2 class="pt-header-title">Detalle de asignación</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        * {
            box-sizing: border-box;
        }

        .pt-page {
            background: #f6f8f5;
            min-height: calc(100vh - 80px);
            padding: 3rem 1rem 4rem;
        }

        .pt-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .pt-form-container {
            max-width: 960px;
            margin: 0 auto;
        }

        /* HEADER */

        .pt-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .pt-header-label {
            font-size: 0.75rem;
            font-weight: 900;
            color: #16a34a;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            margin: 0 0 0.35rem;
        }

        .pt-header-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: #111827;
            margin: 0;
            line-height: 1.2;
        }

        /* CARD */

        .pt-form-card {
            background: #ffffff;
            border: 1px solid #dbe7df;
            border-radius: 1.5rem;
            box-shadow: 0 16px 38px rgba(0, 32, 0, 0.08);
            padding: 2rem;
        }

        .pt-form-intro {
            margin-bottom: 1.75rem;
        }

        .pt-form-title {
            font-size: 2rem;
            font-weight: 900;
            color: #1e3a2f;
            margin: 0 0 0.45rem;
            line-height: 1.15;
        }

        .pt-form-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
            margin: 0;
            line-height: 1.5;
        }

        /* BLOQUE DE IMAGEN */

        .pt-plant-preview {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            background: linear-gradient(135deg, #f0fdf4, #ffffff);
            border: 1px solid #d1fae5;
            border-radius: 1.25rem;
            padding: 1.25rem;
            margin-bottom: 1.75rem;
        }

        .pt-plant-image {
            width: 150px;
            height: 150px;
            border-radius: 1.25rem;
            overflow: hidden;
            background: #e2f0e6;
            border: 1px solid #dbe7df;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pt-plant-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pt-plant-info {
            flex: 1;
            min-width: 0;
        }

        .pt-plant-label {
            font-size: 0.75rem;
            font-weight: 900;
            color: #16a34a;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin: 0 0 0.35rem;
        }

        .pt-plant-name {
            font-size: 1.4rem;
            font-weight: 900;
            color: #111827;
            margin: 0;
        }

        .pt-plant-text {
            color: #6b7280;
            font-size: 0.9rem;
            margin-top: 0.35rem;
        }

        /* DETALLES */

        .pt-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .pt-detail-item {
            background: #f8fbf8;
            border: 1px solid #dbe7df;
            border-radius: 1.1rem;
            padding: 1.1rem 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .pt-detail-item.full {
            grid-column: 1 / -1;
        }

        .pt-detail-item strong {
            font-size: 0.75rem;
            font-weight: 900;
            color: #166534;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .pt-detail-item span {
            color: #374151;
            font-size: 0.95rem;
            line-height: 1.6;
            position: static !important;
            width: auto !important;
            height: auto !important;
        }

        /* BOTONES */

        .pt-form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 0.8rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .pt-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.25rem;
            border-radius: 0.9rem;
            font-size: 0.875rem;
            font-weight: 900;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: 0.2s ease;
        }

        .pt-btn-yellow {
            background: #16a34a;
            color: #ffffff;
        }

        .pt-btn-yellow:hover {
            background: #15803d;
            transform: translateY(-1px);
        }

        .pt-btn-dark {
            background: #475569;
            color: #ffffff;
        }

        .pt-btn-dark:hover {
            background: #334155;
            transform: translateY(-1px);
        }

        /* NAV / SPAN */

        .pt-navbar {
            background: #ffffff !important;
            border-bottom: 1px solid #e5e7eb !important;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        }

        .pt-logo,
        .pt-nav-link,
        .pt-user-btn,
        .pt-user-text p {
            color: #111827 !important;
        }

        .pt-nav-link:hover,
        .pt-nav-link.active {
            background: #f0fdf4 !important;
            color: #15803d !important;
        }

        .pt-navbar span,
        .pt-page span,
        .pt-form-card span,
        .pt-header span,
        .pt-user-text span,
        .pt-user-info span {
            position: static !important;
            top: auto !important;
            right: auto !important;
            left: auto !important;
            bottom: auto !important;
            width: auto !important;
            height: auto !important;
            min-width: auto !important;
            max-width: none !important;
            line-height: inherit;
        }

        .pt-user-text span,
        .pt-user-info span {
            color: #6b7280 !important;
        }

        /* RESPONSIVE */

        @media (max-width: 768px) {
            .pt-page {
                padding: 2rem 1rem;
            }

            .pt-container,
            .pt-form-container {
                max-width: 100%;
                padding: 0;
            }

            .pt-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .pt-form-card {
                padding: 1.25rem;
                border-radius: 1.25rem;
            }

            .pt-form-title {
                font-size: 1.6rem;
            }

            .pt-plant-preview {
                flex-direction: column;
                align-items: flex-start;
            }

            .pt-plant-image {
                width: 100%;
                height: 220px;
            }

            .pt-detail-grid {
                grid-template-columns: 1fr;
            }

            .pt-detail-item.full {
                grid-column: auto;
            }

            .pt-form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .pt-btn {
                width: 100%;
            }

            .pt-desktop-menu,
            .pt-user-menu {
                display: none !important;
            }

            .pt-mobile-btn {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }

            .pt-mobile-menu {
                display: block;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">Asignación de cuidado</h3>
                    <p class="pt-form-subtitle">
                        Información completa de la relación entre planta y cuidado.
                    </p>
                </div>

                <?php
                    $imagenUrl = 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=400&fit=crop';

                    if ($asignacion->planta && $asignacion->planta->imagen) {
                        if (filter_var($asignacion->planta->imagen, FILTER_VALIDATE_URL)) {
                            $imagenUrl = $asignacion->planta->imagen;
                        } elseif (file_exists(public_path('storage/' . $asignacion->planta->imagen))) {
                            $imagenUrl = asset('storage/' . $asignacion->planta->imagen);
                        }
                    }
                ?>

                <div class="pt-plant-preview">
                    <div class="pt-plant-image">
                        <img src="<?php echo e($imagenUrl); ?>" alt="<?php echo e($asignacion->planta->nombre ?? 'Planta'); ?>">
                    </div>

                    <div class="pt-plant-info">
                        <p class="pt-plant-label">Planta asignada</p>
                        <h4 class="pt-plant-name">
                            <?php echo e($asignacion->planta->nombre ?? 'Sin planta registrada'); ?>

                        </h4>
                        <p class="pt-plant-text">
                            Cuidado relacionado:
                            <strong><?php echo e($asignacion->cuidado->nombre ?? 'Sin cuidado registrado'); ?></strong>
                        </p>
                    </div>
                </div>

                <div class="pt-detail-grid">

                    <div class="pt-detail-item">
                        <strong>Planta</strong>
                        <span><?php echo e($asignacion->planta->nombre ?? 'Sin planta registrada'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Cuidado</strong>
                        <span><?php echo e($asignacion->cuidado->nombre ?? 'Sin cuidado registrado'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Frecuencia</strong>
                        <span><?php echo e($asignacion->frecuencia ?? 'Sin frecuencia registrada'); ?> días</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Instrucciones</strong>
                        <span><?php echo e($asignacion->instrucciones_esp ?? 'Sin instrucciones registradas'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Evidencia requerida</strong>
                        <span><?php echo e($asignacion->evidencia ?? 'No especificada'); ?></span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Fecha de registro</strong>
                        <span>
                            <?php echo e($asignacion->created_at ? $asignacion->created_at->format('d/m/Y') : 'Sin fecha'); ?>

                        </span>
                    </div>

                </div>

                <div class="pt-form-actions">
                    <a href="<?php echo e(route('planta-cuidados.edit', $asignacion)); ?>" class="pt-btn pt-btn-yellow">Editar</a>
                    <a href="<?php echo e(route('planta-cuidados.index')); ?>" class="pt-btn pt-btn-dark">Volver</a>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/planta_cuidados/show.blade.php ENDPATH**/ ?>