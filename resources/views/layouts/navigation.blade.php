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