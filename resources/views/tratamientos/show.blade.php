
<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Tratamientos</p>
                <h2 class="pt-header-title">Detalle del tratamiento</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">Tratamiento registrado</h3>
                    <p class="pt-form-subtitle">
                        Información completa del tratamiento registrado.
                    </p>
                </div>

                <div class="pt-detail-grid">
                    <div class="pt-detail-item">
                        <strong>Problema</strong>
                        <span>{{ $tratamiento->problema->nombre ?? 'Sin problema' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Planta</strong>
                        <span>{{ $tratamiento->planta->nombre ?? 'General' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Cuidado</strong>
                        <span>{{ $tratamiento->cuidado->nombre ?? 'Sin cuidado específico' }}</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span>{{ $tratamiento->descripcion ?? 'Sin descripción' }}</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Indicaciones</strong>
                        <span>{{ $tratamiento->indicaciones ?? 'Sin indicaciones' }}</span>
                    </div>
                </div>

                <div class="pt-form-actions">
                    <a href="{{ route('tratamientos.edit', $tratamiento) }}" class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="{{ route('tratamientos.index') }}" class="pt-btn pt-btn-dark">
                        Volver
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>