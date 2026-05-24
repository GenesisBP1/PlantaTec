<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Gestión de Usuarios</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <!-- Alpine.js para el dropdown (solo funcionalidad) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ========== ESTILOS GLOBALES PLANTA TEC ========== */
        /* Mismo bloque completo que en todas las páginas anteriores */
        .pt-page { padding: 3.5rem 0; }
        .pt-container { max-width: 1280px; margin: 0 auto; padding: 0 1.5rem; }
        .pt-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; background: #ffffff; padding: 1rem 1.5rem; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 2rem; }
        .pt-header-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: #16a34a; margin-bottom: 0.25rem; }
        .pt-header-title { font-size: 1.5rem; font-weight: 800; color: #111827; line-height: 1.2; }
        .pt-header-subtitle, .pt-card-subtitle { font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem; }
        .pt-header-actions { display: flex; align-items: center; gap: 0.75rem; }
        .pt-btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.6rem 1rem; border-radius: 0.9rem; font-size: 0.875rem; font-weight: 700; text-decoration: none; transition: 0.2s ease; }
        .pt-btn-green { background: #16a34a; color: #ffffff; }
        .pt-btn-green:hover { background: #15803d; }
        .pt-btn-light { background: #ffffff; color: #374151; border: 1px solid #e5e7eb; }
        .pt-btn-light:hover { background: #f9fafb; }
        .pt-btn-dark { background: #475569; color: white; }
        .pt-btn-dark:hover { background: #334155; }
        .pt-card { background: #ffffff; border: 1px solid #f3f4f6; border-radius: 1.25rem; padding: 1.75rem; box-shadow: 0 4px 14px rgba(0,0,0,0.04); }
        .pt-table-wrapper { width: 100%; overflow-x: auto; }
        .pt-table { width: 100%; border-collapse: collapse; }
        .pt-table th, .pt-table td { padding: 0.85rem; text-align: left; border-bottom: 1px solid #e5e7eb; vertical-align: top; font-size: 0.875rem; }
        .pt-table th { background: #e2f0e6; color: #1e3a2f; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.04em; font-weight: 800; }
        .pt-table td strong { color: #1f2937; }
        .pt-table small { color: #6b7280; }
        .pt-action-btn { border: 1px solid transparent; border-radius: 0.75rem; padding: 0.45rem 0.75rem; font-size: 0.8rem; font-weight: 800; text-decoration: none; cursor: pointer; transition: 0.2s ease; font-family: inherit; display: inline-flex; align-items: center; justify-content: center; gap: 0.3rem; }
        .pt-action-btn.edit { background: #fefce8; color: #ca8a04; border-color: #fde68a; }
        .pt-action-btn.edit:hover { background: #ca8a04; color: #ffffff; }
        .pt-action-btn.delete { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
        .pt-action-btn.delete:hover { background: #dc2626; color: #ffffff; }
        .pt-empty { background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 0.9rem; padding: 1rem; color: #6b7280; font-size: 0.875rem; text-align: center; }
        .pt-empty-icon { font-size: 2rem; margin-bottom: 0.75rem; }
        .pt-empty-title { color: #4b5563; font-weight: 700; }
        .pt-muted { font-size: 0.75rem; color: #9ca3af; margin-top: 0.35rem; display: inline-block; }
        @media (max-width: 768px) {
            .pt-table, .pt-table thead, .pt-table tbody, .pt-table tr, .pt-table td, .pt-table th { display: block; }
            .pt-table thead { display: none; }
            .pt-table tr { margin-bottom: 1rem; border: 1px solid #e5e7eb; border-radius: 1rem; padding: 0.75rem; }
            .pt-table td { border: none; padding: 0.4rem 0; display: flex; justify-content: space-between; align-items: center; }
            .pt-table td::before { content: attr(data-label); font-weight: 600; width: 40%; }
        }

        /* Estilos adicionales para la tarjeta de administración */
        .pt-admin-card { background: #ffffff; border: 1px solid #f3f4f6; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.04); }
        .pt-admin-header { padding: 1.5rem 1.75rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; background: #ffffff; }
        .pt-admin-title h3 { font-size: 1.25rem; font-weight: 800; color: #111827; margin: 0; }
        .pt-admin-title p { font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem; }
        .pt-admin-footer { padding: 1rem 1.75rem; border-top: 1px solid #e5e7eb; background: #f9fafb; }

        /* Resto de estilos globales (navbar, etc.) ya están incluidos abajo */
        body { margin: 0; font-family: 'DM Sans', 'Figtree', sans-serif; background: #f6f8f5; color: #1f2937; }
        .pt-app { min-height: 100vh; }
        .pt-navbar { background: #ffffff; border-bottom: 1px solid #e5e7eb; position: sticky; top: 0; z-index: 50; box-shadow: 0 2px 12px rgba(0,0,0,0.04); }
        .pt-nav-container { max-width: 1280px; margin: 0 auto; padding: 0 1rem; }
        .pt-nav-inner { height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .pt-nav-left { display: flex; align-items: center; gap: 2rem; }
        .pt-logo { display: flex; align-items: center; gap: 0.6rem; text-decoration: none; color: #1f2937; font-size: 1.25rem; font-weight: 900; }
        .pt-logo-icon { width: 34px; height: 34px; border-radius: 0.9rem; background: linear-gradient(135deg, #16a34a, #047857); color: #ffffff; display: flex; align-items: center; justify-content: center; }
        .pt-desktop-menu { display: flex; align-items: center; gap: 0.25rem; }
        .pt-nav-link { position: relative; display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: #374151; text-decoration: none; font-size: 0.9rem; font-weight: 700; border: none; background: transparent; cursor: pointer; }
        .pt-nav-link:hover, .pt-nav-link.active { background: #f0fdf4; color: #15803d; }
        .pt-dropdown { position: relative; }
        .pt-dropdown-menu, .pt-user-dropdown { position: absolute; top: 115%; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 1rem; box-shadow: 0 16px 32px rgba(0,0,0,0.12); overflow: hidden; z-index: 100; }
        .pt-dropdown-menu { left: 0; width: 270px; padding: 0.4rem; }
        .pt-dropdown-menu a, .pt-user-dropdown a, .pt-user-dropdown button { display: block; width: 100%; padding: 0.75rem 1rem; color: #374151; text-decoration: none; font-size: 0.875rem; font-weight: 600; background: transparent; border: none; text-align: left; cursor: pointer; }
        .pt-dropdown-menu a:hover, .pt-user-dropdown a:hover, .pt-user-dropdown button:hover { background: #f0fdf4; color: #15803d; }
        .pt-dropdown-menu hr { border: none; border-top: 1px solid #e5e7eb; margin: 0.35rem 0; }
        .pt-nav-notification { padding-right: 1.3rem; }
        .pt-nav-badge { background: #ef4444; color: #ffffff; border-radius: 999px; font-size: 0.68rem; font-weight: 900; padding: 0.1rem 0.4rem; margin-left: 0.3rem; }
        .pt-user-menu { position: relative; }
        .pt-user-btn { display: flex; align-items: center; gap: 0.65rem; padding: 0.45rem 0.7rem; border-radius: 0.9rem; background: #f9fafb; border: 1px solid #e5e7eb; cursor: pointer; }
        .pt-user-btn:hover { background: #f3f4f6; }
        .pt-avatar { width: 34px; height: 34px; border-radius: 999px; background: linear-gradient(135deg, #16a34a, #047857); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 900; }
        .pt-user-text { text-align: left; }
        .pt-user-text p { margin: 0; color: #1f2937; font-size: 0.875rem; font-weight: 800; }
        .pt-user-text span { color: #6b7280; font-size: 0.75rem; }
        .pt-user-arrow { color: #6b7280; }
        .pt-user-dropdown { right: 0; width: 230px; }
        .pt-user-info { padding: 1rem; border-bottom: 1px solid #e5e7eb; }
        .pt-user-info p { margin: 0; font-weight: 800; color: #111827; }
        .pt-user-info span { display: block; color: #6b7280; font-size: 0.75rem; overflow: hidden; text-overflow: ellipsis; }
        .pt-user-dropdown button { color: #dc2626; }
        .pt-mobile-btn { display: none; border: none; background: #f3f4f6; color: #374151; width: 40px; height: 40px; border-radius: 0.75rem; font-size: 1.4rem; cursor: pointer; }
        .pt-mobile-menu { display: none; background: #ffffff; border-top: 1px solid #e5e7eb; padding: 0.75rem 1rem; }
        .pt-mobile-menu a, .pt-mobile-menu button { display: block; width: 100%; padding: 0.75rem; border-radius: 0.75rem; color: #374151; text-decoration: none; font-weight: 700; border: none; background: transparent; text-align: left; }
        .pt-mobile-menu a:hover, .pt-mobile-menu a.active, .pt-mobile-menu button:hover { background: #f0fdf4; color: #15803d; }
        .pt-mobile-user { display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0.75rem; border-top: 1px solid #e5e7eb; margin-top: 0.5rem; }
        .pt-mobile-user p { margin: 0; font-weight: 800; color: #111827; }
        .pt-mobile-user span { font-size: 0.8rem; color: #6b7280; }
        @media (max-width: 768px) { .pt-desktop-menu, .pt-user-menu { display: none; } .pt-mobile-btn { display: flex; align-items: center; justify-content: center; } .pt-mobile-menu { display: block; } }
        * { box-sizing: border-box; }
        p, h1, h2, h3, h4 { margin-top: 0; }
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
                        <a href="{{ route('dashboard') }}" class="pt-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>

                        @if(auth()->user()->rol === 'admin')
                            <div class="pt-dropdown" x-data="{ adminOpen: false }">
                                <button @click="adminOpen = !adminOpen" @click.away="adminOpen = false" class="pt-nav-link pt-dropdown-btn">
                                    Administración
                                    <span>⌄</span>
                                </button>

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
                            <a href="{{ route('catalogo.plantas') }}" class="pt-nav-link {{ request()->routeIs('catalogo.plantas') ? 'active' : '' }}">
                                Catálogo
                            </a>

                            <a href="{{ route('adopciones.index') }}" class="pt-nav-link {{ request()->routeIs('adopciones.*') ? 'active' : '' }}">
                                Mis adopciones
                            </a>

                            @php
                                $notificacionesNoLeidas = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count();
                            @endphp

                            <a href="{{ route('notificaciones.index') }}" class="pt-nav-link pt-nav-notification {{ request()->routeIs('notificaciones.*') ? 'active' : '' }}">
                                Notificaciones
                                @if($notificacionesNoLeidas > 0)
                                    <span class="pt-nav-badge">
                                        {{ $notificacionesNoLeidas > 9 ? '9+' : $notificacionesNoLeidas }}
                                    </span>
                                @endif
                            </a>
                        @endif
                    </div>
                </div>

                <div class="pt-user-menu" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="pt-user-btn">
                        <div class="pt-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="pt-user-text">
                            <p>{{ Auth::user()->name }}</p>
                            <span>{{ Auth::user()->rol === 'admin' ? 'Administrador' : 'Usuario' }}</span>
                        </div>

                        <span class="pt-user-arrow">⌄</span>
                    </button>

                    <div x-show="dropdownOpen" x-transition class="pt-user-dropdown" style="display:none;">
                        <div class="pt-user-info">
                            <p>{{ Auth::user()->name }}</p>
                            <span>{{ Auth::user()->email }}</span>
                        </div>

                        <a href="{{ route('profile.edit') }}">Mi perfil</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Cerrar sesión</button>
                        </form>
                    </div>
                </div>

                <button @click="open = !open" class="pt-mobile-btn">
                    <span x-show="!open">☰</span>
                    <span x-show="open" style="display:none;">×</span>
                </button>
            </div>
        </div>

        <div x-show="open" x-transition class="pt-mobile-menu" style="display:none;">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

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

                @php
                    $notificacionesNoLeidasMovil = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count();
                @endphp

                <a href="{{ route('notificaciones.index') }}">
                    Notificaciones
                    @if($notificacionesNoLeidasMovil > 0)
                        <span class="pt-nav-badge">
                            {{ $notificacionesNoLeidasMovil > 9 ? '9+' : $notificacionesNoLeidasMovil }}
                        </span>
                    @endif
                </a>
            @endif

            <div class="pt-mobile-user">
                <div class="pt-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p>{{ Auth::user()->name }}</p>
                    <span>{{ Auth::user()->email }}</span>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}">Mi perfil</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
    </nav>

    <!-- ========== CONTENIDO PRINCIPAL ========== -->
    <div class="pt-page">
        <div class="pt-container">

            <!-- Cabecera de la página (similar al header original) -->
            <div class="pt-header">
                <div>
                    <p class="pt-header-label">Administración</p>
                    <h2 class="pt-header-title">Gestión de Usuarios</h2>
                </div>
                <div class="pt-header-actions">
                    <a href="{{ route('admin.usuarios.create') }}" class="pt-btn pt-btn-green">
                        + Crear Usuario
                    </a>
                </div>
            </div>

            <!-- Tarjeta de la tabla -->
            <div class="pt-admin-card">
                <div class="pt-admin-header">
                    <div class="pt-admin-title">
                        <h3>Listado de usuarios</h3>
                        <p>Panel de Administración</p>
                    </div>
                </div>

                <div class="pt-table-wrapper">
                    <table class="pt-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tableUsuariosRows as $usuario)
                                <tr>
                                    <td data-label="Nombre">
                                        <strong>{{ $usuario->name }}</strong>
                                    </td>
                                    <td data-label="Email">{{ $usuario->email }}</td>
                                    <td data-label="Rol">
                                        @if($usuario->rol === 'admin')
                                            <span class="pt-badge green">Administrador</span>
                                        @else
                                            <span class="pt-badge blue">Usuario</span>
                                        @endif
                                    </td>
                                    <td data-label="Registro">{{ $usuario->created_at->format('d/m/Y') }}</td>
                                    <td data-label="Acciones">
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="pt-action-btn edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Editar
                                            </a>

                                            <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="pt-action-btn delete" onclick="return confirm('¿Eliminar este usuario permanentemente?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="pt-empty">
                                            <div class="pt-empty-icon">👥</div>
                                            <p class="pt-empty-title">No hay usuarios registrados</p>
                                            <p class="pt-muted">Haz clic en "Crear Usuario" para añadir el primero.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($tableUsuariosRows, 'links'))
                    <div class="pt-admin-footer">
                        {{ $tableUsuariosRows->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

</body>
</html>