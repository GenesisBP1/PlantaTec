<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Asignar cuidado a planta</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <!-- Alpine.js para el dropdown (solo funcionalidad) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ========== ESTILOS GLOBALES PLANTA TEC (barra de navegación y utilidades) ========== */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'DM Sans', 'Figtree', sans-serif;
            background: #f6f8f5;
            color: #1f2937;
        }
        .pt-app {
            min-height: 100vh;
        }
        .pt-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }
        .pt-nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .pt-nav-inner {
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .pt-nav-left {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        .pt-logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            color: #1f2937;
            font-size: 1.25rem;
            font-weight: 900;
        }
        .pt-logo-icon {
            width: 34px;
            height: 34px;
            border-radius: 0.9rem;
            background: linear-gradient(135deg, #16a34a, #047857);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pt-desktop-menu {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .pt-nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.6rem 0.85rem;
            border-radius: 0.75rem;
            color: #374151;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 700;
            border: none;
            background: transparent;
            cursor: pointer;
            font-family: inherit;
            transition: 0.2s ease;
        }
        .pt-nav-link:hover,
        .pt-nav-link.active {
            background: #f0fdf4;
            color: #15803d;
        }
        .pt-dropdown {
            position: relative;
        }
        .pt-dropdown-menu,
        .pt-user-dropdown {
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
        .pt-dropdown-menu {
            left: 0;
            width: 270px;
            padding: 0.4rem;
        }
        .pt-dropdown-menu a,
        .pt-user-dropdown a,
        .pt-user-dropdown button {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            color: #374151;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            font-family: inherit;
        }
        .pt-dropdown-menu a:hover,
        .pt-user-dropdown a:hover,
        .pt-user-dropdown button:hover {
            background: #f0fdf4;
            color: #15803d;
        }
        .pt-dropdown-menu hr {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 0.35rem 0;
        }
        .pt-nav-notification {
            padding-right: 1.3rem;
        }
        .pt-nav-badge {
            background: #ef4444;
            color: #ffffff;
            border-radius: 999px;
            font-size: 0.68rem;
            font-weight: 900;
            padding: 0.1rem 0.4rem;
            margin-left: 0.3rem;
            display: inline-flex;
            align-items: center;
        }
        .pt-user-menu {
            position: relative;
        }
        .pt-user-btn {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.45rem 0.7rem;
            border-radius: 0.9rem;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            font-family: inherit;
        }
        .pt-user-btn:hover {
            background: #f3f4f6;
        }
        .pt-avatar {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            background: linear-gradient(135deg, #16a34a, #047857);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
        }
        .pt-user-text {
            text-align: left;
        }
        .pt-user-text p {
            margin: 0;
            color: #1f2937;
            font-size: 0.875rem;
            font-weight: 800;
        }
        .pt-user-text span {
            font-size: 0.75rem;
            color: #6b7280;
            display: block;
        }
        .pt-user-arrow {
            color: #6b7280;
        }
        .pt-user-dropdown {
            right: 0;
        }
        .pt-user-info {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .pt-user-info p {
            margin: 0;
            font-weight: 800;
            color: #111827;
        }
        .pt-user-info span {
            display: block;
            font-size: 0.75rem;
            color: #6b7280;
        }
        .pt-mobile-btn {
            display: none;
            background: #f3f4f6;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 0.75rem;
            font-size: 1.4rem;
            cursor: pointer;
            color: #374151;
        }
        .pt-mobile-menu {
            display: none;
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            padding: 0.75rem 1rem;
        }
        .pt-mobile-menu a,
        .pt-mobile-menu button {
            display: block;
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.75rem;
            color: #374151;
            text-decoration: none;
            font-weight: 700;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            font-family: inherit;
        }
        .pt-mobile-menu a:hover,
        .pt-mobile-menu a.active,
        .pt-mobile-menu button:hover {
            background: #f0fdf4;
            color: #15803d;
        }
        .pt-mobile-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 0.75rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 0.5rem;
        }
        @media (max-width: 768px) {
            .pt-desktop-menu, .pt-user-menu { display: none; }
            .pt-mobile-btn { display: flex; align-items: center; justify-content: center; }
            .pt-mobile-menu { display: block; }
        }

        /* ========== ESTILOS GENERALES DE CONTENIDO (cabecera, página) ========== */
        .pt-page {
            padding: 3.5rem 0;
        }
        .pt-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        .pt-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
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
        .pt-header-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
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
            border: none;
            cursor: pointer;
            font-family: inherit;
        }
        .pt-btn-green {
            background: #16a34a;
            color: #ffffff;
        }
        .pt-btn-green:hover {
            background: #15803d;
        }
        .pt-btn-light {
            background: #ffffff;
            color: #374151;
            border: 1px solid #e5e7eb;
        }
        .pt-btn-light:hover {
            background: #f9fafb;
        }
        .pt-btn-dark {
            background: #475569;
            color: white;
        }
        .pt-btn-dark:hover {
            background: #334155;
        }

        /* ========== ESTILOS ESPECÍFICOS DEL FORMULARIO ========== */
        .pt-form-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .pt-form-card {
            background: #ffffff;
            border-radius: 1.75rem;
            border: 1px solid #dbe7df;
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
            padding: 2rem;
            transition: all 0.2s ease;
        }
        .pt-form-card:hover {
            box-shadow: 0 20px 35px rgba(0, 32, 0, 0.12);
        }
        .pt-form-intro {
            margin-bottom: 1.8rem;
            border-left: 4px solid #2b7840;
            padding-left: 1.2rem;
        }
        .pt-form-title {
            font-size: 1.8rem;
            font-weight: 900;
            color: #1e3a2f;
            margin: 0.4rem 0;
        }
        .pt-form-subtitle {
            color: #6b7280;
            font-size: 0.9rem;
        }
        .pt-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
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
            font-size: 0.92rem;
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
            transition: border 0.2s, box-shadow 0.2s;
        }
        .pt-form-group input:focus,
        .pt-form-group select:focus,
        .pt-form-group textarea:focus {
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
        }
        .pt-alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .pt-alert-error ul {
            margin: 0.5rem 0 0 1.5rem;
        }
        .pt-form-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        @media (max-width: 768px) {
            .pt-form-grid {
                grid-template-columns: 1fr;
            }
            .pt-form-card {
                padding: 1.25rem;
            }
            .pt-form-title {
                font-size: 1.5rem;
            }
            .pt-form-actions {
                justify-content: stretch;
            }
            .pt-form-actions .pt-btn {
                flex: 1;
                text-align: center;
            }
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
            <div class="pt-mobile-user">
                <div class="pt-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div><p>{{ Auth::user()->name }}</p><span>{{ Auth::user()->email }}</span></div>
            </div>
            <a href="{{ route('profile.edit') }}">Mi perfil</a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Cerrar sesión</button></form>
        </div>
    </nav>

    <!-- ========== CONTENIDO PRINCIPAL ========== -->
    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <!-- Cabecera del formulario (título y botón volver) -->
            <div class="pt-header">
                <div>
                    <p class="pt-header-label">Cuidados por planta</p>
                    <h2 class="pt-header-title">Asignar cuidado a planta</h2>
                </div>
                <div class="pt-header-actions">
                    <a href="{{ route('planta-cuidados.index') }}" class="pt-btn pt-btn-light">Volver al listado</a>
                </div>
            </div>

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Asignar cuidado</h3>
                    <p class="pt-form-subtitle">
                        Relaciona una planta con un cuidado, frecuencia e instrucciones específicas.
                    </p>
                </div>

                @if($errors->any())
                    <div class="pt-alert-error">
                        <strong>Revisa los campos del formulario:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('planta-cuidados.store') }}" method="POST">
                    @csrf

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Planta <span class="pt-badge green" style="font-size:0.7rem;">*</span></label>
                            <select name="id_planta" required>
                                <option value="">Selecciona una planta</option>
                                @foreach($plantas as $planta)
                                    <option value="{{ $planta->id }}" {{ old('id_planta') == $planta->id ? 'selected' : '' }}>
                                        {{ $planta->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Cuidado <span class="pt-badge green" style="font-size:0.7rem;">*</span></label>
                            <select name="id_cuidado" required>
                                <option value="">Selecciona un cuidado</option>
                                @foreach($cuidados as $cuidado)
                                    <option value="{{ $cuidado->id }}" {{ old('id_cuidado') == $cuidado->id ? 'selected' : '' }}>
                                        {{ $cuidado->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Frecuencia (días) <span class="pt-badge green" style="font-size:0.7rem;">*</span></label>
                            <input type="number" name="frecuencia" value="{{ old('frecuencia') }}" placeholder="Ejemplo: 3" min="1" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Instrucciones</label>
                            <textarea name="instrucciones_esp" rows="4" placeholder="Ejemplo: regar sin encharcar">{{ old('instrucciones_esp') }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Evidencia (opcional)</label>
                            <input type="text" name="evidencia" value="{{ old('evidencia') }}" placeholder="Texto o referencia">
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="{{ route('planta-cuidados.index') }}" class="pt-btn pt-btn-dark">Cancelar</a>
                        <button type="submit" class="pt-btn pt-btn-green">Guardar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

</body>
</html>