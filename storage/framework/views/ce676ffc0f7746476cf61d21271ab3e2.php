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
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-green-600 dark:text-green-400 mb-0.5">Mi espacio verde</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                    Hola, <?php echo e(Auth::user()->name); ?>

                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5"><?php echo e(now()->isoFormat('dddd, D [de] MMMM [de] YYYY')); ?></p>
            </div>
            <a href="<?php echo e(route('catalogo.plantas')); ?>"
               class="hidden md:inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-xl shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Adoptar planta
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                
                <a href="<?php echo e(route('adopciones.index')); ?>" 
                   class="group relative bg-gradient-to-br from-white to-green-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl p-5 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-green-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-600 dark:text-green-400">Plantas adoptadas</p>
                            <p class="text-4xl font-bold text-gray-800 dark:text-white mt-1"><?php echo e($misPlantas); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-sm text-green-600 dark:text-green-400 group-hover:underline">
                        <span>Ver adopciones</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>

                
                <a href="<?php echo e(route('notificaciones.index')); ?>" 
                   class="group relative bg-gradient-to-br from-white to-red-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl p-5 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-red-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-red-600 dark:text-red-400">Notificaciones</p>
                            <div class="flex items-baseline gap-1">
                                <p class="text-4xl font-bold text-gray-800 dark:text-white mt-1"><?php echo e($misNotificaciones); ?></p>
                                <?php if($misNotificaciones > 0): ?>
                                    <span class="text-xs text-red-500">pendientes</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-2xl flex items-center justify-center relative">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <?php if($misNotificaciones > 0): ?>
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center"><?php echo e($misNotificaciones > 9 ? '9+' : $misNotificaciones); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-sm text-red-600 dark:text-red-400 group-hover:underline">
                        <?php if($misNotificaciones > 0): ?>
                            <span><?php echo e($misNotificaciones); ?> sin leer</span>
                        <?php else: ?>
                            <span>Todo al día</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        <?php endif; ?>
                    </div>
                </a>

                
                <div class="group relative bg-gradient-to-br from-white to-amber-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl p-5 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-amber-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-amber-600 dark:text-amber-400">Cuidados de hoy</p>
                            <div class="flex items-baseline gap-1">
                                <p class="text-4xl font-bold text-gray-800 dark:text-white mt-1"><?php echo e($cuidadosPendientesHoy ?? 0); ?></p>
                                <span class="text-xs text-amber-500">pendientes</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                        <span>Registra los cuidados</span>
                    </div>
                </div>

                
                <div class="group relative bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl p-5 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-blue-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Problemas activos</p>
                            <p class="text-4xl font-bold text-gray-800 dark:text-white mt-1"><?php echo e($problemasActivos ?? 0); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                        <span>En seguimiento</span>
                    </div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <a href="<?php echo e(route('catalogo.plantas')); ?>" 
                   class="flex items-center gap-4 bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-md hover:shadow-lg hover:bg-green-50 dark:hover:bg-gray-700 transition-all duration-300 border border-gray-100 dark:border-gray-700">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 dark:text-white">Catálogo de plantas</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Explora y adopta nuevas plantas</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="<?php echo e(route('adopciones.index')); ?>" 
                   class="flex items-center gap-4 bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-md hover:shadow-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-all duration-300 border border-gray-100 dark:border-gray-700">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 dark:text-white">Mis adopciones</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Gestiona tus plantas adoptadas</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="<?php echo e(route('notificaciones.index')); ?>" 
                   class="flex items-center gap-4 bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-md hover:shadow-lg hover:bg-red-50 dark:hover:bg-gray-700 transition-all duration-300 border border-gray-100 dark:border-gray-700">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center relative">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <?php if($misNotificaciones > 0): ?>
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-white text-red-600 text-xs font-bold rounded-full border-2 border-red-500 flex items-center justify-center"><?php echo e($misNotificaciones > 9 ? '9+' : $misNotificaciones); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 dark:text-white">Notificaciones</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            <?php if($misNotificaciones > 0): ?>
                                Tienes <span class="text-red-500 font-semibold"><?php echo e($misNotificaciones); ?></span> sin leer
                            <?php else: ?>
                                Todo al día
                            <?php endif; ?>
                        </p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="<?php echo e(route('registro-cuidados.index')); ?>" 
                   class="flex items-center gap-4 bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-md hover:shadow-lg hover:bg-purple-50 dark:hover:bg-gray-700 transition-all duration-300 border border-gray-100 dark:border-gray-700">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 dark:text-white">Registro de cuidados</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Lleva el control de tus plantas</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            
            <?php if(isset($ubicacionesConPlantas) && $ubicacionesConPlantas->count() > 0): ?>
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-gray-800 dark:text-white">Mapa de tus plantas</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Visualiza dónde están tus plantas adoptadas</p>
                    </div>
                    <a href="<?php echo e(route('mapa.index')); ?>" class="text-sm text-green-600 hover:text-green-700 font-medium">Ver mapa completo →</a>
                </div>
                <div class="p-6">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-xl h-64 flex items-center justify-center">
                        <p class="text-gray-500 dark:text-gray-400">Mapa interactivo</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">
                    Mapa de plantas adoptadas
                </h3>

                <div id="mapaUsuario" style="height: 420px; border-radius: 18px;"></div>
            </div>

            
            <?php if($misNotificaciones > 0): ?>
            <div class="relative bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl p-6 text-white overflow-hidden shadow-md">
                <div class="absolute -right-6 -top-6 w-36 h-36 bg-white/10 rounded-full"></div>
                <div class="absolute right-10 bottom-0 w-20 h-20 bg-white/10 rounded-full"></div>
                <div class="relative flex items-center justify-between gap-4 flex-wrap">
                    <div>
                        <p class="text-sm font-semibold text-green-100 mb-1">¡Tus plantas te necesitan!</p>
                        <p class="text-lg font-bold">Tienes <?php echo e($misNotificaciones); ?> <?php echo e($misNotificaciones === 1 ? 'recomendación pendiente' : 'recomendaciones pendientes'); ?></p>
                        <p class="text-sm text-green-100 mt-1">Revisa los cuidados sugeridos para mantenerlas saludables.</p>
                    </div>
                    <a href="<?php echo e(route('notificaciones.index')); ?>" class="shrink-0 bg-white text-green-700 hover:bg-green-50 font-semibold text-sm px-4 py-2.5 rounded-xl transition shadow-sm">
                        Revisar ahora
                    </a>
                </div>
            </div>
            <?php else: ?>
            <div class="relative bg-gradient-to-r from-emerald-50 to-green-50 dark:from-gray-800 dark:to-gray-800 border border-green-100 dark:border-gray-700 rounded-2xl p-6 overflow-hidden">
                <div class="relative flex items-center gap-4 flex-wrap">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-green-800 dark:text-green-400">¡Tus plantas están bien cuidadas!</p>
                        <p class="text-sm text-green-600 dark:text-green-500">No tienes recomendaciones pendientes. Sigue así.</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if(isset($ultimasPlantas) && $ultimasPlantas->count() > 0): ?>
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-gray-800 dark:text-white">Últimas plantas</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tus adopciones más recientes</p>
                    </div>
                    <a href="<?php echo e(route('adopciones.index')); ?>" class="text-sm text-green-600 hover:text-green-700 font-medium">Ver todas →</a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php $__currentLoopData = $ultimasPlantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adopcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <img src="<?php echo e($adopcion->planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=400&h=200&fit=crop'); ?>" 
                                 alt="<?php echo e($adopcion->planta->nombre ?? 'Planta'); ?>"
                                 class="w-full h-36 object-cover group-hover:scale-105 transition duration-300">
                            <div class="p-4">
                                <h4 class="font-semibold text-gray-800 dark:text-white"><?php echo e($adopcion->planta->nombre ?? 'Planta sin nombre'); ?></h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Adoptada el <?php echo e($adopcion->created_at->format('d/m/Y')); ?></p>
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full">
                                        <?php echo e($adopcion->planta->tipo_zona ?? 'Interior'); ?>

                                    </span>
                                    <?php if($adopcion->planta): ?>
                                        <a href="<?php echo e(route('catalogo.plantas.show', $adopcion->planta->id)); ?>" class="text-sm text-green-600 hover:text-green-700 font-medium">Ver →</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<!-- Leaflet CSS y JS para el mapa de usuario -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mapa = L.map('mapaUsuario').setView([25.8690, -97.5027], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(mapa);

    const ubicaciones = <?php echo json_encode($ubicacionesMapa ?? [], 15, 512) ?>;
    const usuarioActual = <?php echo e(auth()->id()); ?>;

    const iconoRojo = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34]
    });

    const iconoAzul = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34]
    });

    ubicaciones.forEach(item => {
        if (!item.ubicacion) return;

        const esMia = item.id_usuario === usuarioActual;
        const tipo = (item.ubicacion.tipo || '').toLowerCase();

        if (!esMia && tipo !== 'publico') {
            return;
        }

        const marker = L.marker(
            [item.ubicacion.latitud, item.ubicacion.longitud],
            {
                icon: esMia ? iconoRojo : iconoAzul
            }
        ).addTo(mapa);

        marker.bindPopup(`
            <div style="min-width:200px">
                <strong>${item.planta?.nombre ?? ''}</strong><br>
                <b>Ubicación:</b> ${item.ubicacion.nombre_lugar ?? 'Sin nombre'}<br>
                <b>Tipo:</b> ${tipo}<br>
                <b>${esMia ? 'Tu adopción' : 'Ubicación pública'}</b>
            </div>
        `);
    });
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/dashboard/usuario.blade.php ENDPATH**/ ?>