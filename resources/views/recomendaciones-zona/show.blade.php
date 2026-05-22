<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Zonas públicas</p>
                <h2 class="pt-header-title">Detalle de zona pública</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">{{ $zona->nombre_lugar }}</h3>
                    <p class="pt-form-subtitle">
                        Información completa de la zona recomendada.
                    </p>
                </div>

                <div class="pt-detail-grid">

                    <div class="pt-detail-item">
                        <strong>Tipo de zona</strong>
                        <span>{{ $zona->tipo_zona ?? 'Sin tipo registrado' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Latitud</strong>
                        <span>{{ $zona->latitud ?? 'No registrada' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Longitud</strong>
                        <span>{{ $zona->longitud ?? 'No registrada' }}</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span>{{ $zona->descripcion ?? 'Sin descripción registrada' }}</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Indicaciones</strong>
                        <span>{{ $zona->indicaciones ?? 'Sin indicaciones registradas' }}</span>
                    </div>

                </div>

                <div class="pt-form-actions">
                    <a href="{{ route('recomendaciones-zona.edit', $zona) }}" class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="{{ route('recomendaciones-zona.index') }}" class="pt-btn pt-btn-dark">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>