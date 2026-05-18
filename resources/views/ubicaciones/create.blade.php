<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Ubicación
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('ubicaciones.store') }}" method="POST" id="formulario-ubicacion">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tipo</label>
                        <select name="tipo" class="w-full border-gray-300 rounded" required>
                            <option value="publico">Público</option>
                            <option value="privado">Privado</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Zona recomendada (opcional)</label>
                        <select name="id_recomendacion_zona" id="zona-select" class="w-full border-gray-300 rounded">
                            <option value="">-- Selecciona una zona para llenar automáticamente --</option>
                            @php
                                $zonas = \App\Models\RecomendacionZona::orderBy('nombre_lugar')->get();
                            @endphp
                            @forelse($zonas as $zona)
                                <option value="{{ $zona->id }}">
                                    {{ $zona->nombre_lugar }} ({{ $zona->tipo_zona }})
                                </option>
                            @empty
                                <option value="" disabled>No hay zonas recomendadas registradas</option>
                            @endforelse
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Si seleccionas una zona, los datos se llenarán automáticamente</p>
                    </div>

                    <!-- MAPA INTERACTIVO -->
                    <div class="mb-6">
                        <label class="block font-medium mb-2">Selecciona ubicación en el mapa</label>
                        <x-mapa-interactivo 
                            id="mapa-ubicacion"
                            :canSelectLocation="true"
                            showToolbar="true"
                            height="400px"
                        />
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nombre del lugar</label>
                        <input type="text" name="nombre_lugar" id="nombre-lugar" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="w-full border-gray-300 rounded"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium mb-1">Latitud</label>
                            <input type="text" name="latitud" id="latitud" class="w-full border-gray-300 rounded" readonly>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Longitud</label>
                            <input type="text" name="longitud" id="longitud" class="w-full border-gray-300 rounded" readonly>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Guardar
                        </button>

                        <a href="{{ route('ubicaciones.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
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

        // Mapeo de zonas (se genera del servidor)
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
                
                // Actualizar mapa
                if (window.mapaInstancias && window.mapaInstancias['mapa-ubicacion']) {
                    const mapa = window.mapaInstancias['mapa-ubicacion'];
                    mapa.setView([zona.latitud, zona.longitud], 15);
                }
            }
        });

        // Actualizar coordenadas cuando se selecciona en el mapa
        setInterval(() => {
            if (window.ubicacionSeleccionada) {
                latInput.value = window.ubicacionSeleccionada.latitud.toFixed(7);
                lngInput.value = window.ubicacionSeleccionada.longitud.toFixed(7);
                nombreInput.value = window.ubicacionSeleccionada.nombreLugar || nombreInput.value;
            }
        }, 500);

        // Validar formulario
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