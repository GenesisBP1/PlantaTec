<x-app-layout>
    <x-slot name="header">
        {{-- Header enriquecido --}}
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-green-600 dark:text-green-400 mb-0.5">Panel de Control</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                    Bienvenido, {{ Auth::user()->name }} 🌿
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Resumen general del sistema · {{ now()->format('d M Y') }}</p>
            </div>
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('plantas.create') }}"
                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva planta
                </a>
                <a href="{{ route('recomendaciones-cuidado.index') }}"
                   class="inline-flex items-center gap-2 border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-semibold px-4 py-2 rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 110 20A10 10 0 0112 2z"/>
                    </svg>
                    Recomendaciones
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 space-y-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ════════════════════════════
                 MÉTRICAS PRINCIPALES
            ════════════════════════════ --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                {{-- (Las métricas se mantienen igual) --}}
                <div class="group relative bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="absolute -right-3 -top-3 w-20 h-20 bg-green-50 rounded-full opacity-60 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3C6 3 3 9 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-3-3-9-9-9z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Plantas</p>
                        <p class="text-3xl font-bold text-gray-900 mt-0.5">{{ $totalPlantas }}</p>
                        <a href="{{ route('plantas.index') }}" class="text-xs text-green-600 hover:underline mt-1 inline-block">Ver todas →</a>
                    </div>
                </div>

                <div class="group relative bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="absolute -right-3 -top-3 w-20 h-20 bg-blue-50 rounded-full opacity-60 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 10-8 0 4 4 0 008 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Usuarios</p>
                        <p class="text-3xl font-bold text-gray-900 mt-0.5">{{ $totalUsuarios }}</p>
                        <span class="text-xs text-gray-400 mt-1 inline-block">Registrados</span>
                    </div>
                </div>

                <div class="group relative bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="absolute -right-3 -top-3 w-20 h-20 bg-violet-50 rounded-full opacity-60 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-violet-100 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Adopciones</p>
                        <p class="text-3xl font-bold text-gray-900 mt-0.5">{{ $totalAdopciones }}</p>
                        <a href="{{ route('adopciones.index') }}" class="text-xs text-violet-600 hover:underline mt-1 inline-block">Ver todas →</a>
                    </div>
                </div>

                <div class="group relative bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="absolute -right-3 -top-3 w-20 h-20 bg-amber-50 rounded-full opacity-60 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pendientes</p>
                        <p class="text-3xl font-bold text-gray-900 mt-0.5">{{ $recomendacionesPendientes }}</p>
                        <a href="{{ route('recomendaciones-cuidado.index') }}" class="text-xs text-amber-600 hover:underline mt-1 inline-block">Revisar →</a>
                    </div>
                </div>
            </div>

            {{-- ════════════════════════════
                 ACCESOS RÁPIDOS
            ════════════════════════════ --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Gestión rápida</h3>
                        <p class="text-sm text-gray-400">Accede a cualquier módulo del sistema</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">

                    @php
                    $accesos = [
                        ['route' => 'plantas.index',               'label' => 'Plantas',          'icon' => 'M12 3C6 3 3 9 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-3-3-9-9-9z',                                                                                                     'color' => 'green'],
                        ['route' => 'ubicaciones.index',           'label' => 'Ubicaciones',       'icon' => 'M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z',                                                     'color' => 'blue'],
                        ['route' => 'adopciones.index',            'label' => 'Adopciones',        'icon' => 'M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z',                                      'color' => 'violet'],
                        ['route' => 'cuidados.index',              'label' => 'Cuidados',          'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',                              'color' => 'cyan'],
                        ['route' => 'planta-cuidados.index',       'label' => 'Asignar cuidados',  'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',                                                                                                                  'color' => 'emerald'],
                        ['route' => 'problemas.index',             'label' => 'Problemas',         'icon' => 'M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z',                                                            'color' => 'orange'],
                        ['route' => 'tratamientos.index',          'label' => 'Tratamientos',      'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z', 'color' => 'yellow'],
                        ['route' => 'recomendaciones-cuidado.index','label' => 'Recomendaciones',  'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9',                          'color' => 'red'],
                        ['route' => 'notificaciones.index',        'label' => 'Notificaciones',    'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9',                          'color' => 'gray'],
                        ['route' => 'reporte-problemas.index',     'label' => 'Reportes de problemas','icon' => 'M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z','color' => 'pink'],
                    ];

                    $colorMap = [
                        'green'   => 'bg-green-50 text-green-700 hover:bg-green-100 border-green-100',
                        'blue'    => 'bg-blue-50 text-blue-700 hover:bg-blue-100 border-blue-100',
                        'violet'  => 'bg-violet-50 text-violet-700 hover:bg-violet-100 border-violet-100',
                        'cyan'    => 'bg-cyan-50 text-cyan-700 hover:bg-cyan-100 border-cyan-100',
                        'emerald' => 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border-emerald-100',
                        'orange'  => 'bg-orange-50 text-orange-700 hover:bg-orange-100 border-orange-100',
                        'yellow'  => 'bg-yellow-50 text-yellow-700 hover:bg-yellow-100 border-yellow-100',
                        'red'     => 'bg-red-50 text-red-700 hover:bg-red-100 border-red-100',
                        'gray'    => 'bg-gray-50 text-gray-700 hover:bg-gray-100 border-gray-100',
                        'pink'    => 'bg-pink-50 text-pink-700 hover:bg-pink-100 border-pink-100',
                    ];
                    @endphp

                    @foreach($accesos as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex flex-col items-center gap-2 border rounded-xl p-4 font-medium text-sm text-center transition {{ $colorMap[$item['color']] }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                        </svg>
                        {{ $item['label'] }}
                    </a>
                    @endforeach

                </div>
            </div>

            {{-- ════════════════════════════
                 ACTIVIDAD RECIENTE (opcional)
            ════════════════════════════ --}}
            {{-- Descomentar si se desea mostrar --}}

        </div>
    </div>
</x-app-layout>