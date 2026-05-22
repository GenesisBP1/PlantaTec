<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Tratamientos</p>
                <h2 class="pt-header-title">Crear tratamiento</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Crear tratamiento</h3>
                    <p class="pt-form-subtitle">
                        Completa los datos para relacionar el problema con una planta, cuidado y frecuencia del tratamiento.
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

                <form action="{{ route('tratamientos.store') }}" method="POST">
                    @csrf

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Problema</label>

                            <select name="id_problema" required>
                                <option value="">Selecciona un problema</option>

                                @foreach($problemas as $problema)
                                    <option value="{{ $problema->id }}"
                                        {{ old('id_problema') == $problema->id ? 'selected' : '' }}>
                                        {{ $problema->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Planta</label>

                            <select name="id_planta">
                                <option value="" {{ old('id_planta') == null ? 'selected' : '' }}>
                                    Aplicable a cualquier planta
                                </option>

                                @foreach($plantas as $planta)
                                    <option value="{{ $planta->id }}"
                                        {{ old('id_planta') == $planta->id ? 'selected' : '' }}>
                                        {{ $planta->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Cuidado que ayuda a resolver</label>

                            <select name="id_cuidado">
                                <option value="" {{ old('id_cuidado') == null ? 'selected' : '' }}>
                                    Sin cuidado específico
                                </option>

                                @foreach($cuidados as $cuidado)
                                    <option value="{{ $cuidado->id }}"
                                        {{ old('id_cuidado') == $cuidado->id ? 'selected' : '' }}>
                                        {{ $cuidado->nombre }}
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
                                       value="{{ old('frecuencia_dias', 1) }}"
                                       required>

                                <span>días</span>
                            </div>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>

                            <textarea name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Indicaciones</label>

                            <textarea name="indicaciones" rows="4">{{ old('indicaciones') }}</textarea>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar
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