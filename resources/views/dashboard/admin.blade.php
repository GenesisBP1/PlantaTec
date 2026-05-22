<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Panel de Control</p>
                <h2 class="pt-header-title">
                    Bienvenido, {{ Auth::user()->name }} 🌿
                </h2>
                <p class="pt-header-subtitle">
                    Resumen general del sistema · {{ now()->format('d M Y') }}
                </p>
            </div>

            <div class="pt-header-actions">
                <a href="{{ route('plantas.create') }}" class="pt-btn pt-btn-green">
                    Nueva planta
                </a>

                <a href="{{ route('recomendaciones-cuidado.index') }}" class="pt-btn pt-btn-light">
                    Recomendaciones
                </a>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-metrics-grid">
                <div class="pt-metric-card green">
                    <div class="pt-metric-circle"></div>
                    <div class="pt-metric-content">
                        <div class="pt-metric-icon">🌿</div>
                        <p class="pt-label">Plantas</p>
                        <p class="pt-number">{{ $totalPlantas }}</p>
                        <a href="{{ route('plantas.index') }}" class="pt-link green">Ver todas →</a>
                    </div>
                </div>

                <div class="pt-metric-card blue">
                    <div class="pt-metric-circle"></div>
                    <div class="pt-metric-content">
                        <div class="pt-metric-icon">👥</div>
                        <p class="pt-label">Usuarios registrados</p>
                        <p class="pt-number">{{ $totalUsuarios }}</p>
                        <span class="pt-muted">Activos en el sistema</span>
                    </div>
                </div>

                <div class="pt-metric-card violet">
                    <div class="pt-metric-circle"></div>
                    <div class="pt-metric-content">
                        <div class="pt-metric-icon">💜</div>
                        <p class="pt-label">Plantas adoptadas</p>
                        <p class="pt-number">{{ $totalAdopciones }}</p>
                        <a href="{{ route('adopciones.index') }}" class="pt-link violet">Ver adopciones →</a>
                    </div>
                </div>

                <div class="pt-metric-card amber">
                    <div class="pt-metric-circle"></div>
                    <div class="pt-metric-content">
                        <div class="pt-metric-icon">⚠️</div>
                        <p class="pt-label">Problemas activos</p>
                        <p class="pt-number">{{ $problemasActivos }}</p>
                        <a href="{{ route('reporte-problemas.index') }}" class="pt-link amber">Ver reportes →</a>
                    </div>
                </div>
            </div>

            <div class="pt-info-grid">
                <div class="pt-card">
                    <div class="pt-card-header">
                        <div>
                            <h3 class="pt-card-title">Planta más adoptada</h3>
                            <p class="pt-card-subtitle">La planta con más adopciones registradas</p>
                        </div>
                        <span class="pt-badge green">Real</span>
                    </div>

                    @if($plantaMasAdoptada)
                        <div class="pt-plant-row">
                            <div class="pt-plant-image">
                                <img src="{{ $plantaMasAdoptada->imagen ? (str_starts_with($plantaMasAdoptada->imagen, 'http') ? $plantaMasAdoptada->imagen : asset('storage/' . $plantaMasAdoptada->imagen)) : 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=400&h=250&fit=crop' }}"
                                     alt="{{ $plantaMasAdoptada->nombre }}">
                            </div>

                            <div class="pt-plant-info">
                                <p class="pt-plant-name">{{ $plantaMasAdoptada->nombre }}</p>
                                <p class="pt-text">{{ $plantaMasAdoptada->adopciones_count }} adopciones registradas</p>
                                <p class="pt-muted">Zona: {{ $plantaMasAdoptada->tipo_zona ?? 'No definida' }}</p>
                            </div>
                        </div>
                    @else
                        <div class="pt-empty">
                            Aún no hay adopciones registradas para calcular este dato.
                        </div>
                    @endif
                </div>

                <div class="pt-card">
                    <div class="pt-card-header">
                        <div>
                            <h3 class="pt-card-title">Zonas recomendadas disponibles</h3>
                            <p class="pt-card-subtitle">Ubicaciones que usuarios pueden elegir</p>
                        </div>

                        @php
                            $totalZonas = \App\Models\RecomendacionZona::count();
                        @endphp

                        <span class="pt-badge green">{{ $totalZonas }} zonas</span>
                    </div>

                    @php
                        $zonas = \App\Models\RecomendacionZona::orderBy('nombre_lugar')->get();
                    @endphp

                    @if($zonas->count() > 0)
                        <div class="pt-zone-list">
                            @foreach($zonas as $zona)
                                <div class="pt-zone-item">
                                    <div class="pt-zone-main">
                                        <p class="pt-zone-title">{{ $zona->nombre_lugar }}</p>

                                        <div class="pt-zone-tags">
                                            <span class="pt-badge blue">{{ $zona->tipo_zona }}</span>

                                            @if($zona->descripcion)
                                                <span class="pt-zone-description">{{ $zona->descripcion }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="pt-zone-coords">
                                        <p class="pt-muted">Coordenadas</p>
                                        <p class="pt-code">
                                            {{ number_format($zona->latitud, 4) }},
                                            {{ number_format($zona->longitud, 4) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="pt-empty center">
                            <div class="pt-empty-icon">📍</div>
                            <p class="pt-empty-title">No hay zonas recomendadas configuradas</p>
                            <p class="pt-muted">Crea zonas en la sección de administración.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="pt-card pt-section">
                <div class="pt-section-header">
                    <div>
                        <h3 class="pt-section-title">Gestión rápida</h3>
                        <p class="pt-card-subtitle">Accede a cualquier módulo del sistema</p>
                    </div>
                </div>

                <div class="pt-access-grid">
                    @php
                    $accesos = [
                        ['route' => 'plantas.index', 'label' => 'Plantas', 'icon' => '🌿', 'color' => 'green'],
                        ['route' => 'ubicaciones.index', 'label' => 'Ubicaciones', 'icon' => '📍', 'color' => 'blue'],
                        ['route' => 'adopciones.index', 'label' => 'Adopciones', 'icon' => '💜', 'color' => 'violet'],
                        ['route' => 'cuidados.index', 'label' => 'Cuidados', 'icon' => '📋', 'color' => 'cyan'],
                        ['route' => 'planta-cuidados.index', 'label' => 'Asignar cuidados', 'icon' => '✅', 'color' => 'emerald'],
                        ['route' => 'problemas.index', 'label' => 'Problemas', 'icon' => '⚠️', 'color' => 'orange'],
                        ['route' => 'tratamientos.index', 'label' => 'Tratamientos', 'icon' => '🧪', 'color' => 'yellow'],
                        ['route' => 'recomendaciones-cuidado.index', 'label' => 'Recomendaciones', 'icon' => '🔔', 'color' => 'red'],
                        ['route' => 'notificaciones.index', 'label' => 'Notificaciones', 'icon' => '🔔', 'color' => 'gray'],
                        ['route' => 'reporte-problemas.index', 'label' => 'Reportes de problemas', 'icon' => '🚨', 'color' => 'pink'],
                    ];
                    @endphp

                    @foreach($accesos as $item)
                        <a href="{{ route($item['route']) }}" class="pt-access-btn {{ $item['color'] }}">
                            <span class="pt-access-icon">{{ $item['icon'] }}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="pt-map-card">
                <div class="pt-map-header">
                    <div>
                        <h3 class="pt-section-title">🗺️ Mapa de ubicaciones</h3>
                        <p class="pt-card-subtitle">
                            Visualiza todas las ubicaciones públicas y privadas de adopciones
                        </p>
                    </div>

                    <a href="{{ route('mapa.index') }}" class="pt-link green">
                        Ver mapa completo →
                    </a>
                </div>

                <div class="pt-map-body">
                    <x-mapa-interactivo 
                        id="mapa-admin"
                        :canSelectLocation="false"
                        showToolbar="false"
                        height="550px"
                    />
                </div>
            </div>

        </div>
    </div>
</x-app-layout>