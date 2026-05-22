<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Cuidados por planta</p>
                <h2 class="pt-header-title">Editar asignación</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">
            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">Actualizar cuidado asignado</h3>
                    <p class="pt-form-subtitle">
                        Modifica la planta, cuidado, frecuencia e instrucciones.
                    </p>
                </div>

                <form action="{{ route('planta-cuidados.update', $asignacion) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="pt-form-grid">
                        <div class="pt-form-group">
                            <label>Planta</label>
                            <select name="id_planta" required>
                                <option value="">Selecciona una planta</option>
                                @foreach($plantas as $planta)
                                    <option value="{{ $planta->id }}"
                                        {{ old('id_planta', $asignacion->id_planta) == $planta->id ? 'selected' : '' }}>
                                        {{ $planta->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Cuidado</label>
                            <select name="id_cuidado" required>
                                <option value="">Selecciona un cuidado</option>
                                @foreach($cuidados as $cuidado)
                                    <option value="{{ $cuidado->id }}"
                                        {{ old('id_cuidado', $asignacion->id_cuidado) == $cuidado->id ? 'selected' : '' }}>
                                        {{ $cuidado->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Frecuencia (días)</label>
                            <input type="number" name="frecuencia" min="1"
                                   value="{{ old('frecuencia', $asignacion->frecuencia) }}" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Instrucciones</label>
                            <textarea name="instrucciones_esp" rows="4">{{ old('instrucciones_esp', $asignacion->instrucciones_esp) }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Evidencia (opcional)</label>
                            <input type="text" name="evidencia"
                                   value="{{ old('evidencia', $asignacion->evidencia) }}">
                        </div>
                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">
                            Actualizar
                        </button>

                        <a href="{{ route('planta-cuidados.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>