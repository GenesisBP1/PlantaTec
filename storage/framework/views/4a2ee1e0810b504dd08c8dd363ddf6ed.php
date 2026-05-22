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
                                    <a href="<?php echo e(route('adopciones.show', $adopcion)); ?>"
                                       class="pt-small-btn blue">
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/notificaciones/index.blade.php ENDPATH**/ ?>