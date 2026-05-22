<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Zonas públicas</p>
                <h2 class="pt-header-title">Editar zona pública</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">{{ $zona->nombre_lugar }}</h3>
                    <p class="pt-form-subtitle">
                        Actualiza la información de esta zona recomendada.
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

                <form action="{{ route('recomendaciones-zona.update', $zona) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Nombre del lugar *</label>
                            <input
                                type="text"
                                name="nombre_lugar"
                                value="{{ old('nombre_lugar', $zona->nombre_lugar) }}"
                                required
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Tipo de zona</label>
                            <input
                                type="text"
                                name="tipo_zona"
                                value="{{ old('tipo_zona', $zona->tipo_zona) }}"
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Indicaciones</label>
                            <textarea
                                name="indicaciones"
                                rows="3"
                            >{{ old('indicaciones', $zona->indicaciones) }}</textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Latitud</label>
                            <input
                                type="text"
                                name="latitud"
                                value="{{ old('latitud', $zona->latitud) }}"
                            >
                        </div>

                        <div class="pt-form-group">
                            <label>Longitud</label>
                            <input
                                type="text"
                                name="longitud"
                                value="{{ old('longitud', $zona->longitud) }}"
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción completa</label>
                            <textarea
                                name="descripcion"
                                rows="4"
                            >{{ old('descripcion', $zona->descripcion) }}</textarea>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="{{ route('recomendaciones-zona.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>

                        <button type="submit" class="pt-btn pt-btn-yellow">
                            Actualizar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>