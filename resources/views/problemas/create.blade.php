<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Problemas</p>
                <h2 class="pt-header-title">Registrar problema</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Registrar problema</h3>
                    <p class="pt-form-subtitle">
                        Agrega un nuevo problema o afectación para las plantas del sistema.
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

                <form action="{{ route('problemas.store') }}" method="POST">
                    @csrf

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Nombre</label>
                            <input
                                type="text"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                required
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="5">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Imagen (opcional)</label>
                            <input
                                type="text"
                                name="imagen"
                                value="{{ old('imagen') }}"
                                placeholder="URL o referencia"
                            >
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar
                        </button>

                        <a href="{{ route('problemas.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>