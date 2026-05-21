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
            Reportes de problemas
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Usuario</th>
                            <th class="p-3 text-left">Planta</th>
                            <th class="p-3 text-left">Problema</th>
                            <th class="p-3 text-left">Gravedad</th>
                            <th class="p-3 text-left">Estado</th>
                            <th class="p-3 text-left">Fecha</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $reportes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reporte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-t">
                                <td class="p-3">
                                    <?php echo e($reporte->adopcion->usuario->name ?? 'Sin usuario'); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e($reporte->adopcion->planta->nombre ?? 'Sin planta'); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e($reporte->problema->nombre ?? 'Sin problema'); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e(ucfirst($reporte->gravedad)); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e($reporte->estado); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e($reporte->created_at->format('d/m/Y')); ?>

                                </td>

                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="<?php echo e(route('reporte-problemas.show', $reporte)); ?>"
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                            Ver
                                        </a>

                                        <?php if($reporte->estado !== 'resuelto'): ?>
                                            <form action="<?php echo e(route('reporte-problemas.resolver', $reporte)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                                    Resolver
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">
                                    No hay reportes registrados.
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
<?php endif; ?><?php /**PATH C:\Users\1\Herd\plantatec\resources\views/reporte_problemas/index.blade.php ENDPATH**/ ?>