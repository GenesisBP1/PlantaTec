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
                <p class="pt-header-label">Panel de Control</p>
                <h2 class="pt-header-title">
                    Bienvenido, <?php echo e(Auth::user()->name); ?> 🌿
                </h2>
                <p class="pt-header-subtitle">
                    Resumen general del sistema · <?php echo e(now()->format('d M Y')); ?>

                </p>
            </div>

            <div class="pt-header-actions">
                <a href="<?php echo e(route('plantas.create')); ?>" class="pt-btn pt-btn-green">
                    Nueva planta
                </a>

                <a href="<?php echo e(route('recomendaciones-cuidado.index')); ?>" class="pt-btn pt-btn-light">
                    Recomendaciones
                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-metrics-grid">
                <div class="pt-metric-card green">
                    <div class="pt-metric-circle"></div>
                    <div class="pt-metric-content">
                        <div class="pt-metric-icon">🌿</div>
                        <p class="pt-label">Plantas</p>
                        <p class="pt-number"><?php echo e($totalPlantas); ?></p>
                        <a href="<?php echo e(route('plantas.index')); ?>" class="pt-link green">Ver todas →</a>
                    </div>
                </div>

                <div class="pt-metric-card blue">
                    <div class="pt-metric-circle"></div>
                    <div class="pt-metric-content">
                        <div class="pt-metric-icon">👥</div>
                        <p class="pt-label">Usuarios registrados</p>
                        <p class="pt-number"><?php echo e($totalUsuarios); ?></p>
                        <span class="pt-muted">Activos en el sistema</span>
                    </div>
                </div>

                <div class="pt-metric-card violet">
                    <div class="pt-metric-circle"></div>
                    <div class="pt-metric-content">
                        <div class="pt-metric-icon">💜</div>
                        <p class="pt-label">Plantas adoptadas</p>
                        <p class="pt-number"><?php echo e($totalAdopciones); ?></p>
                        <a href="<?php echo e(route('adopciones.index')); ?>" class="pt-link violet">Ver adopciones →</a>
                    </div>
                </div>

                <div class="pt-metric-card amber">
                    <div class="pt-metric-circle"></div>
                    <div class="pt-metric-content">
                        <div class="pt-metric-icon">⚠️</div>
                        <p class="pt-label">Problemas activos</p>
                        <p class="pt-number"><?php echo e($problemasActivos); ?></p>
                        <a href="<?php echo e(route('reporte-problemas.index')); ?>" class="pt-link amber">Ver reportes →</a>
                    </div>
                </div>
            </div>

            <div class="pt-info-grid">
                <div class="pt-card">
                    <div class="pt-card-header">
                        <div>
                            <h3 class="pt-card-title">Planta más adoptada</h3>
                            <p class="pt-card-subtitle">La planta con más adopciones registradas</p>
                        </div>
                        <span class="pt-badge green">Real</span>
                    </div>

                    <?php if($plantaMasAdoptada): ?>
                        <div class="pt-plant-row">
                            <div class="pt-plant-image">
                                <img src="<?php echo e($plantaMasAdoptada->imagen ? (str_starts_with($plantaMasAdoptada->imagen, 'http') ? $plantaMasAdoptada->imagen : asset('storage/' . $plantaMasAdoptada->imagen)) : 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=400&h=250&fit=crop'); ?>"
                                     alt="<?php echo e($plantaMasAdoptada->nombre); ?>">
                            </div>

                            <div class="pt-plant-info">
                                <p class="pt-plant-name"><?php echo e($plantaMasAdoptada->nombre); ?></p>
                                <p class="pt-text"><?php echo e($plantaMasAdoptada->adopciones_count); ?> adopciones registradas</p>
                                <p class="pt-muted">Zona: <?php echo e($plantaMasAdoptada->tipo_zona ?? 'No definida'); ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="pt-empty">
                            Aún no hay adopciones registradas para calcular este dato.
                        </div>
                    <?php endif; ?>
                </div>

                <div class="pt-card">
                    <div class="pt-card-header">
                        <div>
                            <h3 class="pt-card-title">Zonas recomendadas disponibles</h3>
                            <p class="pt-card-subtitle">Ubicaciones que usuarios pueden elegir</p>
                        </div>

                        <?php
                            $totalZonas = \App\Models\RecomendacionZona::count();
                        ?>

                        <span class="pt-badge green"><?php echo e($totalZonas); ?> zonas</span>
                    </div>

                    <?php
                        $zonas = \App\Models\RecomendacionZona::orderBy('nombre_lugar')->get();
                    ?>

                    <?php if($zonas->count() > 0): ?>
                        <div class="pt-zone-list">
                            <?php $__currentLoopData = $zonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="pt-zone-item">
                                    <div class="pt-zone-main">
                                        <p class="pt-zone-title"><?php echo e($zona->nombre_lugar); ?></p>

                                        <div class="pt-zone-tags">
                                            <span class="pt-badge blue"><?php echo e($zona->tipo_zona); ?></span>

                                            <?php if($zona->descripcion): ?>
                                                <span class="pt-zone-description"><?php echo e($zona->descripcion); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="pt-zone-coords">
                                        <p class="pt-muted">Coordenadas</p>
                                        <p class="pt-code">
                                            <?php echo e(number_format($zona->latitud, 4)); ?>,
                                            <?php echo e(number_format($zona->longitud, 4)); ?>

                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="pt-empty center">
                            <div class="pt-empty-icon">📍</div>
                            <p class="pt-empty-title">No hay zonas recomendadas configuradas</p>
                            <p class="pt-muted">Crea zonas en la sección de administración.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-card pt-section">
                <div class="pt-section-header">
                    <div>
                        <h3 class="pt-section-title">Gestión rápida</h3>
                        <p class="pt-card-subtitle">Accede a cualquier módulo del sistema</p>
                    </div>
                </div>

                <div class="pt-access-grid">
                    <?php
                    $accesos = [
                        ['route' => 'plantas.index', 'label' => 'Plantas', 'icon' => '🌿', 'color' => 'green'],
                        ['route' => 'ubicaciones.index', 'label' => 'Ubicaciones', 'icon' => '📍', 'color' => 'blue'],
                        ['route' => 'adopciones.index', 'label' => 'Adopciones', 'icon' => '💜', 'color' => 'violet'],
                        ['route' => 'cuidados.index', 'label' => 'Cuidados', 'icon' => '📋', 'color' => 'cyan'],
                        ['route' => 'planta-cuidados.index', 'label' => 'Asignar cuidados', 'icon' => '✅', 'color' => 'emerald'],
                        ['route' => 'problemas.index', 'label' => 'Problemas', 'icon' => '⚠️', 'color' => 'orange'],
                        ['route' => 'tratamientos.index', 'label' => 'Tratamientos', 'icon' => '🧪', 'color' => 'yellow'],
                        ['route' => 'recomendaciones-cuidado.index', 'label' => 'Recomendaciones', 'icon' => '🔔', 'color' => 'red'],
                        ['route' => 'notificaciones.index', 'label' => 'Notificaciones', 'icon' => '🔔', 'color' => 'gray'],
                        ['route' => 'reporte-problemas.index', 'label' => 'Reportes de problemas', 'icon' => '🚨', 'color' => 'pink'],
                    ];
                    ?>

                    <?php $__currentLoopData = $accesos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route($item['route'])); ?>" class="pt-access-btn <?php echo e($item['color']); ?>">
                            <span class="pt-access-icon"><?php echo e($item['icon']); ?></span>
                            <span><?php echo e($item['label']); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="pt-map-card">
                <div class="pt-map-header">
                    <div>
                        <h3 class="pt-section-title">🗺️ Mapa de ubicaciones</h3>
                        <p class="pt-card-subtitle">
                            Visualiza todas las ubicaciones públicas y privadas de adopciones
                        </p>
                    </div>

                    <a href="<?php echo e(route('mapa.index')); ?>" class="pt-link green">
                        Ver mapa completo →
                    </a>
                </div>

                <div class="pt-map-body">
                    <?php if (isset($component)) { $__componentOriginal81c72807132ffb34a5ed67ad325fbcfc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81c72807132ffb34a5ed67ad325fbcfc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.mapa-interactivo','data' => ['id' => 'mapa-admin','canSelectLocation' => false,'showToolbar' => 'false','height' => '550px']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mapa-interactivo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'mapa-admin','canSelectLocation' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'showToolbar' => 'false','height' => '550px']); ?>
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>