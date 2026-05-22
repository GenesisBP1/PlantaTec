<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Recomendaciones</p>
                <h2 class="pt-header-title">Registrar recomendación de cuidado</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Crear recomendación</h3>
                    <p class="pt-form-subtitle">
                        Registra una recomendación de cuidado para una planta adoptada.
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

                <form method="POST" action="{{ route('recomendaciones-cuidado.store') }}">
                    @csrf

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Planta adoptada</label>
                            <select name="id_adopcion" required>
                                <option value="">Selecciona una adopción</option>
                                @foreach($adopciones as $adopcion)
                                    <option value="{{ $adopcion->id }}" {{ old('id_adopcion') == $adopcion->id ? 'selected' : '' }}>
                                        {{ $adopcion->planta->nombre ?? 'Sin planta' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Cuidado</label>
                            <select name="id_planta_cuidado" required>
                                <option value="">Selecciona un cuidado</option>
                                @foreach($plantaCuidados as $pc)
                                    <option value="{{ $pc->id }}" {{ old('id_planta_cuidado') == $pc->id ? 'selected' : '' }}>
                                        {{ $pc->planta->nombre ?? 'Sin planta' }} - {{ $pc->cuidado->nombre ?? 'Sin cuidado' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Mensaje</label>
                            <textarea name="mensaje" rows="5" required>{{ old('mensaje') }}</textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Prioridad</label>
                            <select name="prioridad" required>
                                <option value="baja" {{ old('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                                <option value="media" {{ old('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                                <option value="alta" {{ old('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Estado</label>
                            <select name="estado" required>
                                <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="revisada" {{ old('estado') == 'revisada' ? 'selected' : '' }}>Revisada</option>
                                <option value="atendida" {{ old('estado') == 'atendida' ? 'selected' : '' }}>Atendida</option>
                            </select>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar
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