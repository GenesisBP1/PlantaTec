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
            ➕ Nueva zona pública
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6">
                <form action="<?php echo e(route('recomendaciones-zona.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Nombre del lugar *</label>
                        <input type="text" name="nombre_lugar" value="<?php echo e(old('nombre_lugar')); ?>" 
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        <?php $__errorArgs = ['nombre_lugar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Tipo de zona</label>
                        <input type="text" name="tipo_zona" value="<?php echo e(old('tipo_zona')); ?>" 
                               class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Ej: Parque urbano, Jardín botánico...">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Indicaciones</label>
                        <textarea name="indicaciones" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm"
                                  placeholder="Recomendaciones para plantar..."><?php echo e(old('indicaciones')); ?></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Latitud</label>
                            <input type="text" name="latitud" value="<?php echo e(old('latitud')); ?>" 
                                   class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Ej: 25.8792">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Longitud</label>
                            <input type="text" name="longitud" value="<?php echo e(old('longitud')); ?>" 
                                   class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Ej: -97.5044">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Descripción completa</label>
                        <textarea name="descripcion" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm"
                                  placeholder="Información adicional sobre el lugar..."><?php echo e(old('descripcion')); ?></textarea>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="<?php echo e(route('recomendaciones-zona.index')); ?>" class="bg-gray-400 text-white px-4 py-2 rounded-lg">Cancelar</a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Guardar zona</button>
                    </div>
                </form>
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
<?php endif; ?><?php /**PATH C:\Users\1\Herd\plantatec\resources\views/recomendaciones-zona/create.blade.php ENDPATH**/ ?>