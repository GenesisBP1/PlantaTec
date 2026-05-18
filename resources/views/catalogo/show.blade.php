<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🌱 Adoptar Planta
        </h2>
    </x-slot>

    <style>
        .adopcion-container { max-width: 1100px; margin: 0 auto; padding: 1rem; }
        .planta-card { background: white; border-radius: 24px; box-shadow: 0 12px 28px rgba(0,32,0,0.08); margin-bottom: 2rem; display: flex; flex-wrap: wrap; overflow: hidden; }
        .planta-imagen { flex: 1; min-width: 250px; background: #e2f0e6; display: flex; align-items: center; justify-content: center; padding: 1.5rem; }
        .planta-imagen img { max-width: 100%; max-height: 280px; object-fit: contain; border-radius: 20px; }
        .planta-info { flex: 2; padding: 2rem; }
        .formulario-card { background: white; border-radius: 24px; box-shadow: 0 12px 28px rgba(0,32,0,0.08); padding: 2rem; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 0.5rem; color: #2c5e44; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 0.8rem 1rem; border-radius: 16px; border: 1px solid #cde0d4; background: #fefef9; }
        .btn-adoptar { background: linear-gradient(105deg,#2b7840,#3e8a5a); color: white; border: none; padding: 0.9rem 1.8rem; border-radius: 60px; font-weight: 700; cursor: pointer; }
        .hidden { display: none; }
        .text-red-500 { color: #ef4444; }
        .text-sm { font-size: 0.875rem; }
        @media (max-width:768px){ .planta-card { flex-direction: column; } }
    </style>

    <div class="py-8">
        <div class="adopcion-container">
            <div class="planta-card">
                <div class="planta-imagen">
                    @php
                        $imagenUrl = 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&fit=crop';
                        if ($planta->imagen) {
                            if (filter_var($planta->imagen, FILTER_VALIDATE_URL)) {
                                $imagenUrl = $planta->imagen;
                            } elseif (file_exists(public_path('storage/' . $planta->imagen))) {
                                $imagenUrl = asset('storage/' . $planta->imagen);
                            }
                        }
                    @endphp
                    <img src="{{ $imagenUrl }}" alt="{{ $planta->nombre }}">
                </div>

                <div class="planta-info">
                    <h3 class="text-2xl font-bold text-green-700">{{ $planta->nombre }}</h3>
                    <p class="mt-2"><strong>Especie:</strong> {{ $planta->especie }}</p>
                    <p class="mt-2"><strong>Zona recomendada:</strong> {{ $planta->tipo_zona ?? 'Zona no especificada' }}</p>
                    <p class="mt-2"><strong>Estado:</strong> {{ ucfirst($planta->estado) }}</p>
                    <p class="mt-4 text-gray-700">{{ $planta->descripcion ?? 'Sin descripción.' }}</p>
                </div>
            </div>

            <div class="formulario-card">
                <h4 class="text-xl font-bold text-gray-800 mb-4">Datos de ubicación</h4>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORMULARIO CON MAPA INTERACTIVO -->
                <form id="formulario-adopcion" action="{{ route('catalogo.plantas.adoptar', $planta) }}" method="POST">
                    @csrf

                    <!-- Tipo de ubicación -->
                    <div class="form-group">
                        <label>Tipo de ubicación</label>
                        <select name="tipo" id="tipoUbicacion" required>
                            <option value="">Selecciona</option>
                            <option value="publico">Pública</option>
                            <option value="privado">Privada</option>
                        </select>
                    </div>

                    <!-- OPCIÓN 1: UBICACIÓN PÚBLICA (Zona recomendada o Mapa) -->
                    <div id="ubicacionPublica" class="hidden">
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700 mb-3">¿Cómo deseas seleccionar la ubicación?</label>
                            <div class="flex gap-3">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="metodo_ubicacion_publica" value="zona" checked class="metodo-ubicacion" data-metodo="zona">
                                    <span>Zona recomendada</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="metodo_ubicacion_publica" value="mapa" class="metodo-ubicacion" data-metodo="mapa">
                                    <span>Seleccionar en mapa</span>
                                </label>
                            </div>
                        </div>

                        <!-- Subopción: Zona Recomendada -->
                        <div id="subopcion-zona" class="form-group">
                            <label>Zona pública recomendada</label>
                            <select name="id_recomendacion_zona">
                                <option value="">Selecciona una zona recomendada</option>
                                @foreach($zonasRecomendadas as $zona)
                                    <option value="{{ $zona->id }}">
                                        {{ $zona->nombre_lugar }} - {{ $zona->tipo_zona }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-500 mt-2">
                                Se tomarán automáticamente el nombre, descripción, latitud y longitud registrados.
                            </p>
                        </div>

                        <!-- Subopción: Mapa -->
                        <div id="subopcion-mapa" class="hidden">
                            <p class="text-sm text-blue-700 mb-3">👇 Selecciona tu ubicación en el mapa o usa la geolocalización automática.</p>
                            <x-mapa-interactivo 
                                id="mapa-adopcion-publica"
                                :canSelectLocation="true"
                                showToolbar="true"
                                height="400px"
                            />
                            <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded">
                                <p class="text-sm text-blue-900">Ubicación seleccionada: <strong id="ubicacion-seleccionada-publica">Ninguna</strong></p>
                            </div>
                            <input type="hidden" name="latitud" id="input-latitud">
                            <input type="hidden" name="longitud" id="input-longitud">
                            <input type="hidden" name="nombre_lugar" id="input-nombre_lugar">
                            <input type="hidden" name="es_publica" id="input-es_publica" value="1">
                        </div>
                    </div>

                    <!-- OPCIÓN 2: UBICACIÓN PRIVADA (Nombre simple o Mapa) -->
                    <div id="ubicacionPrivada" class="hidden">
                        <div class="mb-4">
                            <label class="block font-semibold text-gray-700 mb-3">¿Cómo deseas registrar la ubicación?</label>
                            <div class="flex gap-3">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="metodo_ubicacion_privada" value="nombre" checked class="metodo-ubicacion" data-metodo="nombre">
                                    <span>Solo nombre</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="metodo_ubicacion_privada" value="mapa" class="metodo-ubicacion" data-metodo="mapa">
                                    <span>Con ubicación en mapa</span>
                                </label>
                            </div>
                        </div>

                        <!-- Subopción: Solo nombre -->
                        <div id="subopcion-nombre" class="form-group">
                            <label>Nombre del lugar privado</label>
                            <input type="text"
                                   name="nombre_lugar_privado"
                                   placeholder="Ejemplo: Mi casa, patio, huerta familiar">
                            
                            <label class="mt-3">Descripción opcional</label>
                            <textarea name="descripcion_privada"
                                      placeholder="Ejemplo: patio trasero con sombra por la tarde"></textarea>
                        </div>

                        <!-- Subopción: Con mapa -->
                        <div id="subopcion-mapa-privada" class="hidden">
                            <p class="text-sm text-blue-700 mb-3">👇 Selecciona tu ubicación en el mapa.</p>
                            <x-mapa-interactivo 
                                id="mapa-adopcion-privada"
                                :canSelectLocation="true"
                                showToolbar="true"
                                height="400px"
                            />
                            <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded">
                                <p class="text-sm text-blue-900">Ubicación seleccionada: <strong id="ubicacion-seleccionada-privada">Ninguna</strong></p>
                            </div>

                            <div class="mt-4">
                                <label>Nombre del lugar</label>
                                <input type="text"
                                       name="nombre_lugar_privado_mapa"
                                       id="input-nombre_lugar_privado"
                                       placeholder="Ejemplo: Mi casa, patio">
                                
                                <label class="mt-3">Descripción opcional</label>
                                <textarea name="descripcion_privada_mapa"
                                          id="input-descripcion_privada"
                                          placeholder="Detalles sobre el lugar"></textarea>
                            </div>

                            <input type="hidden" name="latitud_privada" id="input-latitud-privada">
                            <input type="hidden" name="longitud_privada" id="input-longitud-privada">
                            <input type="hidden" name="es_publica_privada" id="input-es_publica_privada" value="0">
                        </div>
                    </div>

                    <button type="submit" class="btn-adoptar mt-4">Adoptar planta</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const tipoUbicacion = document.getElementById('tipoUbicacion');
        const ubicacionPublica = document.getElementById('ubicacionPublica');
        const ubicacionPrivada = document.getElementById('ubicacionPrivada');
        const formulario = document.getElementById('formulario-adopcion');

        // Cambio de tipo de ubicación
        tipoUbicacion.addEventListener('change', function() {
            const tipo = this.value;
            ubicacionPublica.classList.toggle('hidden', tipo !== 'publico');
            ubicacionPrivada.classList.toggle('hidden', tipo !== 'privado');
        });

        // Método de ubicación pública
        document.querySelectorAll('input[name="metodo_ubicacion_publica"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const metodo = this.value;
                document.getElementById('subopcion-zona').classList.toggle('hidden', metodo !== 'zona');
                document.getElementById('subopcion-mapa').classList.toggle('hidden', metodo !== 'mapa');
                
                // Si se muestra el mapa, recalcular su tamaño (Leaflet fix)
                if (metodo === 'mapa' && window.mapaInstancias && window.mapaInstancias['mapa-adopcion-publica']) {
                    setTimeout(() => {
                        window.mapaInstancias['mapa-adopcion-publica'].invalidateSize();
                    }, 50);
                }
            });
        });

        // Método de ubicación privada
        document.querySelectorAll('input[name="metodo_ubicacion_privada"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const metodo = this.value;
                document.getElementById('subopcion-nombre').classList.toggle('hidden', metodo !== 'nombre');
                document.getElementById('subopcion-mapa-privada').classList.toggle('hidden', metodo !== 'mapa');
                
                // Si se muestra el mapa, recalcular su tamaño (Leaflet fix)
                if (metodo === 'mapa' && window.mapaInstancias && window.mapaInstancias['mapa-adopcion-privada']) {
                    setTimeout(() => {
                        window.mapaInstancias['mapa-adopcion-privada'].invalidateSize();
                    }, 50);
                }
            });
        });

        // Actualizar ubicación seleccionada en los mapas
        setInterval(() => {
            if (window.ubicacionSeleccionada) {
                const lat = window.ubicacionSeleccionada.latitud.toFixed(4);
                const lng = window.ubicacionSeleccionada.longitud.toFixed(4);
                
                // Actualizar display según cuál mapa está activo
                if (!document.getElementById('subopcion-mapa').classList.contains('hidden')) {
                    document.getElementById('ubicacion-seleccionada-publica').textContent = `${lat}, ${lng}`;
                    document.getElementById('input-latitud').value = window.ubicacionSeleccionada.latitud;
                    document.getElementById('input-longitud').value = window.ubicacionSeleccionada.longitud;
                    document.getElementById('input-nombre_lugar').value = window.ubicacionSeleccionada.nombreLugar;
                }
                
                if (!document.getElementById('subopcion-mapa-privada').classList.contains('hidden')) {
                    document.getElementById('ubicacion-seleccionada-privada').textContent = `${lat}, ${lng}`;
                    document.getElementById('input-latitud-privada').value = window.ubicacionSeleccionada.latitud;
                    document.getElementById('input-longitud-privada').value = window.ubicacionSeleccionada.longitud;
                }
            }
        }, 500);

        // Validar formulario antes de enviar
        formulario.addEventListener('submit', function(e) {
            const tipo = document.getElementById('tipoUbicacion').value;
            
            if (tipo === 'publico') {
                const metodo = document.querySelector('input[name="metodo_ubicacion_publica"]:checked')?.value;
                if (metodo === 'zona') {
                    const zona = document.querySelector('select[name="id_recomendacion_zona"]').value;
                    if (!zona) {
                        e.preventDefault();
                        alert('Por favor selecciona una zona recomendada');
                    }
                } else if (metodo === 'mapa') {
                    if (!window.ubicacionSeleccionada) {
                        e.preventDefault();
                        alert('Por favor selecciona una ubicación en el mapa');
                    }
                }
            } else if (tipo === 'privado') {
                const metodo = document.querySelector('input[name="metodo_ubicacion_privada"]:checked')?.value;
                if (metodo === 'nombre') {
                    const nombre = document.querySelector('input[name="nombre_lugar_privado"]').value;
                    if (!nombre) {
                        e.preventDefault();
                        alert('Por favor ingresa el nombre del lugar');
                    }
                } else if (metodo === 'mapa') {
                    const nombre = document.getElementById('input-nombre_lugar_privado').value;
                    if (!nombre) {
                        e.preventDefault();
                        alert('Por favor ingresa el nombre del lugar');
                    }
                    if (!window.ubicacionSeleccionada) {
                        e.preventDefault();
                        alert('Por favor selecciona una ubicación en el mapa');
                    }
                }
            }
        });
    </script>
</x-app-layout>