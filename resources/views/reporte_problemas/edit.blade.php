<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Reportes de problemas</p>
                <h2 class="pt-header-title">Editar reporte</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">
            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de reporte</p>
                    <h3 class="pt-form-title">
                        {{ $reporteProblema->adopcion->planta->nombre ?? 'Planta no disponible' }}
                    </h3>
                    <p class="pt-form-subtitle">
                        Modifica el diagnóstico, gravedad o estado del reporte.
                    </p>
                </div>

                <form action="{{ route('reporte-problemas.update', $reporteProblema) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="pt-form-grid">
                        <div class="pt-form-group full">
                            <label>Problema</label>
                            <select name="id_problema" required>
                                @foreach($problemas as $problema)
                                    <option value="{{ $problema->id }}"
                                        {{ old('id_problema', $reporteProblema->id_problema) == $problema->id ? 'selected' : '' }}>
                                        {{ $problema->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Gravedad</label>
                            <select name="gravedad" required>
                                <option value="leve" {{ old('gravedad', $reporteProblema->gravedad) == 'leve' ? 'selected' : '' }}>Leve</option>
                                <option value="media" {{ old('gravedad', $reporteProblema->gravedad) == 'media' ? 'selected' : '' }}>Media</option>
                                <option value="grave" {{ old('gravedad', $reporteProblema->gravedad) == 'grave' ? 'selected' : '' }}>Grave</option>
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Estado</label>
                            <select name="estado" required>
                                <option value="pendiente" {{ old('estado', $reporteProblema->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en_revision" {{ old('estado', $reporteProblema->estado) == 'en_revision' ? 'selected' : '' }}>En revisión</option>
                                <option value="resuelto" {{ old('estado', $reporteProblema->estado) == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="4">{{ old('descripcion', $reporteProblema->descripcion) }}</textarea>
                        </div>
                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">
                            Actualizar
                        </button>

                        <a href="{{ route('reporte-problemas.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>