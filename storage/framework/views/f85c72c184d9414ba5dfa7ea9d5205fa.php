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
            Diagnóstico del problema
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-green-700 mb-2">
                    <?php echo e($reporteProblema->problema->nombre); ?>

                </h3>
                <p class="text-gray-600">Gravedad: <?php echo e(ucfirst($reporteProblema->gravedad)); ?> - Estado: <?php echo e(ucfirst($reporteProblema->estado)); ?></p>
                <p class="mt-2"><?php echo e($reporteProblema->descripcion ?? 'Sin descripción adicional.'); ?></p>
                <?php if($reporteProblema->imagen): ?>
                    <div class="mt-4">
                        <img src="<?php echo e(asset('storage/' . $reporteProblema->imagen)); ?>" class="w-48 rounded shadow" alt="Evidencia del problema">
                    </div>
                <?php endif; ?>
            </div>

            
            <?php
                $tratamiento = $reporteProblema->tratamientoSugerido();
            ?>

            <?php if($tratamiento): ?>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                    <h4 class="text-xl font-bold text-green-800">Tratamiento sugerido</h4>
                    <p class="mt-2"><strong>Descripción:</strong> <?php echo e($tratamiento->descripcion); ?></p>
                    <p><strong>Indicaciones:</strong> <?php echo e($tratamiento->indicaciones); ?></p>
                    <p><strong>Frecuencia:</strong> Cada <?php echo e($tratamiento->frecuencia_dias); ?> días</p>

                    <form action="<?php echo e(route('reporte-problemas.aplicar-tratamiento', $reporteProblema)); ?>" method="POST" enctype="multipart/form-data" class="mt-4">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id_tratamiento" value="<?php echo e($tratamiento->id); ?>">
                        <div class="mb-4">
                            <label class="block font-medium">Fecha de aplicación</label>
                            <input type="datetime-local" name="fecha_aplicacion" value="<?php echo e(now()->format('Y-m-d\TH:i')); ?>" required class="w-full border rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium">Imagen (evidencia)</label>
                            <input type="file" name="imagen" accept="image/*">
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium">Observaciones</label>
                            <textarea name="observaciones" rows="2" class="w-full border rounded"></textarea>
                        </div>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Registrar aplicación</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                    <p class="text-yellow-800">No hay un tratamiento sugerido para este problema en esta planta.</p>
                </div>
            <?php endif; ?>

            
            <?php
                $aplicaciones = $reporteProblema->seguimientoTratamientos()->with('tratamiento')->latest()->get();
            ?>
            <?php if($aplicaciones->count()): ?>
                <div class="bg-white shadow rounded-lg p-6">
                    <h4 class="text-xl font-bold">Historial de aplicaciones</h4>
                    <div class="space-y-4 mt-4">
                        <?php $__currentLoopData = $aplicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aplicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border-b pb-3">
                                <p><strong>Aplicado el:</strong> <?php echo e($aplicacion->fecha_aplicacion->format('d/m/Y H:i')); ?></p>
                                <p><strong>Tratamiento:</strong> <?php echo e($aplicacion->tratamiento->descripcion); ?></p>
                                <?php if($aplicacion->observaciones): ?><p><?php echo e($aplicacion->observaciones); ?></p><?php endif; ?>
                                <?php if($aplicacion->imagen): ?>
                                    <img src="<?php echo e(asset('storage/' . $aplicacion->imagen)); ?>" class="w-32 rounded shadow mt-2">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/reporte_problemas/show.blade.php ENDPATH**/ ?>