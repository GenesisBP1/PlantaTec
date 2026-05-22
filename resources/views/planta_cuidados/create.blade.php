<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Cuidados por planta</p>
                <h2 class="pt-header-title">Asignar cuidado a planta</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Asignar cuidado</h3>
                    <p class="pt-form-subtitle">
                        Relaciona una planta con un cuidado, frecuencia e instrucciones específicas.
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

                <form action="{{ route('planta-cuidados.store') }}" method="POST">
                    @csrf

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Planta</label>
                            <select name="id_planta" required>
                                <option value="">Selecciona una planta</option>
                                @foreach($plantas as $planta)
                                    <option value="{{ $planta->id }}" {{ old('id_planta') == $planta->id ? 'selected' : '' }}>
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
                                    <option value="{{ $cuidado->id }}" {{ old('id_cuidado') == $cuidado->id ? 'selected' : '' }}>
                                        {{ $cuidado->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Frecuencia (días)</label>
                            <input
                                type="number"
                                name="frecuencia"
                                value="{{ old('frecuencia') }}"
                                placeholder="Ejemplo: 3"
                                min="1"
                                required
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Instrucciones</label>
                            <textarea
                                name="instrucciones_esp"
                                rows="4"
                                placeholder="Ejemplo: regar sin encharcar"
                            >{{ old('instrucciones_esp') }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Evidencia (opcional)</label>
                            <input
                                type="text"
                                name="evidencia"
                                value="{{ old('evidencia') }}"
                                placeholder="Texto o referencia"
                            >
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="{{ route('planta-cuidados.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>

                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>