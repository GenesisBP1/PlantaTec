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
            Editar Ubicación
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="<?php echo e(route('ubicaciones.update', $ubicacion)); ?>" method="POST" id="formulario-ubicacion">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tipo</label>
                        <select name="tipo" class="w-full border-gray-300 rounded">
                            <option value="publico" <?php echo e($ubicacion->tipo == 'publico' ? 'selected' : ''); ?>>Público</option>
                            <option value="privado" <?php echo e($ubicacion->tipo == 'privado' ? 'selected' : ''); ?>>Privado</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Zona recomendada (opcional)</label>
                        <select name="id_recomendacion_zona" id="zona-select" class="w-full border-gray-300 rounded">
                            <option value="">-- Selecciona una zona para llenar automáticamente --</option>
                            <?php
                                $zonas = \App\Models\RecomendacionZona::orderBy('nombre_lugar')->get();
                            ?>
                            <?php $__empty_1 = true; $__currentLoopData = $zonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($zona->id); ?>">
                                    <?php echo e($zona->nombre_lugar); ?> (<?php echo e($zona->tipo_zona); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option value="" disabled>No hay zonas recomendadas registradas</option>
                            <?php endif; ?>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Si seleccionas una zona, los datos se llenarán automáticamente</p>
                    </div>

                    <!-- MAPA INTERACTIVO -->
                    <div class="mb-6">
                        <label class="block font-medium mb-2">Selecciona ubicación en el mapa</label>
                        <?php if (isset($component)) { $__componentOriginal81c72807132ffb34a5ed67ad325fbcfc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81c72807132ffb34a5ed67ad325fbcfc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.mapa-interactivo','data' => ['id' => 'mapa-ubicacion','canSelectLocation' => true,'showToolbar' => 'true','height' => '400px']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mapa-interactivo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'mapa-ubicacion','canSelectLocation' => true,'showToolbar' => 'true','height' => '400px']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal81c72807132ffb34a5ed67ad325fbcfc)): ?>
<?php $attributes = $__attributesOriginal81c72807132ffb34a5ed67ad325fbcfc; ?>
<?php unset($__attributesOriginal81c72807132ffb34a5ed67ad325fbcfc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal81c72807132ffb34a5ed67ad325fbcfc)): ?>
<?php $component = $__componentOriginal81c72807132ffb34a5ed67ad325fbcfc; ?>
<?php unset($__componentOriginal81c72807132ffb34a5ed67ad325fbcfc); ?>
<?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nombre del lugar</label>
                        <input type="text"
                               name="nombre_lugar"
                               id="nombre-lugar"
                               value="<?php echo e($ubicacion->nombre_lugar); ?>"
                               class="w-full border-gray-300 rounded"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="w-full border-gray-300 rounded"><?php echo e($ubicacion->descripcion); ?></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium mb-1">Latitud</label>
                            <input type="text"
                                   name="latitud"
                                   id="latitud"
                                   value="<?php echo e($ubicacion->latitud); ?>"
                                   class="w-full border-gray-300 rounded"
                                   readonly>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Longitud</label>
                            <input type="text"
                                   name="longitud"
                                   id="longitud"
                                   value="<?php echo e($ubicacion->longitud); ?>"
                                   class="w-full border-gray-300 rounded"
                                   readonly>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                            Actualizar
                        </button>

                        <a href="<?php echo e(route('ubicaciones.index')); ?>"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        const zonaSelect = document.getElementById('zona-select');
        const nombreInput = document.getElementById('nombre-lugar');
        const descInput = document.getElementById('descripcion');
        const latInput = document.getElementById('latitud');
        const lngInput = document.getElementById('longitud');

        // Mapeo de zonas (se genera del servidor)
        const zonasData = {
            <?php $__currentLoopData = \App\Models\RecomendacionZona::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($zona->id); ?>: {
                    nombre: "<?php echo e($zona->nombre_lugar); ?>",
                    descripcion: "<?php echo e($zona->descripcion); ?>",
                    latitud: <?php echo e($zona->latitud); ?>,
                    longitud: <?php echo e($zona->longitud); ?>

                },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        };

        zonaSelect.addEventListener('change', function() {
            if (this.value && zonasData[this.value]) {
                const zona = zonasData[this.value];
                nombreInput.value = zona.nombre;
                descInput.value = zona.descripcion || '';
                latInput.value = zona.latitud;
                lngInput.value = zona.longitud;
                
                // Actualizar mapa
                if (window.mapaInstancias && window.mapaInstancias['mapa-ubicacion']) {
                    const mapa = window.mapaInstancias['mapa-ubicacion'];
                    mapa.setView([zona.latitud, zona.longitud], 15);
                }
            }
        });

        // Cargar ubicación actual en el mapa al inicio
        window.addEventListener('load', function() {
            const latActual = <?php echo e($ubicacion->latitud ?? 25.5095); ?>;
            const lngActual = <?php echo e($ubicacion->longitud ?? -97.1559); ?>;
            
            if (window.mapaInstancias && window.mapaInstancias['mapa-ubicacion']) {
                const mapa = window.mapaInstancias['mapa-ubicacion'];
                mapa.setView([latActual, lngActual], 15);
            }
        });

        // Actualizar coordenadas cuando se selecciona en el mapa
        setInterval(() => {
            if (window.ubicacionSeleccionada) {
                latInput.value = window.ubicacionSeleccionada.latitud.toFixed(7);
                lngInput.value = window.ubicacionSeleccionada.longitud.toFixed(7);
                nombreInput.value = window.ubicacionSeleccionada.nombreLugar || nombreInput.value;
            }
        }, 500);

        // Validar formulario
        document.getElementById('formulario-ubicacion').addEventListener('submit', function(e) {
            if (!nombreInput.value.trim()) {
                e.preventDefault();
                alert('El nombre del lugar es obligatorio');
                return false;
            }
            if (!latInput.value || !lngInput.value) {
                e.preventDefault();
                alert('Debes seleccionar una ubicación en el mapa o elegir una zona recomendada');
                return false;
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\1\Herd\plantatec\resources\views/ubicaciones/edit.blade.php ENDPATH**/ ?>