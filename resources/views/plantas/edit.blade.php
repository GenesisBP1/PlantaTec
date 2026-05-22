<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Plantas</p>
                <h2 class="pt-header-title">Editar planta</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">Actualizar planta</h3>
                    <p class="pt-form-subtitle">
                        Modifica la información de la planta registrada.
                    </p>
                </div>

                <form action="{{ route('plantas.update', $planta) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Nombre</label>
                            <input type="text"
                                   name="nombre"
                                   value="{{ $planta->nombre }}"
                                   required>
                        </div>

                        <div class="pt-form-group">
                            <label>Especie</label>
                            <input type="text"
                                   name="especie"
                                   value="{{ $planta->especie }}"
                                   required>
                        </div>

                        <div class="pt-form-group">
                            <label>Tipo de zona</label>
                            <input type="text"
                                   name="tipo_zona"
                                   value="{{ $planta->tipo_zona }}">
                        </div>

                        <div class="pt-form-group">
                            <label>Imagen</label>
                            <input type="text"
                                   name="imagen"
                                   value="{{ $planta->imagen }}">
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="4">{{ $planta->descripcion }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Estado</label>
                            <select name="estado">
                                <option value="saludable" {{ $planta->estado == 'saludable' ? 'selected' : '' }}>
                                    Saludable
                                </option>

                                <option value="observacion" {{ $planta->estado == 'observacion' ? 'selected' : '' }}>
                                    Observación
                                </option>

                                <option value="problema" {{ $planta->estado == 'problema' ? 'selected' : '' }}>
                                    Problema
                                </option>

                                <option value="tratamiento" {{ $planta->estado == 'tratamiento' ? 'selected' : '' }}>
                                    Tratamiento
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">
                            Actualizar
                        </button>

                        <a href="{{ route('plantas.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>