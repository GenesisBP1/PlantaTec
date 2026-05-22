<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Cuidados</p>
                <h2 class="pt-header-title">Registrar cuidado</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Registrar cuidado</h3>
                    <p class="pt-form-subtitle">
                        Agrega un nuevo cuidado para el sistema.
                    </p>
                </div>

                <form action="{{ route('cuidados.store') }}" method="POST">
                    @csrf

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Nombre del cuidado</label>
                            <input type="text" name="nombre" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="5"></textarea>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar
                        </button>

                        <a href="{{ route('cuidados.index') }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>