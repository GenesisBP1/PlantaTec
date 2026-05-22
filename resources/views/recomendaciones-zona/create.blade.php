<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Zonas públicas</p>
                <h2 class="pt-header-title">Nueva zona pública</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Registrar zona pública</h3>
                    <p class="pt-form-subtitle">
                        Agrega una zona recomendada para plantar o ubicar adopciones públicas.
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

                <form action="{{ route('recomendaciones-zona.store') }}" method="POST">
                    @csrf

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Nombre del lugar *</label>
                            <input
                                type="text"
                                name="nombre_lugar"
                                value="{{ old('nombre_lugar') }}"
                                required
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Tipo de zona</label>
                            <input
                                type="text"
                                name="tipo_zona"
                                value="{{ old('tipo_zona') }}"
                                placeholder="Ej: Parque urbano, Jardín botánico..."
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Indicaciones</label>
                            <textarea
                                name="indicaciones"
                                rows="3"
                                placeholder="Recomendaciones para plantar..."
                            >{{ old('indicaciones') }}</textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Latitud</label>
                            <input
                                type="text"
                                name="latitud"
                                value="{{ old('latitud') }}"
                                placeholder="Ej: 25.8792"
                            >
                        </div>

                        <div class="pt-form-group">
                            <label>Longitud</label>
                            <input
                                type="text"
                                name="longitud"
                                value="{{ old('longitud') }}"
                                placeholder="Ej: -97.5044"
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción completa</label>
                            <textarea
                                name="descripcion"
                                rows="4"
                                placeholder="Información adicional sobre el lugar..."
                            >{{ old('descripcion') }}</textarea>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="{{ route('recomendaciones-zona.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>

                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar zona
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>