<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Registro de cuidados</p>
                <h2 class="pt-header-title">Registrar cuidado</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">{{ $adopcion->planta->nombre }}</h3>
                    <p class="pt-form-subtitle">
                        Registra un cuidado realizado para esta planta adoptada.
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

                <form action="{{ route('registro-cuidados.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id_adopcion" value="{{ $adopcion->id }}">

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Tipo de cuidado</label>
                            <select name="id_planta_cuidado" required>
                                <option value="">Selecciona un cuidado</option>
                                @foreach($cuidados as $cuidado)
                                    <option value="{{ $cuidado->id }}"
                                        {{ isset($selectedCuidadoId) && $selectedCuidadoId == $cuidado->id ? 'selected' : '' }}>
                                        {{ $cuidado->cuidado->nombre }} (cada {{ $cuidado->frecuencia }} días)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Fecha</label>
                            <input
                                type="datetime-local"
                                name="fecha"
                                value="{{ old('fecha', now()->format('Y-m-d\TH:i')) }}"
                                required
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción (opcional)</label>
                            <textarea
                                name="descripcion"
                                rows="3"
                                placeholder="Describe la actividad realizada..."
                            >{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Estado observado (opcional)</label>
                            <input
                                type="text"
                                name="estado_observado"
                                value="{{ old('estado_observado') }}"
                                placeholder="Ejemplo: hojas saludables, sin plagas"
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Imagen (evidencia)</label>
                            <input
                                type="file"
                                name="imagen"
                                accept="image/*"
                            >
                            <small>Formatos permitidos: JPG, PNG, WebP (máx 2MB)</small>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="{{ route('adopciones.show', $adopcion) }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>

                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar registro
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>