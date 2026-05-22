<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Recomendaciones</p>
                <h2 class="pt-header-title">Editar recomendación de cuidado</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">Actualizar recomendación</h3>
                    <p class="pt-form-subtitle">
                        Modifica el mensaje, prioridad o estado de la recomendación.
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

                <form method="POST" action="{{ route('recomendaciones-cuidado.update', $recomendacion->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Planta</label>
                            <input type="text"
                                   value="{{ $recomendacion->adopcion->planta->nombre ?? 'Sin planta registrada' }}"
                                   disabled>
                        </div>

                        <div class="pt-form-group full">
                            <label>Cuidado</label>
                            <input type="text"
                                   value="{{ $recomendacion->plantaCuidado->cuidado->nombre ?? 'Sin cuidado registrado' }}"
                                   disabled>
                        </div>

                        <div class="pt-form-group full">
                            <label>Mensaje</label>
                            <textarea
                                name="mensaje"
                                rows="5"
                                required
                            >{{ old('mensaje', $recomendacion->mensaje) }}</textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Prioridad</label>
                            <select name="prioridad" required>
                                <option value="baja" {{ old('prioridad', $recomendacion->prioridad) == 'baja' ? 'selected' : '' }}>
                                    Baja
                                </option>
                                <option value="media" {{ old('prioridad', $recomendacion->prioridad) == 'media' ? 'selected' : '' }}>
                                    Media
                                </option>
                                <option value="alta" {{ old('prioridad', $recomendacion->prioridad) == 'alta' ? 'selected' : '' }}>
                                    Alta
                                </option>
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Estado</label>
                            <select name="estado" required>
                                <option value="pendiente" {{ old('estado', $recomendacion->estado) == 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>
                                <option value="revisada" {{ old('estado', $recomendacion->estado) == 'revisada' ? 'selected' : '' }}>
                                    Revisada
                                </option>
                                <option value="atendida" {{ old('estado', $recomendacion->estado) == 'atendida' ? 'selected' : '' }}>
                                    Atendida
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">
                            Guardar cambios
                        </button>

                        <a href="{{ route('recomendaciones-cuidado.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>