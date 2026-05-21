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
            Diagnóstico y tratamiento sugerido
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <?php if(session('success')): ?>
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-green-700">
                    <?php echo e($reporteProblema->adopcion->planta->nombre); ?>

                </h3>

                <p class="mt-2">
                    <strong>Problema:</strong>
                    <?php echo e($reporteProblema->problema->nombre); ?>

                </p>

                <p class="mt-2">
                    <strong>Gravedad:</strong>
                    <?php echo e(ucfirst($reporteProblema->gravedad)); ?>

                </p>

                <p class="mt-2">
                    <strong>Descripción:</strong>
                    <?php echo e($reporteProblema->descripcion ?? 'Sin descripción'); ?>

                </p>

                <?php if($reporteProblema->imagen): ?>
                    <div class="mt-4">
                        <img src="<?php echo e(asset('storage/' . $reporteProblema->imagen)); ?>"
                             alt="Problema reportado"
                             class="w-64 rounded shadow">
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-xl font-semibold mb-4">
                    Tratamientos sugeridos
                </h4>

                <?php $__empty_1 = true; $__currentLoopData = $tratamientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tratamiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="border-b py-4">
                        <p>
                            <strong>Descripción:</strong>
                            <?php echo e($tratamiento->descripcion ?? 'Sin descripción'); ?>

                        </p>

                        <p class="mt-2">
                            <strong>Indicaciones:</strong>
                            <?php echo e($tratamiento->indicaciones ?? 'Sin indicaciones'); ?>

                        </p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500">
                        No se encontraron tratamientos para este problema y planta.
                    </p>
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
<?php endif; ?><?php /**PATH C:\Users\1\Herd\plantatec\resources\views/reporte_problemas/show.blade.php ENDPATH**/ ?>