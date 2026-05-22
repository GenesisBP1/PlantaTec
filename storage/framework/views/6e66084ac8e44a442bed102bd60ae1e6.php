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
                <p class="pt-header-label">Catálogo</p>
                <h2 class="pt-header-title">Adoptar Planta</h2>
            </div>

            <div class="pt-header-actions">
                <a href="<?php echo e(route('catalogo.plantas')); ?>" class="pt-btn pt-btn-green">
                    ← Volver al catálogo
                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-catalog-show-card">
                <div class="pt-catalog-show-image">
                    <?php
                        $imagenUrl = 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&fit=crop';

                        if ($planta->imagen) {
                            if (filter_var($planta->imagen, FILTER_VALIDATE_URL)) {
                                $imagenUrl = $planta->imagen;
                            } elseif (file_exists(public_path('storage/' . $planta->imagen))) {
                                $imagenUrl = asset('storage/' . $planta->imagen);
                            }
                        }
                    ?>

                    <img src="<?php echo e($imagenUrl); ?>" alt="<?php echo e($planta->nombre); ?>">
                </div>

                <div class="pt-catalog-show-info">
                    <h3><?php echo e($planta->nombre); ?></h3>

                    <p class="pt-text">
                        <strong>Especie:</strong> <?php echo e($planta->especie); ?>

                    </p>

                    <span class="pt-badge green">
                        Estado: <?php echo e(ucfirst($planta->estado)); ?>

                    </span>

                    <div class="pt-show-section">
                        <h4 class="pt-show-section-title">
                            Cuidados necesarios
                        </h4>

                        <?php if($planta->plantaCuidados && $planta->plantaCuidados->count()): ?>
                            <div class="pt-care-grid">
                                <?php $__currentLoopData = $planta->plantaCuidados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="pt-care-item">
                                        <strong><?php echo e($pc->cuidado->nombre); ?></strong>

                                        <p>Cada <?php echo e($pc->frecuencia); ?> días</p>

                                        <?php if($pc->instrucciones_esp): ?>
                                            <span><?php echo e(Str::limit($pc->instrucciones_esp, 60)); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="pt-muted">No se han definido cuidados específicos para esta planta.</p>
                        <?php endif; ?>
                    </div>

                    <div class="pt-show-section">
                        <p class="pt-text">
                            <strong>Zona recomendada:</strong>
                            <?php echo e($planta->tipo_zona ?? 'No especificada'); ?>

                        </p>

                        <p class="pt-description">
                            <?php echo e($planta->descripcion ?? 'Sin descripción.'); ?>

                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-card pt-adoption-form-card">
                <h4 class="pt-section-title">
                    Datos de ubicación para la adopción
                </h4>

                <?php if($errors->any()): ?>
                    <div class="pt-alert-error">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form id="formulario-adopcion" action="<?php echo e(route('catalogo.plantas.adoptar', $planta)); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="pt-form-group">
                        <label>Tipo de ubicación</label>

                        <select name="tipo" id="tipoUbicacion" required>
                            <option value="">Selecciona</option>
                            <option value="publico">Pública (parque, jardín público)</option>
                            <option value="privado">Privada (casa, jardín particular)</option>
                        </select>
                    </div>

                    <div id="ubicacionPublica" class="hidden">
                        <div class="pt-form-group">
                            <label>¿Cómo deseas seleccionar la ubicación?</label>

                            <div class="pt-radio-group">
                                <label>
                                    <input type="radio" name="metodo_ubicacion_publica" value="zona" checked class="metodo-ubicacion" data-metodo="zona">
                                    <span>Elegir zona recomendada</span>
                                </label>

                                <label>
                                    <input type="radio" name="metodo_ubicacion_publica" value="mapa" class="metodo-ubicacion" data-metodo="mapa">
                                    <span>Seleccionar en el mapa</span>
                                </label>
                            </div>
                        </div>

                        <div id="subopcion-zona" class="pt-form-group">
                            <label>Zona pública recomendada</label>

                            <select name="id_recomendacion_zona">
                                <option value="">Selecciona una zona</option>

                                <?php $__currentLoopData = $zonasRecomendadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($zona->id); ?>">
                                        <?php echo e($zona->nombre_lugar); ?> - <?php echo e($zona->tipo_zona ?? 'Sin tipo'); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <p class="pt-help-text">
                                Se tomarán automáticamente los datos de la zona.
                            </p>
                        </div>

                        <div id="subopcion-mapa" class="hidden">
                            <p class="pt-info-message">
                                Selecciona tu ubicación en el mapa o usa geolocalización.
                            </p>

                            <?php if (isset($component)) { $__componentOriginal81c72807132ffb34a5ed67ad325fbcfc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81c72807132ffb34a5ed67ad325fbcfc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.mapa-interactivo','data' => ['id' => 'mapa-adopcion-publica','canSelectLocation' => true,'showToolbar' => 'true','height' => '400px']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mapa-interactivo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'mapa-adopcion-publica','canSelectLocation' => true,'showToolbar' => 'true','height' => '400px']); ?>
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

                            <div class="pt-location-box">
                                <p>
                                    Ubicación elegida:
                                    <strong id="ubicacion-seleccionada-publica">Ninguna</strong>
                                </p>
                            </div>

                            <input type="hidden" name="latitud" id="input-latitud">
                            <input type="hidden" name="longitud" id="input-longitud">
                            <input type="hidden" name="nombre_lugar" id="input-nombre_lugar">
                            <input type="hidden" name="es_publica" value="1">
                        </div>
                    </div>

                    <div id="ubicacionPrivada" class="hidden">
                        <div class="pt-form-group">
                            <label>¿Cómo deseas registrar la ubicación?</label>

                            <div class="pt-radio-group">
                                <label>
                                    <input type="radio" name="metodo_ubicacion_privada" value="nombre" checked class="metodo-ubicacion" data-metodo="nombre">
                                    <span>Solo nombre</span>
                                </label>

                                <label>
                                    <input type="radio" name="metodo_ubicacion_privada" value="mapa" class="metodo-ubicacion" data-metodo="mapa">
                                    <span>Con ubicación exacta (mapa)</span>
                                </label>
                            </div>
                        </div>

                        <div id="subopcion-nombre" class="pt-form-group">
                            <label>Nombre del lugar privado</label>

                            <input type="text" name="nombre_lugar_privado" placeholder="Ejemplo: Mi casa, patio trasero, jardín familiar">

                            <label>Descripción (opcional)</label>

                            <textarea name="descripcion_privada" rows="2" placeholder="Comparte detalles como luz, sombra, etc."></textarea>
                        </div>

                        <div id="subopcion-mapa-privada" class="hidden">
                            <p class="pt-info-message">
                                Selecciona tu ubicación en el mapa.
                            </p>

                            <?php if (isset($component)) { $__componentOriginal81c72807132ffb34a5ed67ad325fbcfc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81c72807132ffb34a5ed67ad325fbcfc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.mapa-interactivo','data' => ['id' => 'mapa-adopcion-privada','canSelectLocation' => true,'showToolbar' => 'true','height' => '400px']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mapa-interactivo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'mapa-adopcion-privada','canSelectLocation' => true,'showToolbar' => 'true','height' => '400px']); ?>
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

                            <div class="pt-location-box">
                                <p>
                                    Ubicación elegida:
                                    <strong id="ubicacion-seleccionada-privada">Ninguna</strong>
                                </p>
                            </div>

                            <div class="pt-form-group">
                                <label>Nombre del lugar (obligatorio)</label>
                                <input type="text" name="nombre_lugar_privado_mapa" id="input-nombre_lugar_privado" placeholder="Ejemplo: Mi hogar, oficina, huerto">

                                <label>Descripción (opcional)</label>
                                <textarea name="descripcion_privada_mapa" id="input-descripcion_privada" rows="2" placeholder="Información adicional..."></textarea>
                            </div>

                            <input type="hidden" name="latitud_privada" id="input-latitud-privada">
                            <input type="hidden" name="longitud_privada" id="input-longitud-privada">
                            <input type="hidden" name="es_publica_privada" value="0">
                        </div>
                    </div>

                    <button type="submit" class="pt-submit-btn">
                        Adoptar <?php echo e($planta->nombre); ?>

                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        const tipoUbicacion = document.getElementById('tipoUbicacion');
        const ubicacionPublica = document.getElementById('ubicacionPublica');
        const ubicacionPrivada = document.getElementById('ubicacionPrivada');
        const formulario = document.getElementById('formulario-adopcion');

        tipoUbicacion.addEventListener('change', function() {
            const tipo = this.value;
            ubicacionPublica.classList.toggle('hidden', tipo !== 'publico');
            ubicacionPrivada.classList.toggle('hidden', tipo !== 'privado');
        });

        document.querySelectorAll('input[name="metodo_ubicacion_publica"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const metodo = this.value;
                document.getElementById('subopcion-zona').classList.toggle('hidden', metodo !== 'zona');
                document.getElementById('subopcion-mapa').classList.toggle('hidden', metodo !== 'mapa');

                if (metodo === 'mapa' && window.mapaInstancias && window.mapaInstancias['mapa-adopcion-publica']) {
                    setTimeout(() => {
                        window.mapaInstancias['mapa-adopcion-publica'].invalidateSize();
                    }, 50);
                }
            });
        });

        document.querySelectorAll('input[name="metodo_ubicacion_privada"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const metodo = this.value;
                document.getElementById('subopcion-nombre').classList.toggle('hidden', metodo !== 'nombre');
                document.getElementById('subopcion-mapa-privada').classList.toggle('hidden', metodo !== 'mapa');

                if (metodo === 'mapa' && window.mapaInstancias && window.mapaInstancias['mapa-adopcion-privada']) {
                    setTimeout(() => {
                        window.mapaInstancias['mapa-adopcion-privada'].invalidateSize();
                    }, 50);
                }
            });
        });

        setInterval(() => {
            if (window.ubicacionSeleccionada) {
                const lat = window.ubicacionSeleccionada.latitud.toFixed(4);
                const lng = window.ubicacionSeleccionada.longitud.toFixed(4);

                if (!document.getElementById('subopcion-mapa').classList.contains('hidden')) {
                    document.getElementById('ubicacion-seleccionada-publica').textContent = `${lat}, ${lng}`;
                    document.getElementById('input-latitud').value = window.ubicacionSeleccionada.latitud;
                    document.getElementById('input-longitud').value = window.ubicacionSeleccionada.longitud;
                    document.getElementById('input-nombre_lugar').value = window.ubicacionSeleccionada.nombreLugar || 'Lugar seleccionado';
                }

                if (!document.getElementById('subopcion-mapa-privada').classList.contains('hidden')) {
                    document.getElementById('ubicacion-seleccionada-privada').textContent = `${lat}, ${lng}`;
                    document.getElementById('input-latitud-privada').value = window.ubicacionSeleccionada.latitud;
                    document.getElementById('input-longitud-privada').value = window.ubicacionSeleccionada.longitud;
                }
            }
        }, 500);

        formulario.addEventListener('submit', function(e) {
            const tipo = document.getElementById('tipoUbicacion').value;

            if (tipo === 'publico') {
                const metodo = document.querySelector('input[name="metodo_ubicacion_publica"]:checked')?.value;

                if (metodo === 'zona') {
                    const zona = document.querySelector('select[name="id_recomendacion_zona"]').value;

                    if (!zona) {
                        e.preventDefault();
                        alert('Por favor selecciona una zona recomendada');
                    }
                } else if (metodo === 'mapa') {
                    if (!window.ubicacionSeleccionada) {
                        e.preventDefault();
                        alert('Por favor selecciona una ubicación en el mapa');
                    }
                }
            } else if (tipo === 'privado') {
                const metodo = document.querySelector('input[name="metodo_ubicacion_privada"]:checked')?.value;

                if (metodo === 'nombre') {
                    const nombre = document.querySelector('input[name="nombre_lugar_privado"]').value;

                    if (!nombre) {
                        e.preventDefault();
                        alert('Por favor ingresa el nombre del lugar');
                    }
                } else if (metodo === 'mapa') {
                    const nombre = document.getElementById('input-nombre_lugar_privado').value;

                    if (!nombre) {
                        e.preventDefault();
                        alert('Por favor ingresa el nombre del lugar');
                    }

                    if (!window.ubicacionSeleccionada) {
                        e.preventDefault();
                        alert('Por favor selecciona una ubicación en el mapa');
                    }
                }
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/catalogo/show.blade.php ENDPATH**/ ?>