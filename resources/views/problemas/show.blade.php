<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Problemas</p>
                <h2 class="pt-header-title">Detalle del problema</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">{{ $problema->nombre }}</h3>
                    <p class="pt-form-subtitle">
                        Información completa del problema registrado.
                    </p>
                </div>

                <div class="pt-detail-grid">

                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span>{{ $problema->descripcion ?? 'Sin descripción' }}</span>
                    </div>

                    @if($problema->imagen)
    @php
        $imagenProblema = filter_var($problema->imagen, FILTER_VALIDATE_URL)
            ? $problema->imagen
            : asset('storage/' . $problema->imagen);
    @endphp

    <div class="pt-detail-item full">
        <strong>Imagen</strong>
        <img src="{{ $imagenProblema }}"
             alt="{{ $problema->nombre }}"
             class="pt-problem-image">
    </div>
@endif

                </div>

                <div class="pt-form-actions">
                    <a href="{{ route('problemas.edit', $problema) }}"
                       class="pt-btn pt-btn-yellow">
                        Editar
                    </a>

                    <a href="{{ route('problemas.index') }}"
                       class="pt-btn pt-btn-dark">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>