<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Plantas</p>
                <h2 class="pt-header-title">Registrar planta</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Registrar planta</h3>
                    <p class="pt-form-subtitle">
                        Agrega una nueva planta al catálogo del sistema.
                    </p>
                </div>

                <form action="{{ route('plantas.store') }}" method="POST">
                    @csrf

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" required>
                        </div>

                        <div class="pt-form-group">
                            <label>Especie</label>
                            <input type="text" name="especie" required>
                        </div>

                        <div class="pt-form-group">
                            <label>Tipo de zona</label>
                            <input type="text" name="tipo_zona">
                        </div>

                        <div class="pt-form-group">
                            <label>Imagen</label>
                            <input type="text"
                                   name="imagen"
                                   placeholder="URL o nombre de imagen">
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="4"></textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Estado</label>
                            <select name="estado" required>
                                <option value="saludable">Saludable</option>
                                <option value="observacion">Observación</option>
                                <option value="problema">Problema</option>
                                <option value="tratamiento">Tratamiento</option>
                            </select>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-green">
                            Guardar
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