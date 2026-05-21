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
            Recomendaciones de cuidado
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <?php if(session('success')): ?>
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Planta</th>
                            <th class="p-3 text-left">Cuidado</th>
                            <th class="p-3 text-left">Mensaje</th>
                            <th class="p-3 text-left">Prioridad</th>
                            <th class="p-3 text-left">Estado</th>
                            <th class="p-3 text-left">Fecha</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recomendaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recomendacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-t">
                                <td class="p-3">
                                    <?php echo e($recomendacion->adopcion->planta->nombre ?? 'Sin planta'); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e($recomendacion->plantaCuidado->cuidado->nombre ?? 'Sin cuidado'); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e($recomendacion->mensaje); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e($recomendacion->prioridad); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e($recomendacion->estado); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e($recomendacion->fecha_generada); ?>

                                </td>

                                <td class="p-3">
                                    <form action="<?php echo e(route('recomendaciones-cuidado.destroy', $recomendacion)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button class="bg-red-600 text-white px-3 py-1 rounded">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">
                                    No hay recomendaciones generadas.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
<?php endif; ?><?php /**PATH C:\Users\1\Herd\plantatec\resources\views/recomendaciones_cuidado/index.blade.php ENDPATH**/ ?>