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
                <p class="pt-header-label">Mi espacio verde</p>
                <h2 class="pt-header-title">
                    Hola, <?php echo e(Auth::user()->name); ?>

                </h2>
                <p class="pt-header-subtitle">
                    <?php echo e(now()->isoFormat('dddd, D [de] MMMM [de] YYYY')); ?>

                </p>
            </div>

            <div class="pt-header-actions">
                <a href="<?php echo e(route('catalogo.plantas')); ?>" class="pt-btn pt-btn-green">
                    Adoptar planta
                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-user-stats-grid">

                <a href="<?php echo e(route('adopciones.index')); ?>" class="pt-user-stat green">
                    <div class="pt-user-stat-content">
                        <div>
                            <p class="pt-user-stat-label">Plantas adoptadas</p>
                            <p class="pt-user-stat-number"><?php echo e($misPlantas); ?></p>
                        </div>
                        <div class="pt-user-stat-icon">🌿</div>
                    </div>
                    <p class="pt-user-stat-link green">Ver adopciones →</p>
                </a>

                <a href="<?php echo e(route('notificaciones.index')); ?>" class="pt-user-stat red">
                    <div class="pt-user-stat-content">
                        <div>
                            <p class="pt-user-stat-label">Notificaciones</p>
                            <div class="pt-user-number-row">
                                <p class="pt-user-stat-number"><?php echo e($misNotificaciones); ?></p>
                                <?php if($misNotificaciones > 0): ?>
                                    <span class="pt-user-small red">pendientes</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="pt-user-stat-icon notification">
                            🔔
                            <?php if($misNotificaciones > 0): ?>
                                <span class="pt-notification-badge">
                                    <?php echo e($misNotificaciones > 9 ? '9+' : $misNotificaciones); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <p class="pt-user-stat-link red">
                        <?php if($misNotificaciones > 0): ?>
                            <?php echo e($misNotificaciones); ?> sin leer
                        <?php else: ?>
                            Todo al día ✓
                        <?php endif; ?>
                    </p>
                </a>

                <div class="pt-user-stat amber">
                    <div class="pt-user-stat-content">
                        <div>
                            <p class="pt-user-stat-label">Cuidados de hoy</p>
                            <div class="pt-user-number-row">
                                <p class="pt-user-stat-number"><?php echo e($cuidadosPendientesHoy ?? 0); ?></p>
                                <span class="pt-user-small amber">pendientes</span>
                            </div>
                        </div>
                        <div class="pt-user-stat-icon">💡</div>
                    </div>
                    <p class="pt-user-stat-text">Registra los cuidados</p>
                </div>

                <div class="pt-user-stat blue">
                    <div class="pt-user-stat-content">
                        <div>
                            <p class="pt-user-stat-label">Problemas activos</p>
                            <p class="pt-user-stat-number"><?php echo e($problemasActivos ?? 0); ?></p>
                        </div>
                        <div class="pt-user-stat-icon">⚠️</div>
                    </div>
                    <p class="pt-user-stat-text">En seguimiento</p>
                </div>

            </div>

            <div class="pt-user-actions-grid">

                <a href="<?php echo e(route('catalogo.plantas')); ?>" class="pt-user-action green">
                    <div class="pt-user-action-icon">🌱</div>
                    <div class="pt-user-action-text">
                        <p class="pt-user-action-title">Catálogo de plantas</p>
                        <p class="pt-user-action-subtitle">Explora y adopta nuevas plantas</p>
                    </div>
                    <span class="pt-user-arrow">›</span>
                </a>

                <a href="<?php echo e(route('adopciones.index')); ?>" class="pt-user-action blue">
                    <div class="pt-user-action-icon">💜</div>
                    <div class="pt-user-action-text">
                        <p class="pt-user-action-title">Mis adopciones</p>
                        <p class="pt-user-action-subtitle">Gestiona tus plantas adoptadas</p>
                    </div>
                    <span class="pt-user-arrow">›</span>
                </a>

                <a href="<?php echo e(route('notificaciones.index')); ?>" class="pt-user-action red">
                    <div class="pt-user-action-icon notification">
                        🔔
                        <?php if($misNotificaciones > 0): ?>
                            <span class="pt-action-badge">
                                <?php echo e($misNotificaciones > 9 ? '9+' : $misNotificaciones); ?>

                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="pt-user-action-text">
                        <p class="pt-user-action-title">Notificaciones</p>
                        <p class="pt-user-action-subtitle">
                            <?php if($misNotificaciones > 0): ?>
                                Tienes <?php echo e($misNotificaciones); ?> sin leer
                            <?php else: ?>
                                Todo al día
                            <?php endif; ?>
                        </p>
                    </div>
                    <span class="pt-user-arrow">›</span>
                </a>

                <a href="<?php echo e(route('registro-cuidados.index')); ?>" class="pt-user-action purple">
                    <div class="pt-user-action-icon">📋</div>
                    <div class="pt-user-action-text">
                        <p class="pt-user-action-title">Registro de cuidados</p>
                        <p class="pt-user-action-subtitle">Lleva el control de tus plantas</p>
                    </div>
                    <span class="pt-user-arrow">›</span>
                </a>

            </div>

            <?php if(isset($ubicacionesConPlantas) && $ubicacionesConPlantas->count() > 0): ?>
                <div class="pt-card">
                    <div class="pt-card-header">
                        <div>
                            <h3 class="pt-card-title">Mapa de tus plantas</h3>
                            <p class="pt-card-subtitle">Visualiza dónde están tus plantas adoptadas</p>
                        </div>

                        <a href="<?php echo e(route('mapa.index')); ?>" class="pt-link green">
                            Ver mapa completo →
                        </a>
                    </div>

                    <div class="pt-map-placeholder">
                        Mapa interactivo
                    </div>
                </div>
            <?php endif; ?>

            <div class="pt-card">
                <h3 class="pt-section-title">
                    Mapa de plantas adoptadas
                </h3>

                <div id="mapaUsuario" class="pt-user-map"></div>
            </div>

            <?php if($misNotificaciones > 0): ?>
                <div class="pt-user-banner active">
                    <div class="pt-banner-circle one"></div>
                    <div class="pt-banner-circle two"></div>

                    <div class="pt-user-banner-content">
                        <div>
                            <p class="pt-banner-small">¡Tus plantas te necesitan!</p>
                            <p class="pt-banner-title">
                                Tienes <?php echo e($misNotificaciones); ?>

                                <?php echo e($misNotificaciones === 1 ? 'recomendación pendiente' : 'recomendaciones pendientes'); ?>

                            </p>
                            <p class="pt-banner-text">
                                Revisa los cuidados sugeridos para mantenerlas saludables.
                            </p>
                        </div>

                        <a href="<?php echo e(route('notificaciones.index')); ?>" class="pt-banner-btn">
                            Revisar ahora
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="pt-user-banner success">
                    <div class="pt-success-icon">✓</div>
                    <div>
                        <p class="pt-success-title">¡Tus plantas están bien cuidadas!</p>
                        <p class="pt-success-text">
                            No tienes recomendaciones pendientes. Sigue así.
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(isset($ultimasPlantas) && $ultimasPlantas->count() > 0): ?>
                <div class="pt-card">
                    <div class="pt-card-header">
                        <div>
                            <h3 class="pt-card-title">Últimas plantas</h3>
                            <p class="pt-card-subtitle">Tus adopciones más recientes</p>
                        </div>

                        <a href="<?php echo e(route('adopciones.index')); ?>" class="pt-link green">
                            Ver todas →
                        </a>
                    </div>

                    <div class="pt-last-plants-grid">
                        <?php $__currentLoopData = $ultimasPlantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adopcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="pt-last-plant-card">
                                <img src="<?php echo e($adopcion->planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=400&h=200&fit=crop'); ?>" 
                                     alt="<?php echo e($adopcion->planta->nombre ?? 'Planta'); ?>">

                                <div class="pt-last-plant-body">
                                    <h4><?php echo e($adopcion->planta->nombre ?? 'Planta sin nombre'); ?></h4>
                                    <p>Adoptada el <?php echo e($adopcion->created_at->format('d/m/Y')); ?></p>

                                    <div class="pt-last-plant-footer">
                                        <span class="pt-badge green">
                                            <?php echo e($adopcion->planta->tipo_zona ?? 'Interior'); ?>

                                        </span>

                                        <?php if($adopcion->planta): ?>
                                            <a href="<?php echo e(route('catalogo.plantas.show', $adopcion->planta->id)); ?>" class="pt-link green">
                                                Ver →
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

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