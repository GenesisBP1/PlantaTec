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
                <p class="pt-header-label">Notificaciones</p>
                <h2 class="pt-header-title">Mis notificaciones</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        /* Espacio para que no quede pegado al nav/header */
        .pt-navbar {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    /* ... */
}
.pt-nav-link {
    color: #1f2937; /* cambiar a otro color */
}
.pt-nav-link:hover,
.pt-nav-link.active {
    background: #dcfce7;
    color: #16a34a; /* verde más intenso */
}
span{
    color: #000b06;
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    margin-left: 0.5rem;
}
        .pt-page {
            padding: 2.5rem 0 3.5rem;
            background: #f6f8f5;
            min-height: calc(100vh - 80px);
        }

        .pt-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .pt-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .pt-header-label {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #16a34a;
            margin-bottom: 0.25rem;
        }

        .pt-header-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: #111827;
            margin: 0;
        }

        .pt-alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            padding: 1rem 1.2rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .pt-notifications-list {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .pt-notification-card {
            background: #ffffff;
            border-radius: 1.4rem;
            border-left: 6px solid #16a34a;
            box-shadow: 0 10px 22px rgba(0,32,0,0.08);
            transition: 0.2s ease;
            overflow: hidden;
        }

        .pt-notification-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 28px rgba(0,0,0,0.08);
        }

        .pt-notification-card.general {
            background: #fffbeb;
            border-color: #f59e0b;
        }

        .pt-notification-card.danger {
            background: #fef2f2;
            border-color: #dc2626;
        }

        .pt-notification-card.warning {
            background: #fff7ed;
            border-color: #ea580c;
        }

        .pt-notification-card.today {
            background: #fff7ed;
            border-color: #f97316;
        }

        .pt-notification-card.info {
            background: #eff6ff;
            border-color: #2563eb;
        }

        .pt-notification-content {
            padding: 1.4rem;
            display: flex;
            justify-content: space-between;
            gap: 1.5rem;
            align-items: flex-start;
        }

        .pt-notification-main {
            flex: 1;
        }

        .pt-notification-top {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
    margin-bottom: 0.7rem;
}

.pt-notification-top h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 900;
    color: #1f2937;
}

.pt-notification-card .pt-notification-badge {
    position: static !important;
    top: auto !important;
    right: auto !important;
    min-width: auto;
    height: auto;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.35rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 800;
    margin-left: 0;
}
        .pt-notification-badge.general {
            background: #fde68a;
            color: #92400e;
        }

        .pt-notification-badge.danger {
            background: #fecaca;
            color: #991b1b;
        }

        .pt-notification-badge.warning,
        .pt-notification-badge.today {
            background: #fdba74;
            color: #9a3412;
        }

        .pt-notification-badge.info {
            background: #bfdbfe;
            color: #1d4ed8;
        }

        .pt-notification-message {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 0.75rem;
        }

        .pt-notification-time {
            font-size: 0.8rem;
            color: #6b7280;
            margin: 0;
        }

        .pt-notification-actions {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            min-width: 150px;
        }

        .pt-small-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 800;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .pt-small-btn.green {
            background: #055c25ec;
            color: #ffffff;
        }

        .pt-small-btn.green:hover {
            background: #11f921bb;
        }

        .pt-small-btn.blue {
            background: #0c7c2cf4;
            color: #ffffff;
        }

        .pt-small-btn.blue:hover {
            background: #1cc53ba2;
        }

        .pt-empty-state {
            background: #ffffff;
            padding: 3rem 2rem;
            text-align: center;
            border-radius: 1.5rem;
            box-shadow: 0 10px 22px rgba(0,32,0,0.08);
        }

        .pt-empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .pt-empty-state h3 {
            margin-bottom: 0.5rem;
            color: #1f2937;
        }

        .pt-empty-state p {
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .pt-page {
                padding: 2rem 0;
            }

            .pt-container {
                padding: 0 1rem;
            }

            .pt-notification-content {
                flex-direction: column;
            }

            .pt-notification-actions {
                width: 100%;
                min-width: unset;
            }

            .pt-small-btn {
                width: 100%;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container">

            <?php if(session('success')): ?>
                <div class="pt-alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="pt-notifications-list">
                <?php $__empty_1 = true; $__currentLoopData = $notificaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $tipo = $notificacion->tipo ?? 'general';
                        $tipoClase = 'general';

                        if ($tipo === 'tratamiento_atraso') {
                            $tipoClase = 'danger';
                        } elseif ($tipo === 'atraso') {
                            $tipoClase = 'warning';
                        } elseif ($tipo === 'hoy') {
                            $tipoClase = 'today';
                        } elseif ($tipo === 'proximo') {
                            $tipoClase = 'info';
                        }

                        preg_match('/para tu planta ([^.]+)/', $notificacion->mensaje, $matches);
                        $nombrePlanta = $matches[1] ?? null;
                        $adopcion = null;

                        if ($nombrePlanta) {
                            $adopcion = \App\Models\Adopcion::where('id_usuario', auth()->id())
                                ->whereHas('planta', function($q) use ($nombrePlanta) {
                                    $q->where('nombre', 'like', $nombrePlanta);
                                })
                                ->first();
                        }
                    ?>

                    <div class="pt-notification-card <?php echo e($tipoClase); ?>">
                        <div class="pt-notification-content">
                            <div class="pt-notification-main">
                                <div class="pt-notification-top">
                                    <h3><?php echo e($notificacion->titulo); ?></h3>

                                    <span class="pt-notification-badge <?php echo e($tipoClase); ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $tipo))); ?>

                                    </span>
                                </div>

                                <p class="pt-notification-message">
                                    <?php echo e($notificacion->mensaje); ?>

                                </p>

                                <p class="pt-notification-time">
                                    <?php echo e($notificacion->fecha_envio->diffForHumans()); ?>

                                </p>
                            </div>

                            <div class="pt-notification-actions">
                                <?php if(!$notificacion->leida): ?>
                                    <form action="<?php echo e(route('notificaciones.update', $notificacion)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>

                                        <button type="submit" class="pt-small-btn green">
                                            Marcar leída
                                        </button>
                                    </form>
                                <?php endif; ?>

                                <?php if($adopcion): ?>
                                    <a href="<?php echo e(route('adopciones.show', $adopcion)); ?>" class="pt-small-btn blue">
                                        Ver planta
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="pt-empty-state">
                        <div class="pt-empty-icon">🔔</div>
                        <h3>No tienes notificaciones</h3>
                        <p>Aquí aparecerán recordatorios y avisos importantes.</p>
                    </div>
                <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/notificaciones/index.blade.php ENDPATH**/ ?>