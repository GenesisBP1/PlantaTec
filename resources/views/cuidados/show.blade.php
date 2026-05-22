<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Cuidados</p>
                <h2 class="pt-header-title">Detalle del cuidado</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">{{ $cuidado->nombre }}</h3>
                    <p class="pt-form-subtitle">
                        Información completa del cuidado registrado.
                    </p>
                </div>

                <div class="pt-detail-grid">
                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span>{{ $cuidado->descripcion ?? 'Sin descripción.' }}</span>
                    </div>
                </div>

                <div class="pt-form-actions">
                    <a href="{{ route('cuidados.edit', $cuidado) }}" class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="{{ route('cuidados.index') }}" class="pt-btn pt-btn-dark">
                        Volver
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>