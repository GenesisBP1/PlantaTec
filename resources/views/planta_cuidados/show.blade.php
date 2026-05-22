<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Cuidados por planta</p>
                <h2 class="pt-header-title">Detalle de asignación</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">Asignación de cuidado</h3>
                    <p class="pt-form-subtitle">
                        Información completa de la relación entre planta y cuidado.
                    </p>
                </div>

                <div class="pt-detail-grid">

                    <div class="pt-detail-item">
                        <strong>Planta</strong>
                        <span>{{ $asignacion->planta->nombre ?? 'Sin planta registrada' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Cuidado</strong>
                        <span>{{ $asignacion->cuidado->nombre ?? 'Sin cuidado registrado' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Frecuencia</strong>
                        <span>{{ $asignacion->frecuencia ?? 'Sin frecuencia registrada' }} días</span>
                    </div>

                    <div class="pt-detail-item full">
                        <strong>Instrucciones</strong>
                        <span>{{ $asignacion->instrucciones_esp ?? 'Sin instrucciones registradas' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Evidencia requerida</strong>
                        <span>{{ $asignacion->evidencia ?? 'No especificada' }}</span>
                    </div>

                    <div class="pt-detail-item">
                        <strong>Fecha de registro</strong>
                        <span>
                            {{ $asignacion->created_at ? $asignacion->created_at->format('d/m/Y') : 'Sin fecha' }}
                        </span>
                    </div>

                </div>

                <div class="pt-form-actions">
                    <a href="{{ route('planta-cuidados.edit', $asignacion) }}" class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="{{ route('planta-cuidados.index') }}" class="pt-btn pt-btn-dark">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>