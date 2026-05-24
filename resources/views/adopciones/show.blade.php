<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Adoptar planta</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <!-- Leaflet CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ========== ESTILOS GLOBALES PLANTA TEC ========== */
        /* (Mismo bloque unificado que en las demás vistas) */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'DM Sans', 'Figtree', sans-serif;
            background: #f6f8f5;
            color: #1f2937;
        }
        .pt-app { min-height: 100vh; }
        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --blanco: #ffffff;
            --sombra-suave: 0 12px 28px rgba(0, 32, 0, 0.08);
            --sombra-elevada: 0 20px 35px rgba(0, 0, 0, 0.12);
        }

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
        .pt-card {
            background: #ffffff;
            border: 1px solid #f3f4f6;
            border-radius: 1.25rem;
            padding: 1.75rem;
            box-shadow: 0 4px 14px rgba(0,0,0,0.04);
        }
        .pt-card-title { font-size: 1.05rem; font-weight: 800; color: #111827; }
        .pt-text { font-size: 0.875rem; color: #6b7280; }
        .pt-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .pt-badge.green { background: #dcfce7; color: #15803d; }
        .pt-muted { font-size: 0.75rem; color: #9ca3af; }
        .pt-description { margin-top: 1.25rem; color: #374151; line-height: 1.7; }
        .pt-description strong { color: #111827; }
        .pt-submit-btn {
            width: 100%;
            background: linear-gradient(105deg, #2b7840, #3e8a5a);
            color: white;
            border: none;
            padding: 0.9rem 1.2rem;
            border-radius: 999px;
            font-weight: 900;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.2s;
        }
        .pt-submit-btn:hover { background: #236a3b; transform: translateY(-1px); box-shadow: 0 8px 18px rgba(43,120,64,0.25); }
        .pt-alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 1rem;
            border-radius: 1rem;
            margin: 1rem 0;
        }
        .pt-alert-error ul { margin: 0; padding-left: 1.2rem; }
        .hidden { display: none !important; }

        /* ========== ESTILOS ESPECÍFICOS DE ADOPTAR PLANTA ========== */
        .pt-catalog-show-card {
            background: #ffffff;
            border-radius: 2rem;
            box-shadow: var(--sombra-elevada);
            margin-bottom: 2rem;
            display: flex;
            overflow: hidden;
            border: 1px solid rgba(100, 140, 110, 0.2);
        }
        .pt-catalog-show-image {
            flex: 1.2;
            min-width: 280px;
            background: linear-gradient(135deg, #e2f0e6, #c8e0d0);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .pt-catalog-show-image img {
            max-width: 100%;
            max-height: 320px;
            object-fit: contain;
            border-radius: 1.5rem;
            filter: drop-shadow(0 8px 12px rgba(0,0,0,0.1));
        }
        .pt-catalog-show-info {
            flex: 2;
            padding: 2rem;
            background: #ffffff;
        }
        .pt-catalog-show-info h3 {
            font-size: 2.1rem;
            font-weight: 900;
            color: #1e3a2f;
            margin-bottom: 0.5rem;
        }
        .pt-show-section { margin-top: 1.5rem; }
        .pt-show-section-title {
            font-size: 1.05rem;
            font-weight: 900;
            color: #166534;
            margin-bottom: 1rem;
        }
        .pt-care-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1rem;
        }
        .pt-care-item {
            background: #f8faf6;
            border-radius: 1.2rem;
            padding: 0.9rem 1rem;
            border-left: 4px solid #2b7840;
        }
        .pt-care-item strong { color: #1e3a2f; font-size: 1rem; }
        .pt-care-item p { font-size: 0.75rem; color: #6f8f7a; margin: 0.25rem 0; }
        .pt-care-item span { font-size: 0.75rem; color: #4b5563; }

        .pt-adoption-form-card {
            background: #ffffff;
            border-radius: 1.75rem;
            border: 1px solid #e5e7eb;
            box-shadow: var(--sombra-suave);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .pt-adoption-form-card .pt-section-title {
            font-size: 1.35rem;
            font-weight: 900;
            color: #111827;
            margin-bottom: 1.5rem;
        }
        .pt-form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .pt-form-group label {
            font-size: 0.9rem;
            font-weight: 800;
            color: #374151;
        }
        .pt-form-group select,
        .pt-form-group input[type="text"],
        .pt-form-group input[type="file"],
        .pt-form-group input[type="number"],
        .pt-form-group textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 1rem;
            border: 1px solid #cde0d4;
            background: #ffffff;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
        }
        .pt-form-group select:focus,
        .pt-form-group input:focus,
        .pt-form-group textarea:focus {
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.12);
        }
        .pt-form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
        .pt-radio-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            background: #f4fbf2;
            padding: 1rem 1.2rem;
            border-radius: 1.25rem;
            border: 1px solid #dbe7df;
        }
        .pt-radio-group label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            font-weight: 800;
            color: #1f2937;
        }
        .pt-radio-group input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: #16a34a;
        }
        .pt-help-text {
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: 0.35rem;
        }
        .pt-info-message {
            font-size: 0.875rem;
            color: #1d4ed8;
            margin-bottom: 0.75rem;
            font-weight: 700;
        }
        .pt-location-box {
            margin-top: 0.9rem;
            padding: 0.9rem 1rem;
            background: #eff6ff;
            border-radius: 1rem;
            border: 1px solid #bfdbfe;
            color: #1e3a8a;
            font-size: 0.875rem;
        }
        .pt-location-box p { margin: 0; }
        .pt-map-component {
            position: relative;
            width: 100%;
            border-radius: 1rem;
            overflow: hidden;
            border: 1px solid #dbe7df;
            box-shadow: 0 10px 22px rgba(0, 32, 0, 0.08);
        }
        .pt-map-toolbar {
            margin-top: 1rem;
            padding: 1rem;
            background: #ffffff;
            border-radius: 1rem;
            border: 1px solid #e5e7eb;
        }
        .pt-map-toolbar-grid {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 1rem;
            align-items: center;
        }
        .pt-map-search {
            display: flex;
            gap: 0.75rem;
        }
        .pt-map-search input {
            flex: 1;
            padding: 0.75rem 1rem;
            border-radius: 999px;
            border: 1px solid #cde0d4;
            outline: none;
        }
        .pt-map-btn.blue, .obtener-geolocation-btn { background: #2563eb; }
        .pt-map-btn.blue:hover, .obtener-geolocation-btn:hover { background: #1d4ed8; }
        .pt-map-btn.green, .buscar-ubicacion-btn { background: #16a34a; }
        .pt-map-btn.green:hover, .buscar-ubicacion-btn:hover { background: #15803d; }
        @media (max-width: 768px) {
            .pt-catalog-show-card { flex-direction: column; }
            .pt-catalog-show-info h3 { font-size: 1.7rem; }
            .pt-adoption-form-card { padding: 1.25rem; }
            .pt-map-toolbar-grid { grid-template-columns: 1fr; }
            .pt-map-search { flex-direction: column; }
        }
    </style>
</head>
<body class="pt-app">

    <!-- ========== BARRA DE NAVEGACIÓN (con Alpine.js) ========== -->
    <nav x-data="{ open: false }" class="pt-navbar">
        <div class="pt-nav-container">
            <div class="pt-nav-inner">
                <div class="pt-nav-left">
                    <a href="{{ route('dashboard') }}" class="pt-logo">
                        <div class="pt-logo-icon">🌿</div>
                        <span>PlantaTec</span>
                    </a>
                    <div class="pt-desktop-menu">
                        <a href="{{ route('dashboard') }}" class="pt-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                        @if(auth()->user()->rol === 'admin')
                            <div class="pt-dropdown" x-data="{ adminOpen: false }">
                                <button @click="adminOpen = !adminOpen" @click.away="adminOpen = false" class="pt-nav-link pt-dropdown-btn">Administración <span>⌄</span></button>
                                <div x-show="adminOpen" x-transition class="pt-dropdown-menu" style="display:none;">
                                    <a href="{{ route('plantas.index') }}">Plantas</a>
                                    <a href="{{ route('adopciones.index') }}">Adopciones</a>
                                    <a href="{{ route('ubicaciones.index') }}">Ubicaciones</a>
                                    <a href="{{ route('cuidados.index') }}">Cuidados</a>
                                    <a href="{{ route('planta-cuidados.index') }}">Asignar cuidados</a>
                                    <a href="{{ route('recomendaciones-cuidado.index') }}">Recomendaciones de cuidado</a>
                                    <a href="{{ route('recomendaciones-zona.index') }}">Recomendaciones de zona</a>
                                    <a href="{{ route('problemas.index') }}">Problemas</a>
                                    <a href="{{ route('tratamientos.index') }}">Tratamientos</a>
                                    <hr>
                                    <a href="{{ route('reporte-problemas.index') }}">Reportes de problemas</a>
                                    <a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('catalogo.plantas') }}" class="pt-nav-link {{ request()->routeIs('catalogo.plantas') ? 'active' : '' }}">Catálogo</a>
                            <a href="{{ route('adopciones.index') }}" class="pt-nav-link {{ request()->routeIs('adopciones.*') ? 'active' : '' }}">Mis adopciones</a>
                            @php $notificacionesNoLeidas = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count(); @endphp
                            <a href="{{ route('notificaciones.index') }}" class="pt-nav-link pt-nav-notification {{ request()->routeIs('notificaciones.*') ? 'active' : '' }}">
                                Notificaciones
                                @if($notificacionesNoLeidas > 0)
                                    <span class="pt-nav-badge">{{ $notificacionesNoLeidas > 9 ? '9+' : $notificacionesNoLeidas }}</span>
                                @endif
                            </a>
                        @endif
                    </div>
                </div>
                <div class="pt-user-menu" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="pt-user-btn">
                        <div class="pt-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <div class="pt-user-text"><p>{{ Auth::user()->name }}</p><span>{{ Auth::user()->rol === 'admin' ? 'Administrador' : 'Usuario' }}</span></div>
                        <span class="pt-user-arrow">⌄</span>
                    </button>
                    <div x-show="dropdownOpen" x-transition class="pt-user-dropdown" style="display:none;">
                        <div class="pt-user-info"><p>{{ Auth::user()->name }}</p><span>{{ Auth::user()->email }}</span></div>
                        <a href="{{ route('profile.edit') }}">Mi perfil</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Cerrar sesión</button></form>
                    </div>
                </div>
                <button @click="open = !open" class="pt-mobile-btn"><span x-show="!open">☰</span><span x-show="open" style="display:none;">×</span></button>
            </div>
        </div>
        <div x-show="open" x-transition class="pt-mobile-menu" style="display:none;">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            @if(auth()->user()->rol === 'admin')
                <a href="{{ route('plantas.index') }}">Plantas</a>
                <a href="{{ route('adopciones.index') }}">Adopciones</a>
                <a href="{{ route('ubicaciones.index') }}">Ubicaciones</a>
                <a href="{{ route('cuidados.index') }}">Cuidados</a>
                <a href="{{ route('planta-cuidados.index') }}">Asignar cuidados</a>
                <a href="{{ route('recomendaciones-cuidado.index') }}">Recomendaciones de cuidado</a>
                <a href="{{ route('recomendaciones-zona.index') }}">Recomendaciones de zona</a>
                <a href="{{ route('problemas.index') }}">Problemas</a>
                <a href="{{ route('tratamientos.index') }}">Tratamientos</a>
                <a href="{{ route('reporte-problemas.index') }}">Reportes de problemas</a>
                <a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
            @else
                <a href="{{ route('catalogo.plantas') }}">Catálogo</a>
                <a href="{{ route('adopciones.index') }}">Mis adopciones</a>
                @php $notificacionesNoLeidasMovil = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count(); @endphp
                <a href="{{ route('notificaciones.index') }}">Notificaciones @if($notificacionesNoLeidasMovil > 0)<span class="pt-nav-badge">{{ $notificacionesNoLeidasMovil > 9 ? '9+' : $notificacionesNoLeidasMovil }}</span>@endif</a>
            @endif
            <div class="pt-mobile-user"><div class="pt-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div><div><p>{{ Auth::user()->name }}</p><span>{{ Auth::user()->email }}</span></div></div>
            <a href="{{ route('profile.edit') }}">Mi perfil</a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Cerrar sesión</button></form>
        </div>
    </nav>

    <!-- ========== CONTENIDO PRINCIPAL ========== -->
    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-catalog-show-card">
                <div class="pt-catalog-show-image">
                    @php
                        $imagenUrl = 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&fit=crop';
                        if ($planta->imagen) {
                            if (filter_var($planta->imagen, FILTER_VALIDATE_URL)) {
                                $imagenUrl = $planta->imagen;
                            } elseif (file_exists(public_path('storage/' . $planta->imagen))) {
                                $imagenUrl = asset('storage/' . $planta->imagen);
                            }
                        }
                    @endphp
                    <img src="{{ $imagenUrl }}" alt="{{ $planta->nombre }}">
                </div>
                <div class="pt-catalog-show-info">
                    <h3>{{ $planta->nombre }}</h3>
                    <p class="pt-text"><strong>Especie:</strong> {{ $planta->especie }}</p>
                    <span class="pt-badge green">Estado: {{ ucfirst($planta->estado) }}</span>
                    <div class="pt-show-section">
                        <h4 class="pt-show-section-title">Cuidados necesarios</h4>
                        @if($planta->plantaCuidados && $planta->plantaCuidados->count())
                            <div class="pt-care-grid">
                                @foreach($planta->plantaCuidados as $pc)
                                    <div class="pt-care-item">
                                        <strong>{{ $pc->cuidado->nombre }}</strong>
                                        <p>Cada {{ $pc->frecuencia }} días</p>
                                        @if($pc->instrucciones_esp)
                                            <span>{{ Str::limit($pc->instrucciones_esp, 60) }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="pt-muted">No se han definido cuidados específicos para esta planta.</p>
                        @endif
                    </div>
                    <div class="pt-show-section">
                        <p class="pt-text"><strong>Zona recomendada:</strong> {{ $planta->tipo_zona ?? 'No especificada' }}</p>
                        <p class="pt-description">{{ $planta->descripcion ?? 'Sin descripción.' }}</p>
                    </div>
                </div>
            </div>

            <div class="pt-card pt-adoption-form-card">
                <h4 class="pt-section-title">Datos de ubicación para la adopción</h4>
                @if($errors->any())
                    <div class="pt-alert-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="formulario-adopcion" action="{{ route('catalogo.plantas.adoptar', $planta) }}" method="POST">
                    @csrf
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
                                <label><input type="radio" name="metodo_ubicacion_publica" value="zona" checked class="metodo-ubicacion" data-metodo="zona"> <span>Elegir zona recomendada</span></label>
                                <label><input type="radio" name="metodo_ubicacion_publica" value="mapa" class="metodo-ubicacion" data-metodo="mapa"> <span>Seleccionar en el mapa</span></label>
                            </div>
                        </div>
                        <div id="subopcion-zona" class="pt-form-group">
                            <label>Zona pública recomendada</label>
                            <select name="id_recomendacion_zona">
                                <option value="">Selecciona una zona</option>
                                @foreach($zonasRecomendadas as $zona)
                                    <option value="{{ $zona->id }}">{{ $zona->nombre_lugar }} - {{ $zona->tipo_zona ?? 'Sin tipo' }}</option>
                                @endforeach
                            </select>
                            <p class="pt-help-text">Se tomarán automáticamente los datos de la zona.</p>
                        </div>
                        <div id="subopcion-mapa" class="hidden">
                            <p class="pt-info-message">Selecciona tu ubicación en el mapa o usa geolocalización.</p>
                            <x-mapa-interactivo id="mapa-adopcion-publica" :canSelectLocation="true" showToolbar="true" height="400px" />
                            <div class="pt-location-box">
                                <p>Ubicación elegida: <strong id="ubicacion-seleccionada-publica">Ninguna</strong></p>
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
                                <label><input type="radio" name="metodo_ubicacion_privada" value="nombre" checked class="metodo-ubicacion" data-metodo="nombre"> <span>Solo nombre</span></label>
                                <label><input type="radio" name="metodo_ubicacion_privada" value="mapa" class="metodo-ubicacion" data-metodo="mapa"> <span>Con ubicación exacta (mapa)</span></label>
                            </div>
                        </div>
                        <div id="subopcion-nombre" class="pt-form-group">
                            <label>Nombre del lugar privado</label>
                            <input type="text" name="nombre_lugar_privado" placeholder="Ejemplo: Mi casa, patio trasero, jardín familiar">
                            <label>Descripción (opcional)</label>
                            <textarea name="descripcion_privada" rows="2" placeholder="Comparte detalles como luz, sombra, etc."></textarea>
                        </div>
                        <div id="subopcion-mapa-privada" class="hidden">
                            <p class="pt-info-message">Selecciona tu ubicación en el mapa.</p>
                            <x-mapa-interactivo id="mapa-adopcion-privada" :canSelectLocation="true" showToolbar="true" height="400px" />
                            <div class="pt-location-box">
                                <p>Ubicación elegida: <strong id="ubicacion-seleccionada-privada">Ninguna</strong></p>
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

                    <button type="submit" class="pt-submit-btn">Adoptar {{ $planta->nombre }}</button>
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
                    setTimeout(() => window.mapaInstancias['mapa-adopcion-publica'].invalidateSize(), 50);
                }
            });
        });

        document.querySelectorAll('input[name="metodo_ubicacion_privada"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const metodo = this.value;
                document.getElementById('subopcion-nombre').classList.toggle('hidden', metodo !== 'nombre');
                document.getElementById('subopcion-mapa-privada').classList.toggle('hidden', metodo !== 'mapa');
                if (metodo === 'mapa' && window.mapaInstancias && window.mapaInstancias['mapa-adopcion-privada']) {
                    setTimeout(() => window.mapaInstancias['mapa-adopcion-privada'].invalidateSize(), 50);
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
</body>
</html>