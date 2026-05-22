<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Problemas</p>
                <h2 class="pt-header-title">Editar problema</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">Actualizar problema</h3>
                    <p class="pt-form-subtitle">
                        Modifica la información del problema registrado.
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

                <form action="{{ route('problemas.update', $problema) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Nombre</label>
                            <input
                                type="text"
                                name="nombre"
                                value="{{ old('nombre', $problema->nombre) }}"
                                required
                            >
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="5">{{ old('descripcion', $problema->descripcion) }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Imagen (opcional)</label>
                            <input
                                type="text"
                                name="imagen"
                                value="{{ old('imagen', $problema->imagen) }}"
                                placeholder="URL o referencia"
                            >
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-yellow">
                            Actualizar
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