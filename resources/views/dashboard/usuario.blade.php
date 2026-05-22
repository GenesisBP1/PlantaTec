<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Mi espacio verde</p>
                <h2 class="pt-header-title">
                    Hola, {{ Auth::user()->name }}
                </h2>
                <p class="pt-header-subtitle">
                    {{ now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                </p>
            </div>

            <div class="pt-header-actions">
                <a href="{{ route('catalogo.plantas') }}" class="pt-btn pt-btn-green">
                    Adoptar planta
                </a>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-user-stats-grid">

                <a href="{{ route('adopciones.index') }}" class="pt-user-stat green">
                    <div class="pt-user-stat-content">
                        <div>
                            <p class="pt-user-stat-label">Plantas adoptadas</p>
                            <p class="pt-user-stat-number">{{ $misPlantas }}</p>
                        </div>
                        <div class="pt-user-stat-icon">🌿</div>
                    </div>
                    <p class="pt-user-stat-link green">Ver adopciones →</p>
                </a>

                <a href="{{ route('notificaciones.index') }}" class="pt-user-stat red">
                    <div class="pt-user-stat-content">
                        <div>
                            <p class="pt-user-stat-label">Notificaciones</p>
                            <div class="pt-user-number-row">
                                <p class="pt-user-stat-number">{{ $misNotificaciones }}</p>
                                @if($misNotificaciones > 0)
                                    <span class="pt-user-small red">pendientes</span>
                                @endif
                            </div>
                        </div>

                        <div class="pt-user-stat-icon notification">
                            🔔
                            @if($misNotificaciones > 0)
                                <span class="pt-notification-badge">
                                    {{ $misNotificaciones > 9 ? '9+' : $misNotificaciones }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <p class="pt-user-stat-link red">
                        @if($misNotificaciones > 0)
                            {{ $misNotificaciones }} sin leer
                        @else
                            Todo al día ✓
                        @endif
                    </p>
                </a>

                <div class="pt-user-stat amber">
                    <div class="pt-user-stat-content">
                        <div>
                            <p class="pt-user-stat-label">Cuidados de hoy</p>
                            <div class="pt-user-number-row">
                                <p class="pt-user-stat-number">{{ $cuidadosPendientesHoy ?? 0 }}</p>
                                <span class="pt-user-small amber">pendientes</span>
                            </div>
                        </div>
                        <div class="pt-user-stat-icon">💡</div>
                    </div>
                    <p class="pt-user-stat-text">Registra los cuidados</p>
                </div>

                <div class="pt-user-stat blue">
                    <div class="pt-user-stat-content">
                        <div>
                            <p class="pt-user-stat-label">Problemas activos</p>
                            <p class="pt-user-stat-number">{{ $problemasActivos ?? 0 }}</p>
                        </div>
                        <div class="pt-user-stat-icon">⚠️</div>
                    </div>
                    <p class="pt-user-stat-text">En seguimiento</p>
                </div>

            </div>

            <div class="pt-user-actions-grid">

                <a href="{{ route('catalogo.plantas') }}" class="pt-user-action green">
                    <div class="pt-user-action-icon">🌱</div>
                    <div class="pt-user-action-text">
                        <p class="pt-user-action-title">Catálogo de plantas</p>
                        <p class="pt-user-action-subtitle">Explora y adopta nuevas plantas</p>
                    </div>
                    <span class="pt-user-arrow">›</span>
                </a>

                <a href="{{ route('adopciones.index') }}" class="pt-user-action blue">
                    <div class="pt-user-action-icon">💜</div>
                    <div class="pt-user-action-text">
                        <p class="pt-user-action-title">Mis adopciones</p>
                        <p class="pt-user-action-subtitle">Gestiona tus plantas adoptadas</p>
                    </div>
                    <span class="pt-user-arrow">›</span>
                </a>

                <a href="{{ route('notificaciones.index') }}" class="pt-user-action red">
                    <div class="pt-user-action-icon notification">
                        🔔
                        @if($misNotificaciones > 0)
                            <span class="pt-action-badge">
                                {{ $misNotificaciones > 9 ? '9+' : $misNotificaciones }}
                            </span>
                        @endif
                    </div>

                    <div class="pt-user-action-text">
                        <p class="pt-user-action-title">Notificaciones</p>
                        <p class="pt-user-action-subtitle">
                            @if($misNotificaciones > 0)
                                Tienes {{ $misNotificaciones }} sin leer
                            @else
                                Todo al día
                            @endif
                        </p>
                    </div>
                    <span class="pt-user-arrow">›</span>
                </a>

                <a href="{{ route('registro-cuidados.index') }}" class="pt-user-action purple">
                    <div class="pt-user-action-icon">📋</div>
                    <div class="pt-user-action-text">
                        <p class="pt-user-action-title">Registro de cuidados</p>
                        <p class="pt-user-action-subtitle">Lleva el control de tus plantas</p>
                    </div>
                    <span class="pt-user-arrow">›</span>
                </a>

            </div>

            @if(isset($ubicacionesConPlantas) && $ubicacionesConPlantas->count() > 0)
                <div class="pt-card">
                    <div class="pt-card-header">
                        <div>
                            <h3 class="pt-card-title">Mapa de tus plantas</h3>
                            <p class="pt-card-subtitle">Visualiza dónde están tus plantas adoptadas</p>
                        </div>

                        <a href="{{ route('mapa.index') }}" class="pt-link green">
                            Ver mapa completo →
                        </a>
                    </div>

                    <div class="pt-map-placeholder">
                        Mapa interactivo
                    </div>
                </div>
            @endif

            <div class="pt-card">
                <h3 class="pt-section-title">
                    Mapa de plantas adoptadas
                </h3>

                <div id="mapaUsuario" class="pt-user-map"></div>
            </div>

            @if($misNotificaciones > 0)
                <div class="pt-user-banner active">
                    <div class="pt-banner-circle one"></div>
                    <div class="pt-banner-circle two"></div>

                    <div class="pt-user-banner-content">
                        <div>
                            <p class="pt-banner-small">¡Tus plantas te necesitan!</p>
                            <p class="pt-banner-title">
                                Tienes {{ $misNotificaciones }}
                                {{ $misNotificaciones === 1 ? 'recomendación pendiente' : 'recomendaciones pendientes' }}
                            </p>
                            <p class="pt-banner-text">
                                Revisa los cuidados sugeridos para mantenerlas saludables.
                            </p>
                        </div>

                        <a href="{{ route('notificaciones.index') }}" class="pt-banner-btn">
                            Revisar ahora
                        </a>
                    </div>
                </div>
            @else
                <div class="pt-user-banner success">
                    <div class="pt-success-icon">✓</div>
                    <div>
                        <p class="pt-success-title">¡Tus plantas están bien cuidadas!</p>
                        <p class="pt-success-text">
                            No tienes recomendaciones pendientes. Sigue así.
                        </p>
                    </div>
                </div>
            @endif

            @if(isset($ultimasPlantas) && $ultimasPlantas->count() > 0)
                <div class="pt-card">
                    <div class="pt-card-header">
                        <div>
                            <h3 class="pt-card-title">Últimas plantas</h3>
                            <p class="pt-card-subtitle">Tus adopciones más recientes</p>
                        </div>

                        <a href="{{ route('adopciones.index') }}" class="pt-link green">
                            Ver todas →
                        </a>
                    </div>

                    <div class="pt-last-plants-grid">
                        @foreach($ultimasPlantas as $adopcion)
                            <div class="pt-last-plant-card">
                                <img src="{{ $adopcion->planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=400&h=200&fit=crop' }}" 
                                     alt="{{ $adopcion->planta->nombre ?? 'Planta' }}">

                                <div class="pt-last-plant-body">
                                    <h4>{{ $adopcion->planta->nombre ?? 'Planta sin nombre' }}</h4>
                                    <p>Adoptada el {{ $adopcion->created_at->format('d/m/Y') }}</p>

                                    <div class="pt-last-plant-footer">
                                        <span class="pt-badge green">
                                            {{ $adopcion->planta->tipo_zona ?? 'Interior' }}
                                        </span>

                                        @if($adopcion->planta)
                                            <a href="{{ route('catalogo.plantas.show', $adopcion->planta->id) }}" class="pt-link green">
                                                Ver →
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const mapa = L.map('mapaUsuario').setView([25.8690, -97.5027], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(mapa);

        const ubicaciones = @json($ubicacionesMapa ?? []);
        const usuarioActual = {{ auth()->id() }};

        const iconoRojo = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34]
        });

        const iconoAzul = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34]
        });

        ubicaciones.forEach(item => {
            if (!item.ubicacion) return;

            const esMia = item.id_usuario === usuarioActual;
            const tipo = (item.ubicacion.tipo || '').toLowerCase();

            if (!esMia && tipo !== 'publico') {
                return;
            }

            const marker = L.marker(
                [item.ubicacion.latitud, item.ubicacion.longitud],
                {
                    icon: esMia ? iconoRojo : iconoAzul
                }
            ).addTo(mapa);

            marker.bindPopup(`
                <div style="min-width:200px">
                    <strong>${item.planta?.nombre ?? ''}</strong><br>
                    <b>Ubicación:</b> ${item.ubicacion.nombre_lugar ?? 'Sin nombre'}<br>
                    <b>Tipo:</b> ${tipo}<br>
                    <b>${esMia ? 'Tu adopción' : 'Ubicación pública'}</b>
                </div>
            `);
        });
    });
    </script>
</x-app-layout>