<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 bg-gradient-to-br from-green-600 to-emerald-700 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <span class="font-bold text-xl text-gray-800 dark:text-white">
                            PlantaTec
                        </span>
                    </a>
                </div>

                <!-- Navigation Links (escritorio) -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex sm:items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-3 py-2 rounded-lg transition">
                        Dashboard
                    </x-nav-link>

                    @if(auth()->user()->rol === 'admin')
                <div class="relative" x-data="{ adminOpen: false }">
                    <button @click="adminOpen = !adminOpen" @click.away="adminOpen = false" 
                        class="inline-flex items-center px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20 transition">
                        Administración
                        <svg class="w-4 h-4 ml-1 transition-transform" :class="{ 'rotate-180': adminOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="adminOpen" x-transition 
                        class="absolute left-0 mt-2 w-56 rounded-xl shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50"
                        style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('plantas.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20">
                                Plantas
                            </a>
                            <a href="{{ route('adopciones.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20">
                                Adopciones
                            </a>
                            <a href="{{ route('ubicaciones.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20">
                                Ubicaciones
                            </a>
                            <a href="{{ route('cuidados.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20">
                                Cuidados
                            </a>
                            <a href="{{ route('planta-cuidados.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20">
                                Asignar cuidados
                            </a>
                            <a href="{{ route('recomendaciones-cuidado.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20">
                                Recomendaciones de Cuidado
                            </a>
                            <a href="{{ route('recomendaciones-zona.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20">
                                Recomendaciones de Zona
                            </a>
                            <hr class="my-1 border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.usuarios.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20">
                                Usuarios
                            </a>
                        </div>
                    </div>
                </div>
                    @else
                        <x-nav-link :href="route('catalogo.plantas')" :active="request()->routeIs('catalogo.plantas')" class="px-3 py-2 rounded-lg transition">
                             Catálogo
                        </x-nav-link>
                        <x-nav-link :href="route('adopciones.index')" :active="request()->routeIs('adopciones.*')" class="px-3 py-2 rounded-lg transition">
                             Mis adopciones
                        </x-nav-link>
                        <x-nav-link :href="route('notificaciones.index')" :active="request()->routeIs('notificaciones.*')" class="px-3 py-2 rounded-lg transition relative">
                             Notificaciones
                            @php
                                $pendientes = \App\Models\Notificacion::where('id_usuario', auth()->id())
                                    ->where('leida', false)
                                    ->count();
                            @endphp
                            @if($pendientes > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full min-w-[20px] text-center">
                                    {{ $pendientes > 9 ? '9+' : $pendientes }}
                                </span>
                            @endif
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Dropdown del usuario -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition border border-gray-200 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-600 to-emerald-700 flex items-center justify-center text-white font-semibold text-sm shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="hidden lg:block text-left">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->rol === 'admin' ? 'Administrador' : 'Usuario' }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 transition-transform" :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="dropdownOpen" x-transition class="absolute right-0 mt-2 w-56 rounded-xl shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50" style="display: none;">
                        <div class="py-1">
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Mi perfil
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburguesa -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-xl text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú responsive móvil -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                🏠 Dashboard
            </x-responsive-nav-link>

            @if(auth()->user()->rol === 'admin')
                <x-responsive-nav-link :href="route('plantas.index')" :active="request()->routeIs('plantas.*')">🌿 Plantas</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('adopciones.index')" :active="request()->routeIs('adopciones.*')">🤝 Adopciones</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('catalogo.plantas')" :active="request()->routeIs('catalogo.plantas')">📚 Catálogo</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('recomendaciones-zona.index')" :active="request()->routeIs('recomendaciones-zona.*')">📍 Zonas</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('cuidados.index')" :active="request()->routeIs('cuidados.*')">💧 Cuidados</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('planta-cuidados.index')" :active="request()->routeIs('planta-cuidados.*')">🔗 Asignar cuidados</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('recomendaciones-cuidado.index')" :active="request()->routeIs('recomendaciones-cuidado.*')">⭐ Recomendaciones</x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('catalogo.plantas')" :active="request()->routeIs('catalogo.plantas')">📚 Catálogo</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('adopciones.index')" :active="request()->routeIs('adopciones.*')">🌱 Mis adopciones</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('notificaciones.index')" :active="request()->routeIs('notificaciones.*')" class="flex justify-between items-center">
                    <span>🔔 Notificaciones</span>
                    @php
                        $pendientesMovil = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count();
                    @endphp
                    @if($pendientesMovil > 0)
                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendientesMovil > 9 ? '9+' : $pendientesMovil }}</span>
                    @endif
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center px-4 gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-600 to-emerald-700 flex items-center justify-center text-white font-semibold text-base">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')">👤 Mi perfil</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 transition duration-150 ease-in-out">
                        🚪 Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>