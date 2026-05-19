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
    
     <?php $__env->endSlot(); ?>

    <style>
        .noti-page {
            position: relative;
            overflow: hidden;
            padding: 0 0 3rem;
            background: transparent;
        }

        .noti-container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 1rem;
            position: relative;
            z-index: 1;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 28px;
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.08);
            padding: 1.6rem;
            margin-bottom: 1.5rem;
        }

        .hero-top {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            background: #e8f7ee;
            color: #166534;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.01em;
            margin-bottom: 0.8rem;
        }

        .hero-title {
            font-size: clamp(1.7rem, 3vw, 2.6rem);
            line-height: 1.1;
            font-weight: 900;
            color: #123524;
            margin: 0;
        }

        .hero-text {
            margin-top: 0.7rem;
            max-width: 60ch;
            color: #4b5563;
            font-size: 0.98rem;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(120px, 1fr));
            gap: 0.75rem;
            min-width: min(100%, 300px);
        }

        .stat-chip {
            border-radius: 18px;
            padding: 0.95rem 1rem;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(148, 163, 184, 0.16);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.05);
        }

        .stat-chip strong {
            display: block;
            font-size: 1.55rem;
            line-height: 1;
            color: #0f172a;
            font-weight: 900;
        }

        .stat-chip span {
            display: block;
            margin-top: 0.35rem;
            font-size: 0.84rem;
            color: #64748b;
            font-weight: 600;
        }

        .section-panel {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(148, 163, 184, 0.14);
            border-radius: 26px;
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.06);
            padding: 1.1rem;
            margin-bottom: 1rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 1.1rem;
            font-weight: 900;
            color: #123524;
            margin: 0 0 1rem;
        }

        .section-dot {
            width: 0.7rem;
            height: 0.7rem;
            border-radius: 999px;
            background: #22c55e;
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .section-dot.read {
            background: #60a5fa;
            box-shadow: 0 0 0 6px rgba(96, 165, 250, 0.12);
        }

        .notifications-list {
            display: grid;
            gap: 0.9rem;
        }

        .noti-card {
            background: linear-gradient(180deg, #ffffff 0%, #fbfdfb 100%);
            border-radius: 24px;
            padding: 1rem;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
            display: flex;
            gap: 1rem;
            align-items: stretch;
            border: 1px solid rgba(148, 163, 184, 0.14);
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        }

        .noti-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 34px rgba(15, 23, 42, 0.08);
            border-color: rgba(74, 222, 128, 0.24);
        }

        .noti-card.leida {
            opacity: 0.78;
        }

        .noti-img {
            width: 118px;
            height: 118px;
            border-radius: 20px;
            object-fit: cover;
            background: #e2f0e6;
            flex-shrink: 0;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.7);
        }

        .noti-content {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .noti-title {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            font-size: 1.05rem;
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 0.35rem;
        }

        .noti-msg {
            color: #4b5563;
            margin-bottom: 0.55rem;
            line-height: 1.5;
        }

        .noti-date {
            font-size: 0.82rem;
            color: #64748b;
            font-weight: 600;
        }

        .btn-leida {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
            color: white;
            padding: 0.7rem 1rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 800;
            border: none;
            box-shadow: 0 10px 18px rgba(34, 197, 94, 0.22);
            align-self: center;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            white-space: nowrap;
        }

        .btn-leida:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 24px rgba(34, 197, 94, 0.28);
        }

        .empty-box {
            background: rgba(255, 255, 255, 0.85);
            padding: 1.8rem;
            border-radius: 20px;
            text-align: center;
            color: #64748b;
            border: 1px dashed rgba(148, 163, 184, 0.35);
        }

        @media(max-width: 700px) {
            .hero-card {
                padding: 1.2rem;
            }

            .hero-stats {
                grid-template-columns: 1fr 1fr;
                width: 100%;
            }

            .noti-card {
                flex-direction: column;
                align-items: stretch;
            }

            .noti-img {
                width: 100%;
                height: 210px;
            }

            .btn-leida {
                width: 100%;
                align-self: stretch;
            }
        }
    </style>

    <div class="noti-page">
        <div class="noti-container">

            <div class="hero-card">
                <div class="hero-top">
                    <div>
                        <div class="hero-kicker">Centro de actividad</div>
                        <h1 class="hero-title">Tus notificaciones, ordenadas y al día</h1>
                        <p class="hero-text">
                            Revisa recomendaciones, marca lo que ya leíste y mantén control rápido de lo que necesita tu atención.
                        </p>
                    </div>

                    <div class="hero-stats">
                        <div class="stat-chip">
                            <strong><?php echo e($notificacionesPendientes->count()); ?></strong>
                            <span>Pendientes</span>
                        </div>

                        <div class="stat-chip">
                            <strong><?php echo e($notificacionesLeidas->count()); ?></strong>
                            <span>Leídas</span>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-4 border border-green-200 shadow-sm">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="section-panel">
                <h3 class="section-title">
                    <span class="section-dot"></span>
                    Pendientes
                </h3>

                <div class="notifications-list">
                    <?php $__empty_1 = true; $__currentLoopData = $notificacionesPendientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $planta = $notificacion->recomendacionCuidado?->adopcion?->planta;
                            $imagen = $planta?->imagen;
                        ?>

                        <div class="noti-card">
                            <img class="noti-img"
                                 src="<?php echo e($imagen ? (str_starts_with($imagen, 'http') ? $imagen : asset('storage/' . $imagen)) : 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=300&fit=crop'); ?>"
                                 alt="Planta">

                            <div class="noti-content">
                                <div class="noti-title">
                                    <?php echo e($notificacion->titulo); ?>

                                </div>

                                <p class="noti-msg">
                                    <?php echo e($notificacion->mensaje); ?>

                                </p>

                                <p class="noti-date">
                                    <?php echo e(\Carbon\Carbon::parse($notificacion->fecha_envio)->format('d/m/Y H:i')); ?>

                                </p>
                            </div>

                            <form action="<?php echo e(route('notificaciones.update', $notificacion)); ?>" method="POST" class="self-center">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <button type="submit" class="btn-leida">
                                    Marcar como leída
                                </button>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-box">
                            No tienes notificaciones pendientes.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="section-panel">
                <h3 class="section-title">
                    <span class="section-dot read"></span>
                    Leídas
                </h3>

                <div class="notifications-list">
                    <?php $__empty_1 = true; $__currentLoopData = $notificacionesLeidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $planta = $notificacion->recomendacionCuidado?->adopcion?->planta;
                            $imagen = $planta?->imagen;
                        ?>

                        <div class="noti-card leida">
                            <img class="noti-img"
                                 src="<?php echo e($imagen ? (str_starts_with($imagen, 'http') ? $imagen : asset('storage/' . $imagen)) : 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=300&fit=crop'); ?>"
                                 alt="Planta">

                            <div class="noti-content">
                                <div class="noti-title">
                                    <?php echo e($notificacion->titulo); ?>

                                </div>

                                <p class="noti-msg">
                                    <?php echo e($notificacion->mensaje); ?>

                                </p>

                                <p class="noti-date">
                                    Leída · <?php echo e(\Carbon\Carbon::parse($notificacion->fecha_envio)->format('d/m/Y H:i')); ?>

                                </p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-box">
                            No tienes notificaciones leídas.
                        </div>
                    <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\vluis\Herd\PlantaTec\resources\views/notificaciones/index.blade.php ENDPATH**/ ?>