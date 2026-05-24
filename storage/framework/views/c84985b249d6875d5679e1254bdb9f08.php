<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Editar ubicación</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <!-- Leaflet CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ========== ESTILOS GLOBALES PLANTA TEC (unificados) ========== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'DM Sans', 'Figtree', sans-serif;
            background: #f6f8f5;
            color: #1f2937;
        }
        .pt-app { min-height: 100vh; }

        /* ========== BARRA DE NAVEGACIÓN (común) ========== */
        .pt-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }
        .pt-nav-container { max-width: 1280px; margin: 0 auto; padding: 0 1rem; }
        .pt-nav-inner { height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .pt-nav-left { display: flex; align-items: center; gap: 2rem; }
        .pt-logo { display: flex; align-items: center; gap: 0.6rem; text-decoration: none; color: #1f2937; font-size: 1.25rem; font-weight: 900; }
        .pt-logo-icon { width: 34px; height: 34px; border-radius: 0.9rem; background: linear-gradient(135deg, #16a34a, #047857); color: #ffffff; display: flex; align-items: center; justify-content: center; }
        .pt-desktop-menu { display: flex; align-items: center; gap: 0.25rem; }
        .pt-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.6rem 0.85rem;
            border-radius: 0.75rem;
            color: #374151;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 700;
            background: transparent;
            border: none;
            cursor: pointer;
        }
        .pt-nav-link:hover, .pt-nav-link.active { background: #f0fdf4; color: #15803d; }
        .pt-dropdown { position: relative; }
        .pt-dropdown-menu, .pt-user-dropdown {
            position: absolute;
            top: 115%;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 16px 32px rgba(0,0,0,0.12);
            overflow: hidden;
            z-index: 100;
            min-width: 220px;
        }
        .pt-dropdown-menu a, .pt-user-dropdown a, .pt-user-dropdown button {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            color: #374151;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            text-align: left;
            background: transparent;
            border: none;
            cursor: pointer;
        }
        .pt-dropdown-menu a:hover, .pt-user-dropdown a:hover, .pt-user-dropdown button:hover { background: #f0fdf4; color: #15803d; }
        .pt-dropdown-menu hr { margin: 0.35rem 0; border-top: 1px solid #e5e7eb; }
        .pt-nav-notification { padding-right: 1.3rem; }
        .pt-nav-badge { background: #ef4444; color: #ffffff; border-radius: 999px; font-size: 0.68rem; padding: 0.1rem 0.4rem; margin-left: 0.3rem; }
        .pt-user-menu { position: relative; }
        .pt-user-btn { display: flex; align-items: center; gap: 0.65rem; padding: 0.45rem 0.7rem; border-radius: 0.9rem; background: #f9fafb; border: 1px solid #e5e7eb; cursor: pointer; }
        .pt-user-btn:hover { background: #f3f4f6; }
        .pt-avatar { width: 34px; height: 34px; border-radius: 999px; background: linear-gradient(135deg, #16a34a, #047857); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 900; }
        .pt-user-text p { margin: 0; font-weight: 800; color: #1f2937; font-size: 0.875rem; }
        .pt-user-text span { font-size: 0.75rem; color: #6b7280; }
        .pt-user-arrow { color: #6b7280; }
        .pt-user-dropdown { right: 0; }
        .pt-user-info { padding: 1rem; border-bottom: 1px solid #e5e7eb; }
        .pt-user-info p { margin: 0; font-weight: 800; }
        .pt-user-info span { display: block; font-size: 0.75rem; color: #6b7280; }
        .pt-mobile-btn { display: none; background: #f3f4f6; border: none; width: 40px; height: 40px; border-radius: 0.75rem; font-size: 1.4rem; cursor: pointer; }
        .pt-mobile-menu { display: none; background: #ffffff; border-top: 1px solid #e5e7eb; padding: 0.75rem 1rem; }
        .pt-mobile-menu a, .pt-mobile-menu button { display: block; width: 100%; padding: 0.75rem; border-radius: 0.75rem; color: #374151; text-decoration: none; font-weight: 700; background: transparent; border: none; text-align: left; cursor: pointer; }
        .pt-mobile-menu a:hover, .pt-mobile-menu button:hover { background: #f0fdf4; color: #15803d; }
        .pt-mobile-user { display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0.75rem; border-top: 1px solid #e5e7eb; margin-top: 0.5rem; }
        @media (max-width: 768px) {
            .pt-desktop-menu, .pt-user-menu { display: none; }
            .pt-mobile-btn { display: flex; align-items: center; justify-content: center; }
            .pt-mobile-menu { display: block; }
        }

        /* ========== LAYOUT Y COMPONENTES COMUNES ========== */
        .pt-container { max-width: 1280px; margin: 0 auto; padding: 0 1.5rem; }
        .pt-page { padding: 3.5rem 0; }
        .pt-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1rem;
            border-radius: 0.9rem;
            font-size: 0.875rem;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .pt-btn-green { background: #16a34a; color: #ffffff; }
        .pt-btn-green:hover { background: #15803d; }
        .pt-btn-yellow { background: #d97706; color: white; }
        .pt-btn-yellow:hover { background: #b45309; }
        .pt-btn-dark { background: #475569; color: white; }
        .pt-btn-dark:hover { background: #334155; }

        /* ========== ESTILOS ESPECÍFICOS DE REGISTRO/EDICIÓN DE UBICACIÓN ========== */
        .pt-form-card {
            background: #ffffff;
            border-radius: 1.75rem;
            border: 1px solid #dbe7df;
            box-shadow: 0 12px 28px rgba(0,32,0,0.08);
            padding: 2rem;
        }
        .pt-form-intro { margin-bottom: 1.8rem; }
        .pt-header-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #16a34a;
            margin-bottom: 0.25rem;
        }
        .pt-form-title {
            font-size: 2rem;
            font-weight: 900;
            color: #1e3a2f;
            margin: 0.4rem 0;
        }
        .pt-form-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
        }
        .pt-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
        .pt-form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .pt-form-group.full {
            grid-column: 1 / -1;
        }
        .pt-form-group label {
            font-weight: 800;
            color: #374151;
            font-size: 0.9rem;
        }
        .pt-form-group input,
        .pt-form-group select,
        .pt-form-group textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 1rem;
            border: 1px solid #cde0d4;
            background: #ffffff;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            transition: 0.2s;
        }
        .pt-form-group input:focus,
        .pt-form-group select:focus,
        .pt-form-group textarea:focus {
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43,120,64,0.1);
        }
        .pt-form-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .mapa-container {
            width: 100%;
            height: 400px;
            border-radius: 1rem;
            border: 1px solid #dbe7df;
            overflow: hidden;
            margin-top: 0.5rem;
        }
        .mapa-toolbar {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
            flex-wrap: wrap;
        }
        .mapa-btn {
            background: #16a34a;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
        }
        .mapa-btn.blue {
            background: #2563eb;
        }
        .mapa-btn.blue:hover {
            background: #1d4ed8;
        }
        @media (max-width: 768px) {
            .pt-form-grid { grid-template-columns: 1fr; }
            .pt-form-card { padding: 1.25rem; }
            .pt-form-title { font-size: 1.6rem; }
        }
    </style>
</head>
<body class="pt-app">

    <!-- ========== BARRA DE NAVEGACIÓN (con Alpine.js) ========== -->
    <nav x-data="{ open: false }" class="pt-navbar">
        <div class="pt-nav-container">
            <div class="pt-nav-inner">
                <div class="pt-nav-left">
                    <a href="<?php echo e(route('dashboard')); ?>" class="pt-logo">
                        <div class="pt-logo-icon">🌿</div>
                        <span>PlantaTec</span>
                    </a>
                    <div class="pt-desktop-menu">
                        <a href="<?php echo e(route('dashboard')); ?>" class="pt-nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">Dashboard</a>
                        <?php if(auth()->user()->rol === 'admin'): ?>
                            <div class="pt-dropdown" x-data="{ adminOpen: false }">
                                <button @click="adminOpen = !adminOpen" @click.away="adminOpen = false" class="pt-nav-link pt-dropdown-btn">Administración <span>⌄</span></button>
                                <div x-show="adminOpen" x-transition class="pt-dropdown-menu" style="display:none;">
                                    <a href="<?php echo e(route('plantas.index')); ?>">Plantas</a>
                                    <a href="<?php echo e(route('adopciones.index')); ?>">Adopciones</a>
                                    <a href="<?php echo e(route('ubicaciones.index')); ?>">Ubicaciones</a>
                                    <a href="<?php echo e(route('cuidados.index')); ?>">Cuidados</a>
                                    <a href="<?php echo e(route('planta-cuidados.index')); ?>">Asignar cuidados</a>
                                    <a href="<?php echo e(route('recomendaciones-cuidado.index')); ?>">Recomendaciones de cuidado</a>
                                    <a href="<?php echo e(route('recomendaciones-zona.index')); ?>">Recomendaciones de zona</a>
                                    <a href="<?php echo e(route('problemas.index')); ?>">Problemas</a>
                                    <a href="<?php echo e(route('tratamientos.index')); ?>">Tratamientos</a>
                                    <hr>
                                    <a href="<?php echo e(route('reporte-problemas.index')); ?>">Reportes de problemas</a>
                                    <a href="<?php echo e(route('admin.usuarios.index')); ?>">Usuarios</a>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo e(route('catalogo.plantas')); ?>" class="pt-nav-link <?php echo e(request()->routeIs('catalogo.plantas') ? 'active' : ''); ?>">Catálogo</a>
                            <a href="<?php echo e(route('adopciones.index')); ?>" class="pt-nav-link <?php echo e(request()->routeIs('adopciones.*') ? 'active' : ''); ?>">Mis adopciones</a>
                            <?php $notificacionesNoLeidas = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count(); ?>
                            <a href="<?php echo e(route('notificaciones.index')); ?>" class="pt-nav-link pt-nav-notification <?php echo e(request()->routeIs('notificaciones.*') ? 'active' : ''); ?>">
                                Notificaciones
                                <?php if($notificacionesNoLeidas > 0): ?>
                                    <span class="pt-nav-badge"><?php echo e($notificacionesNoLeidas > 9 ? '9+' : $notificacionesNoLeidas); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="pt-user-menu" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="pt-user-btn">
                        <div class="pt-avatar"><?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?></div>
                        <div class="pt-user-text"><p><?php echo e(Auth::user()->name); ?></p><span><?php echo e(Auth::user()->rol === 'admin' ? 'Administrador' : 'Usuario'); ?></span></div>
                        <span class="pt-user-arrow">⌄</span>
                    </button>
                    <div x-show="dropdownOpen" x-transition class="pt-user-dropdown" style="display:none;">
                        <div class="pt-user-info"><p><?php echo e(Auth::user()->name); ?></p><span><?php echo e(Auth::user()->email); ?></span></div>
                        <a href="<?php echo e(route('profile.edit')); ?>">Mi perfil</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button type="submit">Cerrar sesión</button></form>
                    </div>
                </div>
                <button @click="open = !open" class="pt-mobile-btn"><span x-show="!open">☰</span><span x-show="open" style="display:none;">×</span></button>
            </div>
        </div>
        <div x-show="open" x-transition class="pt-mobile-menu" style="display:none;">
            <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
            <?php if(auth()->user()->rol === 'admin'): ?>
                <a href="<?php echo e(route('plantas.index')); ?>">Plantas</a>
                <a href="<?php echo e(route('adopciones.index')); ?>">Adopciones</a>
                <a href="<?php echo e(route('ubicaciones.index')); ?>">Ubicaciones</a>
                <a href="<?php echo e(route('cuidados.index')); ?>">Cuidados</a>
                <a href="<?php echo e(route('planta-cuidados.index')); ?>">Asignar cuidados</a>
                <a href="<?php echo e(route('recomendaciones-cuidado.index')); ?>">Recomendaciones de cuidado</a>
                <a href="<?php echo e(route('recomendaciones-zona.index')); ?>">Recomendaciones de zona</a>
                <a href="<?php echo e(route('problemas.index')); ?>">Problemas</a>
                <a href="<?php echo e(route('tratamientos.index')); ?>">Tratamientos</a>
                <a href="<?php echo e(route('reporte-problemas.index')); ?>">Reportes de problemas</a>
                <a href="<?php echo e(route('admin.usuarios.index')); ?>">Usuarios</a>
            <?php else: ?>
                <a href="<?php echo e(route('catalogo.plantas')); ?>">Catálogo</a>
                <a href="<?php echo e(route('adopciones.index')); ?>">Mis adopciones</a>
                <a href="<?php echo e(route('notificaciones.index')); ?>">Notificaciones</a>
            <?php endif; ?>
            <div class="pt-mobile-user">
                <div class="pt-avatar"><?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?></div>
                <div><p><?php echo e(Auth::user()->name); ?></p><span><?php echo e(Auth::user()->email); ?></span></div>
            </div>
            <a href="<?php echo e(route('profile.edit')); ?>">Mi perfil</a>
            <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button type="submit">Cerrar sesión</button></form>
        </div>
    </nav>

    <!-- ========== CONTENIDO PRINCIPAL ========== -->
    <div class="pt-page">
        <div class="pt-container">
            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">Actualizar ubicación</h3>
                    <p class="pt-form-subtitle">Modifica la ubicación, descripción o selecciona una nueva posición en el mapa.</p>
                </div>

                <form action="<?php echo e(route('ubicaciones.update', $ubicacion)); ?>" method="POST" id="formulario-ubicacion">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="pt-form-grid">
                        <div class="pt-form-group">
                            <label>Tipo</label>
                            <select name="tipo">
                                <option value="publico" <?php echo e($ubicacion->tipo == 'publico' ? 'selected' : ''); ?>>Público</option>
                                <option value="privado" <?php echo e($ubicacion->tipo == 'privado' ? 'selected' : ''); ?>>Privado</option>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Zona recomendada (opcional)</label>
                            <select name="id_recomendacion_zona" id="zona-select">
                                <option value="">Selecciona una zona para llenar automáticamente</option>
                                <?php $zonas = \App\Models\RecomendacionZona::orderBy('nombre_lugar')->get(); ?>
                                <?php $__empty_1 = true; $__currentLoopData = $zonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option value="<?php echo e($zona->id); ?>"><?php echo e($zona->nombre_lugar); ?> (<?php echo e($zona->tipo_zona); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <option disabled>No hay zonas recomendadas registradas</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Selecciona ubicación en el mapa</label>
                            <div id="mapa-editar" class="mapa-container"></div>
                            <div class="mapa-toolbar">
                                <button type="button" id="geolocalizar-editar" class="mapa-btn blue">📍 Usar mi ubicación</button>
                            </div>
                        </div>

                        <div class="pt-form-group full">
                            <label>Nombre del lugar</label>
                            <input type="text" name="nombre_lugar" id="nombre-lugar" value="<?php echo e(old('nombre_lugar', $ubicacion->nombre_lugar)); ?>" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4"><?php echo e(old('descripcion', $ubicacion->descripcion)); ?></textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Latitud</label>
                            <input type="text" name="latitud" id="latitud" value="<?php echo e(old('latitud', $ubicacion->latitud)); ?>" readonly>
                        </div>

                        <div class="pt-form-group">
                            <label>Longitud</label>
                            <input type="text" name="longitud" id="longitud" value="<?php echo e(old('longitud', $ubicacion->longitud)); ?>" readonly>
                        </div>
                    </div>

                    <div class="pt-form-actions">
                        <a href="<?php echo e(route('ubicaciones.index')); ?>" class="pt-btn pt-btn-dark">Cancelar</a>
                        <button type="submit" class="pt-btn pt-btn-yellow">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Datos de zonas desde PHP
        const zonasData = <?php echo json_encode(\App\Models\RecomendacionZona::all()->map(fn($z) => [
            'id' => $z->id, 'nombre' => $z->nombre_lugar, 'descripcion' => $z->descripcion) ?>;

        let mapa;
        let marcador;

        // Coordenadas iniciales (de la ubicación actual o valores por defecto)
        const latInicial = <?php echo e($ubicacion->latitud ?? 20.6597); ?>;
        const lngInicial = <?php echo e($ubicacion->longitud ?? -103.3496); ?>;

        function initMapa() {
            if (mapa) return; // Evitar inicializar dos veces
            mapa = L.map('mapa-editar').setView([latInicial, lngInicial], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(mapa);

            marcador = L.marker([latInicial, lngInicial], { draggable: true }).addTo(mapa);
            actualizarInputsDesdeMarcador();

            marcador.on('dragend', function() {
                const pos = marcador.getLatLng();
                actualizarInputs(pos.lat, pos.lng);
            });

            mapa.on('click', function(e) {
                marcador.setLatLng(e.latlng);
                actualizarInputs(e.latlng.lat, e.latlng.lng);
            });
        }

        function actualizarInputs(lat, lng) {
            document.getElementById('latitud').value = lat.toFixed(7);
            document.getElementById('longitud').value = lng.toFixed(7);
        }

        function actualizarInputsDesdeMarcador() {
            if (marcador) {
                const pos = marcador.getLatLng();
                actualizarInputs(pos.lat, pos.lng);
            }
        }

        function geolocalizar() {
            if (!navigator.geolocation) {
                alert('Geolocalización no soportada');
                return;
            }
            navigator.geolocation.getCurrentPosition(function(pos) {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                mapa.setView([lat, lng], 15);
                marcador.setLatLng([lat, lng]);
                actualizarInputs(lat, lng);
            }, function() {
                alert('No se pudo obtener tu ubicación');
            });
        }

        const zonaSelect = document.getElementById('zona-select');
        const nombreInput = document.getElementById('nombre-lugar');
        const descInput = document.getElementById('descripcion');

        zonaSelect.addEventListener('change', function() {
            const zona = zonasData[this.value];
            if (zona) {
                nombreInput.value = zona.nombre;
                descInput.value = zona.descripcion || '';
                const lat = parseFloat(zona.latitud);
                const lng = parseFloat(zona.longitud);
                mapa.setView([lat, lng], 15);
                marcador.setLatLng([lat, lng]);
                actualizarInputs(lat, lng);
            }
        });

        document.getElementById('geolocalizar-editar').addEventListener('click', geolocalizar);
        document.addEventListener('DOMContentLoaded', initMapa);

        // Validación al enviar
        document.getElementById('formulario-ubicacion').addEventListener('submit', function(e) {
            if (!nombreInput.value.trim()) {
                e.preventDefault();
                alert('El nombre del lugar es obligatorio');
                return;
            }
            const lat = document.getElementById('latitud').value;
            const lng = document.getElementById('longitud').value;
            if (!lat || !lng || lat === '' || lng === '') {
                e.preventDefault();
                alert('Debes seleccionar una ubicación en el mapa o elegir una zona recomendada');
            }
        });
    </script>
</body>
</html><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/ubicaciones/edit.blade.php ENDPATH**/ ?>