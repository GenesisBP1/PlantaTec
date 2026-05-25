<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Gestión de asignaciones (Planta - Cuidado)</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <!-- Alpine.js para el dropdown (solo funcionalidad) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ========== ESTILOS GLOBALES PLANTA TEC (versión completa y corregida) ========== */
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

        /* ========== BARRA DE NAVEGACIÓN (estándar) ========== */
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

        /* ========== ESTILOS DE CONTENIDO (página de asignaciones) ========== */
        .pt-page {
            padding: 2.5rem 0 3.5rem;
            background: #f6f8f5;
            min-height: calc(100vh - 80px);
        }
        .pt-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        .pt-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .pt-header-label {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #16a34a;
            margin: 0 0 0.25rem;
        }
        .pt-header-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: #111827;
            line-height: 1.2;
            margin: 0;
        }
        .pt-header-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0.25rem 0 0;
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
            padding: 0.65rem 1rem;
            border-radius: 0.9rem;
            font-size: 0.875rem;
            font-weight: 800;
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
            transform: translateY(-1px);
        }
        .pt-admin-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1.5rem;
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
            overflow: hidden;
            padding: 1.5rem;
        }
        .pt-admin-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }
        .pt-admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .pt-admin-table thead tr {
            background: linear-gradient(90deg, #f0fdf4, #ecfdf5);
        }
        .pt-admin-table th {
            padding: 1rem;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 900;
            color: #166534;
            border-bottom: 1px solid #d1fae5;
            white-space: nowrap;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .pt-admin-table td {
            padding: 1rem;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        .pt-admin-table tbody tr {
            transition: 0.2s ease;
        }
        .pt-admin-table tbody tr:hover {
            background: #f8fbf8;
        }
        .pt-table-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .pt-table-actions form {
            margin: 0;
            display: inline-flex;
        }
        .pt-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            border-radius: 999px;
            padding: 0.45rem 0.8rem;
            font-size: 0.78rem;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
            font-family: inherit;
            line-height: 1;
        }
        .pt-action-btn.view {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }
        .pt-action-btn.view:hover {
            background: #2563eb;
            color: #ffffff;
        }
        .pt-action-btn.edit {
            background: #fefce8;
            color: #ca8a04;
            border-color: #fde68a;
        }
        .pt-action-btn.edit:hover {
            background: #ca8a04;
            color: #ffffff;
        }
        .pt-action-btn.delete {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }
        .pt-action-btn.delete:hover {
            background: #dc2626;
            color: #ffffff;
        }
        .pt-empty {
            background: #f9fafb;
            border: 1px solid #f3f4f6;
            border-radius: 1rem;
            padding: 2rem 1rem;
            color: #6b7280;
            font-size: 0.875rem;
            text-align: center;
        }
        .pt-empty.center {
            text-align: center;
        }
        /* Paginación */
        .pt-admin-card nav {
            margin-top: 1.5rem;
        }
        .pt-admin-card nav[role="navigation"] > div {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 1rem !important;
            flex-wrap: wrap !important;
        }
        .pt-admin-card nav[role="navigation"] svg {
            width: 18px !important;
            height: 18px !important;
            max-width: 18px !important;
            max-height: 18px !important;
        }
        .pt-admin-card nav[role="navigation"] a,
        .pt-admin-card nav[role="navigation"] span {
            min-width: 36px !important;
            min-height: 36px !important;
            padding: 0.45rem 0.75rem !important;
            border-radius: 0.7rem !important;
            font-size: 0.875rem !important;
            line-height: 1.2 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .pt-admin-card nav[role="navigation"] a {
            color: #374151 !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            text-decoration: none !important;
        }
        .pt-admin-card nav[role="navigation"] a:hover {
            background: #f0fdf4 !important;
            color: #15803d !important;
            border-color: #bbf7d0 !important;
        }
        .pt-admin-card nav[role="navigation"] span[aria-current="page"] span {
            background: #16a34a !important;
            color: #ffffff !important;
            border-color: #16a34a !important;
        }
        .pt-admin-card nav[role="navigation"] p {
            margin: 0 !important;
            color: #6b7280 !important;
            font-size: 0.875rem !important;
        }
        @media (max-width: 768px) {
            .pt-page { padding: 2rem 0; }
            .pt-container { padding: 0 1rem; }
            .pt-header { flex-direction: column; align-items: flex-start; }
            .pt-header-actions { width: 100%; }
            .pt-btn { width: 100%; }
            .pt-admin-card { padding: 1rem; border-radius: 1.2rem; }
            .pt-admin-table, .pt-admin-table thead, .pt-admin-table tbody, .pt-admin-table tr, .pt-admin-table td, .pt-admin-table th { display: block; }
            .pt-admin-table thead { display: none; }
            .pt-admin-table tr {
                margin-bottom: 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 1rem;
                padding: 0.75rem;
                background: #ffffff;
            }
            .pt-admin-table td { border: none; padding: 0.45rem 0; }
            .pt-admin-table td:nth-child(1)::before { content: "Planta: "; font-weight: 900; color: #166534; }
            .pt-admin-table td:nth-child(2)::before { content: "Cuidado: "; font-weight: 900; color: #166534; }
            .pt-admin-table td:nth-child(3)::before { content: "Frecuencia: "; font-weight: 900; color: #166534; }
            .pt-admin-table td:nth-child(4)::before { content: "Instrucciones: "; font-weight: 900; color: #166534; }
            .pt-admin-table td:nth-child(5)::before { content: "Acciones: "; font-weight: 900; color: #166534; display: block; margin-bottom: 0.5rem; }
            .pt-table-actions { flex-direction: column; align-items: stretch; width: 100%; }
            .pt-table-actions form { width: 100%; }
            .pt-action-btn { width: 100%; }
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
        <div class="pt-container">

            <!-- Cabecera con título y botón -->
            <div class="pt-header">
                <div>
                    <p class="pt-header-label">Cuidados por planta</p>
                    <h2 class="pt-header-title">Gestión de asignaciones</h2>
                    <p class="pt-header-subtitle">Panel de administración</p>
                </div>
                <div class="pt-header-actions">
                    <a href="{{ route('planta-cuidados.create') }}" class="pt-btn pt-btn-green">+ Asignar cuidado</a>
                </div>
            </div>

            <!-- Tabla de asignaciones -->
            <div class="pt-admin-card">
                <div class="pt-admin-table-wrapper">
                    <table class="pt-admin-table">
                        <thead>
                            <tr>
                                <th>Planta</th>
                                <th>Cuidado</th>
                                <th>Frecuencia</th>
                                <th>Instrucciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($asignaciones as $asignacion)
                                <tr>
                                    <td>{{ $asignacion->planta->nombre ?? 'Sin planta' }}</td>
                                    <td>{{ $asignacion->cuidado->nombre ?? 'Sin cuidado' }}</td>
                                    <td>{{ $asignacion->frecuencia }} días</td>
                                    <td>{{ Str::limit($asignacion->instrucciones_esp, 60) }}</td>
                                    <td class="pt-table-actions">
                                        <a href="{{ route('planta-cuidados.show', $asignacion) }}" class="pt-action-btn view">Ver</a>
                                        <a href="{{ route('planta-cuidados.edit', $asignacion) }}" class="pt-action-btn edit">Editar</a>
                                        <form action="{{ route('planta-cuidados.destroy', $asignacion) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pt-action-btn delete" onclick="return confirm('¿Eliminar esta asignación?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="pt-empty center">No hay cuidados asignados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $asignaciones->links() }}
            </div>

        </div>
    </div>

</body>
</html>