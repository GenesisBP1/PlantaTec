<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-green-600 dark:text-green-400 mb-0.5">Mi espacio verde</p>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                        Hola, {{ Auth::user()->name }} 🌱
                    </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</p>
            </div>
            <a href="{{ route('catalogo.plantas') }}"
               class="hidden md:inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-xl shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Adoptar planta
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- MÉTRICAS --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('adopciones.index') }}" class="group relative bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-green-200 transition overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Plantas adoptadas</p>
                        <p class="text-3xl font-bold text-gray-900 mt-0.5">{{ $misPlantas }}</p>
                        <p class="text-xs text-green-600 mt-1 group-hover:underline">Ver adopciones →</p>
                    </div>
                </a>

                <a href="{{ route('notificaciones.index') }}" class="group relative bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-red-200 transition overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-red-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center mb-3 relative">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            @if($misNotificaciones > 0)
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                                {{ $misNotificaciones > 9 ? '9+' : $misNotificaciones }}
                            </span>
                            @endif
                        </div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Notificaciones</p>
                        <p class="text-3xl font-bold text-gray-900 mt-0.5">{{ $misNotificaciones }}</p>
                        <p class="text-xs text-red-500 mt-1 group-hover:underline">
                            {{ $misNotificaciones > 0 ? 'Sin leer →' : 'Al día ✓' }}
                        </p>
                    </div>
                </a>

                <div class="group relative bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Problemas activos</p>
                        <p class="text-3xl font-bold text-gray-900 mt-0.5">{{ $problemasActivos }}</p>
                        <p class="text-xs text-blue-600 mt-1">Reportes en seguimiento</p>
                    </div>
                </div>

                <div class="group relative bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-amber-200 transition overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Cuidados de hoy</p>
                        <p class="text-3xl font-bold text-gray-900 mt-0.5">{{ $cuidadosPendientesHoy }}</p>
                        <p class="text-xs text-amber-600 mt-1">Pendientes para hoy</p>
                    </div>
                </div>
            </div>

            {{-- ACCIONES RÁPIDAS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('catalogo.plantas') }}" class="group flex items-center gap-4 bg-white border border-gray-100 hover:border-green-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Catálogo de plantas</p>
                        <p class="text-xs text-gray-400 mt-0.5">Explora y adopta nuevas plantas</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 ml-auto group-hover:text-green-500 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('adopciones.index') }}" class="group flex items-center gap-4 bg-white border border-gray-100 hover:border-blue-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Mis adopciones</p>
                        <p class="text-xs text-gray-400 mt-0.5">Gestiona tus plantas adoptadas</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 ml-auto group-hover:text-blue-500 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('notificaciones.index') }}" class="group flex items-center gap-4 bg-white border border-gray-100 hover:border-red-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-sm relative">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @if($misNotificaciones > 0)
                        <span class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-white text-red-600 text-[10px] font-bold rounded-full border-2 border-red-500 flex items-center justify-center">
                            {{ $misNotificaciones > 9 ? '9+' : $misNotificaciones }}
                        </span>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Notificaciones</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            @if($misNotificaciones > 0)
                                Tienes <span class="text-red-500 font-semibold">{{ $misNotificaciones }}</span> sin leer
                            @else
                                Todo al día 🎉
                            @endif
                        </p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 ml-auto group-hover:text-red-400 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- BANNER --}}
            @if($misNotificaciones > 0)
            <div class="relative bg-gradient-to-r from-green-600 to-emerald-500 rounded-2xl p-6 text-white overflow-hidden shadow-md">
                <div class="absolute -right-6 -top-6 w-36 h-36 bg-white/10 rounded-full"></div>
                <div class="absolute right-10 bottom-0 w-20 h-20 bg-white/10 rounded-full"></div>
                <div class="relative flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-green-100 mb-1">¡Tus plantas te necesitan!</p>
                        <p class="text-lg font-bold">
                            Tienes {{ $misNotificaciones }} {{ $misNotificaciones === 1 ? 'recomendación pendiente' : 'recomendaciones pendientes' }}
                        </p>
                        <p class="text-sm text-green-100 mt-1">Revisa los cuidados sugeridos para mantenerlas saludables.</p>
                    </div>
                    <a href="{{ route('notificaciones.index') }}" class="shrink-0 bg-white text-green-700 hover:bg-green-50 font-semibold text-sm px-4 py-2.5 rounded-xl transition shadow-sm">
                        Revisar ahora
                    </a>
                </div>
            </div>
            @else
            <div class="relative bg-gradient-to-r from-emerald-50 to-green-50 border border-green-100 rounded-2xl p-6 overflow-hidden">
                <div class="absolute -right-4 -top-4 w-28 h-28 bg-green-100/50 rounded-full"></div>
                <div class="relative flex items-center gap-4">
                    <span class="text-4xl">🌿</span>
                    <div>
                        <p class="font-bold text-green-800">¡Tus plantas están bien cuidadas!</p>
                        <p class="text-sm text-green-600 mt-0.5">No tienes recomendaciones pendientes. Sigue así.</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- MIS ÚLTIMAS PLANTAS (3 CARDS) --}}
            @if(isset($ultimasPlantas) && $ultimasPlantas->count() > 0)
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-gray-900">🌿 Mis últimas plantas</h3>
                            <p class="text-sm text-gray-400">Tus adopciones más recientes</p>
                        </div>
                        <a href="{{ route('adopciones.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium">Ver todas →</a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($ultimasPlantas as $adopcion)
                        <div class="group">
                            <div class="rounded-xl overflow-hidden bg-gray-50 border border-gray-100 hover:shadow-md transition">
                                <img src="{{ $adopcion->planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=400&h=250&fit=crop' }}" 
                                     alt="{{ $adopcion->planta->nombre ?? 'Planta' }}"
                                     class="w-full h-40 object-cover group-hover:scale-105 transition duration-300">
                                <div class="p-4">
                                    <h4 class="font-semibold text-gray-900">{{ $adopcion->planta->nombre ?? 'Planta sin nombre' }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">Adoptada el {{ $adopcion->created_at->format('d/m/Y') }}</p>
                                    <div class="mt-3 flex items-center justify-between">
                                        <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full">
                                            {{ $adopcion->planta->tipo_zona ?? 'Interior' }}
                                        </span>
                                        @if($adopcion->planta)
                                            <a href="{{ route('catalogo.plantas.show', $adopcion->planta->id) }}" class="text-sm text-green-600 hover:text-green-700 font-medium">Ver detalles →</a>
                                        @else
                                            <span class="text-xs text-gray-400">Sin detalles</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- ACTIVIDAD RECIENTE --}}
            @if(isset($actividadReciente) && $actividadReciente->count() > 0)
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-base font-bold text-gray-900">📋 Actividad reciente</h3>
                    <p class="text-sm text-gray-400">Últimos cuidados registrados</p>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($actividadReciente as $cuidado)
                        @php $planta = $cuidado->adopcion->planta ?? null; @endphp
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    Cuidaste <span class="font-semibold">{{ $planta->nombre ?? 'una planta' }}</span>
                                </p>
                                <p class="text-xs text-gray-500">{{ $cuidado->created_at->diffForHumans() }}</p>
                            </div>
                            @if($cuidado->estado_observado)
                            <span class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-full">{{ $cuidado->estado_observado }}</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('registro-cuidados.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium">Ver historial completo →</a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>