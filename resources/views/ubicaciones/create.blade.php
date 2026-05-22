<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Ubicaciones</p>
                <h2 class="pt-header-title">Registrar ubicación</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Agregar ubicación</h3>
                    <p class="pt-form-subtitle">
                        Registra una ubicación pública o privada y selecciónala directamente en el mapa.
                    </p>
                </div>

                <form action="{{ route('ubicaciones.store') }}" method="POST" id="formulario-ubicacion">
                    @csrf

                    <div class="pt-form-grid">

                        <div class="pt-form-group">
                            <label>Tipo</label>
                            <select name="tipo" required>
                                <option value="publico">Público</option>
                                <option value="privado">Privado</option>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Zona recomendada (opcional)</label>
                            <select name="id_recomendacion_zona" id="zona-select">
                                <option value="">Selecciona una zona para llenar automáticamente</option>

                                @php
                                    $zonas = \App\Models\RecomendacionZona::orderBy('nombre_lugar')->get();
                                @endphp

                                @forelse($zonas as $zona)
                                    <option value="{{ $zona->id }}">
                                        {{ $zona->nombre_lugar }} ({{ $zona->tipo_zona }})
                                    </option>
                                @empty
                                    <option disabled>No hay zonas recomendadas registradas</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Selecciona ubicación en el mapa</label>

                            <x-mapa-interactivo
                                id="mapa-ubicacion"
                                :canSelectLocation="true"
                                showToolbar="true"
                                height="400px"
                            />
                        </div>

                        <div class="pt-form-group full">
                            <label>Nombre del lugar</label>
                            <input type="text" name="nombre_lugar" id="nombre-lugar" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4"></textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Latitud</label>
                            <input type="text" name="latitud" id="latitud" readonly>
                        </div>

                        <div class="pt-form-group">
                            <label>Longitud</label>
                            <input type="text" name="longitud" id="longitud" readonly>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="{{ route('ubicaciones.index') }}" class="pt-btn pt-btn-dark">
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

    <script>
        const zonaSelect = document.getElementById('zona-select');
        const nombreInput = document.getElementById('nombre-lugar');
        const descInput = document.getElementById('descripcion');
        const latInput = document.getElementById('latitud');
        const lngInput = document.getElementById('longitud');

        const zonasData = {
            @foreach(\App\Models\RecomendacionZona::all() as $zona)
                {{ $zona->id }}: {
                    nombre: "{{ $zona->nombre_lugar }}",
                    descripcion: "{{ $zona->descripcion }}",
                    latitud: {{ $zona->latitud }},
                    longitud: {{ $zona->longitud }}
                },
            @endforeach
        };

        zonaSelect.addEventListener('change', function() {
            if (this.value && zonasData[this.value]) {
                const zona = zonasData[this.value];

                nombreInput.value = zona.nombre;
                descInput.value = zona.descripcion || '';
                latInput.value = zona.latitud;
                lngInput.value = zona.longitud;

                if (window.mapaInstancias && window.mapaInstancias['mapa-ubicacion']) {
                    const mapa = window.mapaInstancias['mapa-ubicacion'];
                    mapa.setView([zona.latitud, zona.longitud], 15);
                }
            }
        });

        setInterval(() => {
            if (window.ubicacionSeleccionada) {
                latInput.value = window.ubicacionSeleccionada.latitud.toFixed(7);
                lngInput.value = window.ubicacionSeleccionada.longitud.toFixed(7);
                nombreInput.value = window.ubicacionSeleccionada.nombreLugar || nombreInput.value;
            }
        }, 500);

        document.getElementById('formulario-ubicacion').addEventListener('submit', function(e) {
            if (!nombreInput.value.trim()) {
                e.preventDefault();
                alert('El nombre del lugar es obligatorio');
                return false;
            }

            if (!latInput.value || !lngInput.value) {
                e.preventDefault();
                alert('Debes seleccionar una ubicación en el mapa o elegir una zona recomendada');
                return false;
            }
        });
    </script>
</x-app-layout>