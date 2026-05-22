<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Reportes de problemas</p>
                <h2 class="pt-header-title">Diagnóstico del problema</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Problema reportado</p>

                    <h3 class="pt-form-title">
                        {{ $reporteProblema->problema->nombre ?? 'Problema no disponible' }}
                    </h3>

                    <p class="pt-form-subtitle">
                        Gravedad: {{ ucfirst($reporteProblema->gravedad ?? 'leve') }}
                        ·
                        Estado: {{ ucfirst(str_replace('_', ' ', $reporteProblema->estado ?? 'pendiente')) }}
                    </p>
                </div>

                <div class="pt-detail-grid">
                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span>
                            {{ $reporteProblema->descripcion ?? 'Sin descripción adicional.' }}
                        </span>
                    </div>

                    @if($reporteProblema->imagen)
                        <div class="pt-detail-item full">
                            <strong>Evidencia del problema</strong>

                            <img
                                src="{{ asset('storage/' . $reporteProblema->imagen) }}"
                                class="pt-problem-image"
                                alt="Evidencia del problema"
                            >
                        </div>
                    @endif
                </div>
            </div>

            @php
                $tratamiento = $reporteProblema->tratamientoSugerido();
            @endphp

            @if($tratamiento)
                <div class="pt-form-card">
                    <div class="pt-form-intro">
                        <p class="pt-header-label">Tratamiento sugerido</p>

                        <h3 class="pt-form-title">
                            Aplicar tratamiento
                        </h3>

                        <p class="pt-form-subtitle">
                            Registra la aplicación del tratamiento recomendado.
                        </p>
                    </div>

                    <div class="pt-detail-grid">
                        <div class="pt-detail-item full">
                            <strong>Descripción</strong>
                            <span>{{ $tratamiento->descripcion }}</span>
                        </div>

                        <div class="pt-detail-item full">
                            <strong>Indicaciones</strong>
                            <span>{{ $tratamiento->indicaciones }}</span>
                        </div>

                        <div class="pt-detail-item">
                            <strong>Frecuencia</strong>
                            <span>Cada {{ $tratamiento->frecuencia_dias }} días</span>
                        </div>
                    </div>

                    <form
                        action="{{ route('reporte-problemas.aplicar-tratamiento', $reporteProblema) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        <input
                            type="hidden"
                            name="id_tratamiento"
                            value="{{ $tratamiento->id }}"
                        >

                        <div class="pt-form-grid">

                            <div class="pt-form-group full">
                                <label>Fecha de aplicación</label>

                                <input
                                    type="datetime-local"
                                    name="fecha_aplicacion"
                                    value="{{ now()->format('Y-m-d\TH:i') }}"
                                    required
                                >
                            </div>

                            <div class="pt-form-group full">
                                <label>Imagen (evidencia)</label>

                                <input
                                    type="file"
                                    name="imagen"
                                    accept="image/*"
                                >
                            </div>

                            <div class="pt-form-group full">
                                <label>Observaciones</label>

                                <textarea
                                    name="observaciones"
                                    rows="4"
                                ></textarea>
                            </div>

                        </div>

                        <div class="pt-form-actions">
                            <button
                                type="submit"
                                class="pt-btn pt-btn-green"
                            >
                                Registrar aplicación
                            </button>
                        </div>
                    </form>
                </div>

            @else
                <div class="pt-alert-warning">
                    No hay un tratamiento sugerido para este problema en esta planta.
                </div>
            @endif

            <div class="pt-form-actions">
                <a
                    href="{{ route('reporte-problemas.index') }}"
                    class="pt-btn pt-btn-dark"
                >
                    Volver
                </a>
            </div>

        </div>
    </div>
</x-app-layout>