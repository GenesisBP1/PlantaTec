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
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                Adoptar Planta
            </h2>
            <a href="<?php echo e(route('catalogo.plantas')); ?>" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-full transition shadow-md hover:shadow-lg">
                ← Volver al catálogo
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        .adopcion-container { max-width: 1200px; margin: 0 auto; padding: 1rem; }
        
        .planta-card {
            background: white;
            border-radius: 2rem;
            box-shadow: 0 20px 35px -12px rgba(0, 32, 0, 0.15);
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .planta-imagen {
            flex: 1.2;
            min-width: 280px;
            background: linear-gradient(135deg, #e2f0e6, #c8e0d0);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .planta-imagen img {
            max-width: 100%;
            max-height: 320px;
            object-fit: contain;
            border-radius: 1.5rem;
            filter: drop-shadow(0 8px 12px rgba(0,0,0,0.1));
        }
        .planta-info {
            flex: 2;
            padding: 2rem;
            background: white;
        }
        .planta-info h3 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #1e3a2f;
            margin-bottom: 0.5rem;
        }
        .badge-estado {
            background: #e2f0e6;
            color: #2b7840;
            padding: 0.25rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            margin: 0.5rem 0;
        }
        .cuidados-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }
        .cuidado-item {
            background: #f8faf6;
            border-radius: 1.2rem;
            padding: 0.8rem 1rem;
            border-left: 4px solid #2b7840;
            transition: all 0.2s;
        }
        .cuidado-item strong {
            color: #1e3a2f;
            font-size: 1rem;
        }
        .cuidado-frecuencia {
            font-size: 0.75rem;
            color: #6f8f7a;
            margin-top: 0.25rem;
        }
        .formulario-card {
            background: white;
            border-radius: 2rem;
            box-shadow: 0 20px 35px -12px rgba(0, 32, 0, 0.15);
            padding: 2rem;
            margin-top: 1rem;
        }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; font-weight: 700; margin-bottom: 0.5rem; color: #1e3a2f; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 1rem;
            border: 1.5px solid #cde0d4;
            background: #fefef9;
            transition: all 0.2s;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43,120,64,0.2);
        }
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            background: #f4fbf2;
            padding: 1rem 1.2rem;
            border-radius: 1.5rem;
        }
        .radio-group label {
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
        }
        .radio-group input[type="radio"] {
            width: 1.2rem;
            height: 1.2rem;
            margin: 0;
        }
        .btn-adoptar {
            background: linear-gradient(105deg, #2b7840, #3e8a5a);
            color: white;
            border: none;
            padding: 0.9rem 2rem;
            border-radius: 3rem;
            font-weight: 800;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
            box-shadow: 0 8px 20px rgba(43,120,64,0.3);
        }
        .btn-adoptar:hover {
            transform: scale(0.98);
            background: linear-gradient(105deg, #236a3b, #2b7840);
            box-shadow: 0 12px 25px rgba(43,120,64,0.4);
        }
        .hidden { display: none; }
        .text-red-500 { color: #ef4444; }
        .text-sm { font-size: 0.875rem; }
        .bg-blue-50 { background: #eff6ff; }
        .border-blue-200 { border-color: #bfdbfe; }
        .text-blue-900 { color: #1e3a8a; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-4 { margin-top: 1rem; }
        .mb-3 { margin-bottom: 0.75rem; }
        @media (max-width: 768px) {
            .planta-card { flex-direction: column; }
            .planta-info h3 { font-size: 1.8rem; }
            .radio-group { gap: 0.5rem; }
        }
    </style>

    <div class="mt-16 py-8">
        <div class="adopcion-container">
            <!-- Tarjeta de información de la planta con cuidados -->
            <div class="planta-card">
                <div class="planta-imagen">
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

                <div class="planta-info">
                    <h3><?php echo e($planta->nombre); ?></h3>
                    <p class="text-gray-600"><strong>Especie:</strong> <?php echo e($planta->especie); ?></p>
                    <span class="badge-estado"> Estado: <?php echo e(ucfirst($planta->estado)); ?></span>
                    
                    <div class="mt-4">
                        <h4 class="text-lg font-bold text-green-800 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Cuidados necesarios
                        </h4>
                        <?php if($planta->plantaCuidados && $planta->plantaCuidados->count()): ?>
                            <div class="cuidados-grid">
                                <?php $__currentLoopData = $planta->plantaCuidados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="cuidado-item">
                                        <strong><?php echo e($pc->cuidado->nombre); ?></strong>
                                        <div class="cuidado-frecuencia">Cada <?php echo e($pc->frecuencia); ?> días</div>
                                        <?php if($pc->instrucciones_esp): ?>
                                            <div class="text-xs text-gray-600 mt-1"><?php echo e(Str::limit($pc->instrucciones_esp, 60)); ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 italic">No se han definido cuidados específicos para esta planta.</p>
                        <?php endif; ?>
                    </div>

                    <div class="mt-4">
                        <p><strong> Zona recomendada:</strong> <?php echo e($planta->tipo_zona ?? 'No especificada'); ?></p>
                        <p class="mt-3 text-gray-700"><?php echo e($planta->descripcion ?? 'Sin descripción.'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Formulario de adopción -->
            <div class="formulario-card">
                <h4 class="text-xl font-bold text-gray-800 mb-4"> Datos de ubicación para la adopción</h4>

                <?php if($errors->any()): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form id="formulario-adopcion" action="<?php echo e(route('catalogo.plantas.adoptar', $planta)); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Tipo de ubicación -->
                    <div class="form-group">
                        <label>Tipo de ubicación</label>
                        <select name="tipo" id="tipoUbicacion" required class="w-full">
                            <option value="">Selecciona</option>
                            <option value="publico">Pública (parque, jardín público)</option>
                            <option value="privado">Privada (casa, jardín particular)</option>
                        </select>
                    </div>

                    <!-- OPCIÓN 1: UBICACIÓN PÚBLICA -->
                    <div id="ubicacionPublica" class="hidden">
                        <div class="form-group">
                            <label class="block font-semibold mb-2">¿Cómo deseas seleccionar la ubicación?</label>
                            <div class="radio-group">
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

                        <div id="subopcion-zona" class="form-group">
                            <label>Zona pública recomendada</label>
                            <select name="id_recomendacion_zona" class="w-full">
                                <option value="">Selecciona una zona</option>
                                <?php $__currentLoopData = $zonasRecomendadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($zona->id); ?>">
                                        <?php echo e($zona->nombre_lugar); ?> - <?php echo e($zona->tipo_zona ?? 'Sin tipo'); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <p class="text-sm text-gray-500 mt-1">Se tomarán automáticamente los datos de la zona.</p>
                        </div>

                        <div id="subopcion-mapa" class="hidden">
                            <p class="text-sm text-blue-700 mb-2"> Selecciona tu ubicación en el mapa o usa geolocalización.</p>
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
                            <div class="mt-3 p-3 bg-blue-50 rounded-xl border border-blue-200">
                                <p class="text-sm font-medium text-blue-900">Ubicación elegida: <strong id="ubicacion-seleccionada-publica">Ninguna</strong></p>
                            </div>
                            <input type="hidden" name="latitud" id="input-latitud">
                            <input type="hidden" name="longitud" id="input-longitud">
                            <input type="hidden" name="nombre_lugar" id="input-nombre_lugar">
                            <input type="hidden" name="es_publica" value="1">
                        </div>
                    </div>

                    <!-- OPCIÓN 2: UBICACIÓN PRIVADA -->
                    <div id="ubicacionPrivada" class="hidden">
                        <div class="form-group">
                            <label class="block font-semibold mb-2">¿Cómo deseas registrar la ubicación?</label>
                            <div class="radio-group">
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

                        <div id="subopcion-nombre" class="form-group">
                            <label>Nombre del lugar privado</label>
                            <input type="text" name="nombre_lugar_privado" placeholder="Ejemplo: Mi casa, patio trasero, jardín familiar">
                            <label class="mt-3">Descripción (opcional)</label>
                            <textarea name="descripcion_privada" rows="2" placeholder="Comparte detalles como luz, sombra, etc."></textarea>
                        </div>

                        <div id="subopcion-mapa-privada" class="hidden">
                            <p class="text-sm text-blue-700 mb-2"> Selecciona tu ubicación en el mapa.</p>
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
                            <div class="mt-3 p-3 bg-blue-50 rounded-xl border border-blue-200">
                                <p class="text-sm font-medium text-blue-900">Ubicación elegida: <strong id="ubicacion-seleccionada-privada">Ninguna</strong></p>
                            </div>

                            <div class="mt-4">
                                <label>Nombre del lugar (obligatorio)</label>
                                <input type="text" name="nombre_lugar_privado_mapa" id="input-nombre_lugar_privado" placeholder="Ejemplo: Mi hogar, oficina, huerto">
                                <label class="mt-3">Descripción (opcional)</label>
                                <textarea name="descripcion_privada_mapa" id="input-descripcion_privada" rows="2" placeholder="Información adicional..."></textarea>
                            </div>

                            <input type="hidden" name="latitud_privada" id="input-latitud-privada">
                            <input type="hidden" name="longitud_privada" id="input-longitud-privada">
                            <input type="hidden" name="es_publica_privada" value="0">
                        </div>
                    </div>

                    <button type="submit" class="btn-adoptar mt-4">
                         Adoptar <?php echo e($planta->nombre); ?>

                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script original sin cambios -->
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
                    setTimeout(() => { window.mapaInstancias['mapa-adopcion-publica'].invalidateSize(); }, 50);
                }
            });
        });

        document.querySelectorAll('input[name="metodo_ubicacion_privada"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const metodo = this.value;
                document.getElementById('subopcion-nombre').classList.toggle('hidden', metodo !== 'nombre');
                document.getElementById('subopcion-mapa-privada').classList.toggle('hidden', metodo !== 'mapa');
                if (metodo === 'mapa' && window.mapaInstancias && window.mapaInstancias['mapa-adopcion-privada']) {
                    setTimeout(() => { window.mapaInstancias['mapa-adopcion-privada'].invalidateSize(); }, 50);
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
                    if (!zona) { e.preventDefault(); alert('Por favor selecciona una zona recomendada'); }
                } else if (metodo === 'mapa') {
                    if (!window.ubicacionSeleccionada) { e.preventDefault(); alert('Por favor selecciona una ubicación en el mapa'); }
                }
            } else if (tipo === 'privado') {
                const metodo = document.querySelector('input[name="metodo_ubicacion_privada"]:checked')?.value;
                if (metodo === 'nombre') {
                    const nombre = document.querySelector('input[name="nombre_lugar_privado"]').value;
                    if (!nombre) { e.preventDefault(); alert('Por favor ingresa el nombre del lugar'); }
                } else if (metodo === 'mapa') {
                    const nombre = document.getElementById('input-nombre_lugar_privado').value;
                    if (!nombre) { e.preventDefault(); alert('Por favor ingresa el nombre del lugar'); }
                    if (!window.ubicacionSeleccionada) { e.preventDefault(); alert('Por favor selecciona una ubicación en el mapa'); }
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
<?php endif; ?><?php /**PATH C:\Users\1\Herd\plantatec\resources\views/catalogo/show.blade.php ENDPATH**/ ?>