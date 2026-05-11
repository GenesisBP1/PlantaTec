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

                <!-- FORMULARIO CORREGIDO (con nombres separados) -->
                <form action="{{ route('catalogo.plantas.adoptar', $planta) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Tipo de ubicación</label>
                        <select name="tipo" id="tipoUbicacion" required>
                            <option value="">Selecciona</option>
                            <option value="publico">Pública</option>
                            <option value="privado">Privada</option>
                        </select>
                    </div>

                    <div id="ubicacionPublica" class="hidden">
                        <div class="form-group">
                            <label>Zona pública recomendada</label>

                            <select name="id_recomendacion_zona">
                                <option value="">Selecciona una zona recomendada</option>

                                @foreach($zonasRecomendadas as $zona)
                                    <option value="{{ $zona->id }}">
                                        {{ $zona->nombre_lugar }} - {{ $zona->tipo_zona }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <p class="text-sm text-gray-500">
                            Al elegir una zona pública se tomarán automáticamente el nombre, descripción, latitud y longitud registrados.
                        </p>
                    </div>

                    <div id="ubicacionPrivada" class="hidden">
                        <div class="form-group">
                            <label>Nombre del lugar privado</label>
                            <input type="text"
                                   name="nombre_lugar_privado"
                                   placeholder="Ejemplo: Mi casa, patio, huerta familiar">
                        </div>

                        <div class="form-group">
                            <label>Descripción opcional</label>
                            <textarea name="descripcion_privada"
                                      placeholder="Ejemplo: patio trasero con sombra por la tarde"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-adoptar">Adoptar planta</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const tipoUbicacion = document.getElementById('tipoUbicacion');
        const ubicacionPublica = document.getElementById('ubicacionPublica');
        const ubicacionPrivada = document.getElementById('ubicacionPrivada');

        function toggleCampos() {
            const tipo = tipoUbicacion.value;
            if (tipo === 'publico') {
                ubicacionPublica.classList.remove('hidden');
                ubicacionPrivada.classList.add('hidden');
            } else if (tipo === 'privado') {
                ubicacionPrivada.classList.remove('hidden');
                ubicacionPublica.classList.add('hidden');
            } else {
                ubicacionPublica.classList.add('hidden');
                ubicacionPrivada.classList.add('hidden');
            }
        }

        tipoUbicacion.addEventListener('change', toggleCampos);
        toggleCampos();
    </script>
</x-app-layout>