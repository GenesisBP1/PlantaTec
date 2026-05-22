<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Recomendaciones</p>
                <h2 class="pt-header-title">Detalle de recomendación</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">Recomendación de cuidado</h3>
                    <p class="pt-form-subtitle">
                        Información completa de la recomendación registrada.
                    </p>
                </div>

                <div class="pt-detail-grid">

                    <div class="pt-detail-item">
                        <strong>Planta</strong>
                        <span>{{ $recomendacion->adopcion->planta->nombre ?? 'Sin planta registrada' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Cuidado</strong>
                        <span>{{ $recomendacion->plantaCuidado->cuidado->nombre ?? 'Sin cuidado registrado' }}</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Mensaje</strong>
                        <span>{{ $recomendacion->mensaje ?? 'Sin mensaje registrado' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Prioridad</strong>
                        <span>{{ ucfirst($recomendacion->prioridad ?? 'Sin prioridad') }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Estado</strong>
                        <span>{{ ucfirst($recomendacion->estado ?? 'Sin estado') }}</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Fecha de registro</strong>
                        <span>
                            {{ $recomendacion->created_at ? $recomendacion->created_at->format('d/m/Y') : 'Sin fecha' }}
                        </span>
                    </div>

                </div>

                <div class="pt-form-actions">
                    <a href="{{ route('recomendaciones-cuidado.edit', $recomendacion->id) }}"
                       class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="{{ route('recomendaciones-cuidado.index') }}"
                       class="pt-btn pt-btn-dark">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>