<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Detalle de adopción</p>
                <h2 class="pt-header-title">{{ $adopcion->planta->nombre }}</h2>
                <p class="pt-header-subtitle">
                    Información general de la planta adoptada · {{ now()->format('d M Y') }}
                </p>
            </div>

            <div class="pt-header-actions">
                <a href="{{ route('adopciones.index') }}" class="pt-btn pt-btn-light">
                    Volver
                </a>

                <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id]) }}" class="pt-btn pt-btn-green">
                    Registrar cuidado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-card pt-adoption-detail">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">{{ $adopcion->planta->nombre }}</h3>
                </div>

                <div class="pt-card-body">
                    <div class="pt-adoption-flex">

                        <div class="pt-adoption-image">
                            @php
                                $imagenUrl = 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&fit=crop';

                                if ($adopcion->planta->imagen) {
                                    if (filter_var($adopcion->planta->imagen, FILTER_VALIDATE_URL)) {
                                        $imagenUrl = $adopcion->planta->imagen;
                                    } elseif (file_exists(public_path('storage/' . $adopcion->planta->imagen))) {
                                        $imagenUrl = asset('storage/' . $adopcion->planta->imagen);
                                    }
                                }
                            @endphp

                            <img src="{{ $imagenUrl }}" alt="{{ $adopcion->planta->nombre }}">
                        </div>

                        <div class="pt-adoption-info">
                            <div class="pt-info-grid-small">

                                <div class="pt-info-box">
                                    <strong>Especie</strong>
                                    <span>{{ $adopcion->planta->especie }}</span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Estado adopción</strong>
                                    <span>{{ ucfirst($adopcion->estado_adopcion) }}</span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Ubicación</strong>
                                    <span>{{ $adopcion->ubicacion->nombre_lugar ?? 'No registrada' }}</span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Fecha adopción</strong>
                                    <span>{{ \Carbon\Carbon::parse($adopcion->fecha_adopcion)->format('d/m/Y') }}</span>
                                </div>

                            </div>

                            <p class="pt-description">
                                <strong>Descripción:</strong>
                                {{ $adopcion->planta->descripcion ?? 'Sin descripción.' }}
                            </p>

                            <div class="pt-btn-group">
                                <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id]) }}" class="pt-btn pt-btn-green">
                                    Registrar cuidado general
                                </a>

                                <a href="{{ route('reporte-problemas.create', ['adopcion_id' => $adopcion->id]) }}" class="pt-btn pt-btn-red">
                                    Reportar problema
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Aquí puedes continuar con el plan de cuidados, historial, mapa u otra información --}}

        </div>
    </div>
</x-app-layout>