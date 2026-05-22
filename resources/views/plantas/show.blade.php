<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Plantas</p>
                <h2 class="pt-header-title">Detalle de planta</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">{{ $planta->nombre }}</h3>
                    <p class="pt-form-subtitle">
                        Información completa de la planta registrada.
                    </p>
                </div>

                <div class="pt-detail-grid">

                    <div class="pt-detail-item">
                        <strong>Especie</strong>
                        <span>{{ $planta->especie }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Tipo de zona</strong>
                        <span>{{ $planta->tipo_zona ?? 'No especificada' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Estado</strong>
                        <span>{{ ucfirst($planta->estado) }}</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span>{{ $planta->descripcion ?? 'Sin descripción.' }}</span>
                    </div>

                </div>

                <div class="pt-form-actions">
                    <a href="{{ route('plantas.edit', $planta) }}"
                       class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="{{ route('plantas.index') }}"
                       class="pt-btn pt-btn-dark">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>