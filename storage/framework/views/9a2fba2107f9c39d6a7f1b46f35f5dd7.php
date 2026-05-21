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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis notificaciones
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="p-6">
                    <?php if(session('success')): ?>
                        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="space-y-6">
                        <?php $__empty_1 = true; $__currentLoopData = $notificaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                // Determinar colores según el tipo de notificación
                                $tipo = $notificacion->tipo ?? 'general';
                                $bgColor = '';
                                $borderColor = '';
                                $badgeColor = '';

                                if ($tipo === 'tratamiento_atraso') {
                                    $bgColor = 'bg-red-100';
                                    $borderColor = 'border-red-600';
                                    $badgeColor = 'bg-red-200 text-red-800';
                                } elseif ($tipo === 'atraso') {
                                    $bgColor = 'bg-red-50';
                                    $borderColor = 'border-red-400';
                                    $badgeColor = 'bg-red-200 text-red-800';
                                } elseif ($tipo === 'hoy') {
                                    $bgColor = 'bg-orange-50';
                                    $borderColor = 'border-orange-400';
                                    $badgeColor = 'bg-orange-200 text-orange-800';
                                } elseif ($tipo === 'proximo') {
                                    $bgColor = 'bg-blue-50';
                                    $borderColor = 'border-blue-400';
                                    $badgeColor = 'bg-blue-200 text-blue-800';
                                } else {
                                    $bgColor = 'bg-amber-50';
                                    $borderColor = 'border-amber-400';
                                    $badgeColor = 'bg-amber-200 text-amber-800';
                                }

                                // Extraer nombre de planta del mensaje (para el botón "Ver planta")
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

                            <div class="transition-all duration-200 hover:shadow-xl rounded-xl border <?php echo e($borderColor); ?> <?php echo e($bgColor); ?> overflow-hidden">
                                <div class="p-5">
                                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 flex-wrap mb-2">
                                                <h3 class="font-bold text-gray-800 text-lg"><?php echo e($notificacion->titulo); ?></h3>
                                                <span class="text-xs px-2 py-1 rounded-full <?php echo e($badgeColor); ?> font-medium">
                                                    <?php echo e(ucfirst(str_replace('_', ' ', $tipo))); ?>

                                                </span>
                                            </div>
                                            <p class="text-gray-700 text-base leading-relaxed"><?php echo e($notificacion->mensaje); ?></p>
                                            <p class="text-xs text-gray-500 mt-2">
                                                <?php echo e($notificacion->fecha_envio->diffForHumans()); ?>

                                            </p>
                                        </div>
                                        <div class="flex flex-col sm:flex-row gap-2 shrink-0">
                                            <?php if(!$notificacion->leida): ?>
                                                <form action="<?php echo e(route('notificaciones.update', $notificacion)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <button type="submit" style="background-color: #2b7840; color: white;" class="font-semibold py-2 px-5 rounded-full shadow transition whitespace-nowrap hover:opacity-90">
                                                        Marcar leída
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <?php if($adopcion): ?>
                                                <a href="<?php echo e(route('adopciones.show', $adopcion)); ?>" style="background-color: #4c9f6e; color: white;" class="font-semibold py-2 px-5 rounded-full shadow transition whitespace-nowrap hover:opacity-90 text-center">
                                                    Ver planta
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-12 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="mt-2">No tienes notificaciones.</p>
                            </div>
                        <?php endif; ?>
                    </div>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/notificaciones/index.blade.php ENDPATH**/ ?>