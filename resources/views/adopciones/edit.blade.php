<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Editar adopción</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <!-- Alpine.js para dropdowns -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ========== ESTILOS GLOBALES PLANTA TEC ========== */
        /* Incluye reset, tipografía, navbar, utilidades, botones, tarjetas, etc. */
        /* (Aquí va el mismo bloque global unificado que ya definimos antes) */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'DM Sans', 'Figtree', sans-serif;
            background: #f6f8f5;
            color: #1f2937;
        }
        .pt-app { min-height: 100vh; }

        /* Colores y sombras globales */
        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --blanco: #ffffff;
            --sombra-suave: 0 12px 28px rgba(0, 32, 0, 0.08);
        }

        /* ========== BARRA DE NAVEGACIÓN (común a todas) ========== */
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
        .pt-card-header {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
        .pt-card-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #111827;
        }
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
        }
        .pt-btn-green { background: #16a34a; color: #ffffff; }
        .pt-btn-green:hover { background: #15803d; }
        .pt-btn-light { background: #ffffff; color: #374151; border: 1px solid #e5e7eb; }
        .pt-btn-light:hover { background: #f9fafb; }

        /* ========== ESTILOS ESPECÍFICOS DE EDITAR ADOPCIÓN ========== */
        .pt-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            background: #ffffff;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        .pt-header-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #16a34a;
            margin-bottom: 0.25rem;
        }
        .pt-header-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #111827;
            line-height: 1.2;
        }
        .pt-header-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        .pt-form-group {
            margin-bottom: 1.5rem;
        }
        .pt-form-group label {
            display: block;
            font-weight: 800;
            color: #374151;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        .pt-form-group select,
        .pt-form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            border: 1px solid #d1d5db;
            background: #ffffff;
            font-family: inherit;
            font-size: 0.95rem;
            transition: 0.2s;
        }
        .pt-form-group select:focus,
        .pt-form-group input:focus {
            outline: none;
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
        }
        .pt-alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 1rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
        }
        .pt-alert-error ul {
            margin: 0.5rem 0 0 1.5rem;
        }
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
            margin-top: 0.5rem;
            transition: 0.2s;
        }
        .pt-submit-btn:hover {
            background: linear-gradient(105deg, #236a3b, #2b7840);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(43,120,64,0.3);
        }
        @media (max-width: 768px) {
            .pt-card { padding: 1.25rem; }
            .pt-header { flex-direction: column; align-items: flex-start; }
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
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
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

            <!-- Cabecera de la página -->
            <div class="pt-header">
                <div>
                    <p class="pt-header-label">Adopciones</p>
                    <h2 class="pt-header-title">Editar adopción</h2>
                    <p class="pt-header-subtitle">Actualiza la ubicación o el estado de la adopción</p>
                </div>
                <div class="pt-header-actions">
                    <a href="{{ route('adopciones.index') }}" class="pt-btn pt-btn-light">← Volver</a>
                </div>
            </div>

            <!-- Tarjeta del formulario -->
            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Formulario de edición</h3>
                </div>

                @if($errors->any())
                    <div class="pt-alert-error">
                        <strong>Revisa los campos:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('adopciones.update', $adopcion->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="pt-form-group">
                        <label for="id_ubicacion">Ubicación</label>
                        <select name="id_ubicacion" id="id_ubicacion">
                            <option value="">-- Seleccionar ubicación --</option>
                            @foreach($ubicaciones as $u)
                                <option value="{{ $u->id }}" {{ optional($adopcion->ubicacion)->id == $u->id ? 'selected' : '' }}>
                                    {{ $u->nombre_lugar }} @if($u->es_publica) (Pública) @else (Privada) @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pt-form-group">
                        <label for="estado_adopcion">Estado de la adopción</label>
                        <select name="estado_adopcion" id="estado_adopcion" required>
                            <option value="activa" {{ $adopcion->estado_adopcion === 'activa' ? 'selected' : '' }}>Activa</option>
                            <option value="cancelada" {{ $adopcion->estado_adopcion === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            <option value="finalizada" {{ $adopcion->estado_adopcion === 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                        </select>
                    </div>

                    <button type="submit" class="pt-submit-btn">Guardar cambios</button>
                </form>
            </div>

        </div>
    </div>

</body>
</html>