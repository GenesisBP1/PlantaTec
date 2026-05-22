<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Tratamientos</p>
                <h2 class="pt-header-title">Editar tratamiento</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">Actualizar tratamiento</h3>
                    <p class="pt-form-subtitle">
                        Cambia el problema, planta, frecuencia o descripción sin perder la información actual.
                    </p>
                </div>

                @if($errors->any())
                    <div class="pt-alert-error">
                        <p><strong>Revisa los campos del formulario:</strong></p>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tratamientos.update', $tratamiento) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Problema</label>

                            <select name="id_problema" required>
                                <option value="">Selecciona un problema</option>

                                @foreach($problemas as $problema)
                                    <option value="{{ $problema->id }}"
                                        {{ old('id_problema', $tratamiento->id_problema) == $problema->id ? 'selected' : '' }}>
                                        {{ $problema->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Planta</label>

                            <select name="id_planta">
                                <option value="" {{ old('id_planta', $tratamiento->id_planta) == null ? 'selected' : '' }}>
                                    General para todas las plantas
                                </option>

                                @foreach($plantas as $planta)
                                    <option value="{{ $planta->id }}"
                                        {{ old('id_planta', $tratamiento->id_planta) == $planta->id ? 'selected' : '' }}>
                                        {{ $planta->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Frecuencia del tratamiento</label>

                            <div class="pt-input-inline">
                                <input type="number"
                                       name="frecuencia_dias"
                                       min="1"
                                       value="{{ old('frecuencia_dias', $tratamiento->frecuencia_dias ?? 1) }}"
                                       required>

                                <span>días</span>
                            </div>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>

                            <textarea name="descripcion" rows="3">{{ old('descripcion', $tratamiento->descripcion) }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Indicaciones</label>

                            <textarea name="indicaciones" rows="4">{{ old('indicaciones', $tratamiento->indicaciones) }}</textarea>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">
                            Actualizar
                        </button>

                        <a href="{{ route('tratamientos.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>