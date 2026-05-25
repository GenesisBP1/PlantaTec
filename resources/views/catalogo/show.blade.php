<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Adopción</p>
                <h2 class="pt-header-title">Adoptar planta</h2>
                <p class="pt-header-subtitle">Completa los datos de ubicación para finalizar la adopción</p>
            </div>
            <div class="pt-header-actions">
                <a href="{{ route('catalogo.plantas') }}" class="pt-btn pt-btn-light">← Volver al catálogo</a>
            </div>
        </div>
    </x-slot>

    <style>
        /* ========== ESTILOS ESPECÍFICOS PARA ADOPTAR PLANTA ========== */
        /* (El layout base ya trae reset, navbar, colores, etc.) */

        .pt-catalog-show-card {
            background: #ffffff;
            border-radius: 2rem;
            box-shadow: 0 20px 35px rgba(0, 32, 0, 0.12);
            margin-bottom: 2rem;
            display: flex;
            overflow: hidden;
            border: 1px solid rgba(100, 140, 110, 0.2);
        }
        .pt-catalog-show-image {
            flex: 1.2;
            min-width: 280px;
            background: linear-gradient(135deg, #e2f0e6, #c8e0d0);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .pt-catalog-show-image img {
            max-width: 100%;
            max-height: 320px;
            object-fit: contain;
            border-radius: 1.5rem;
            filter: drop-shadow(0 8px 12px rgba(0,0,0,0.1));
        }
        .pt-catalog-show-info {
            flex: 2;
            padding: 2rem;
            background: #ffffff;
        }
        .pt-catalog-show-info h3 {
            font-size: 2.1rem;
            font-weight: 900;
            color: #1e3a2f;
            margin-bottom: 0.5rem;
        }
        .pt-badge-estado {
            display: inline-block;
            background: #e2f0e6;
            color: #2b7840;
            padding: 0.25rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            margin: 0.5rem 0;
        }
        .pt-care-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }
        .pt-care-item {
            background: #f8faf6;
            border-radius: 1.2rem;
            padding: 0.9rem 1rem;
            border-left: 4px solid #2b7840;
        }
        .pt-care-item strong {
            color: #1e3a2f;
            font-size: 1rem;
        }
        .pt-care-item p {
            font-size: 0.75rem;
            color: #6f8f7a;
            margin: 0.25rem 0;
        }
        .pt-adoption-form-card {
            background: #ffffff;
            border-radius: 1.75rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .pt-radio-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            background: #f4fbf2;
            padding: 1rem 1.2rem;
            border-radius: 1.25rem;
            border: 1px solid #dbe7df;
        }
        .pt-radio-group label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            font-weight: 600;
            color: #1f2937;
        }
        .pt-radio-group input[type="radio"] {
            width: 1.1rem;
            height: 1.1rem;
            accent-color: #16a34a;
        }
        .pt-location-box {
            margin-top: 0.9rem;
            padding: 0.9rem 1rem;
            background: #eff6ff;
            border-radius: 1rem;
            border: 1px solid #bfdbfe;
            color: #1e3a8a;
            font-size: 0.875rem;
        }
        .pt-submit-btn {
            width: 100%;
            background: linear-gradient(105deg, #2b7840, #3e8a5a);
            color: white;
            border: none;
            padding: 0.9rem 1.2rem;
            border-radius: 999px;
            font-weight: 900;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }
        .pt-submit-btn:hover {
            background: linear-gradient(105deg, #236a3b, #2b7840);
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(43, 120, 64, 0.25);
        }
        @media (max-width: 768px) {
            .pt-catalog-show-card {
                flex-direction: column;
            }
            .pt-catalog-show-info h3 {
                font-size: 1.7rem;
            }
            .pt-adoption-form-card {
                padding: 1.25rem;
            }
            .pt-radio-group {
                gap: 0.5rem;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container">

            <!-- Tarjeta de información de la planta -->
            <div class="pt-catalog-show-card">
                <div class="pt-catalog-show-image">
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

                <div class="pt-catalog-show-info">
                    <h3>{{ $planta->nombre }}</h3>
                    <p class="pt-text"><strong>Especie:</strong> {{ $planta->especie }}</p>
                    <span class="pt-badge-estado">Estado: {{ ucfirst($planta->estado) }}</span>

                    <div class="pt-show-section">
                        <h4 class="pt-show-section-title">Cuidados necesarios</h4>
                        @if($planta->plantaCuidados && $planta->plantaCuidados->count())
                            <div class="pt-care-grid">
                                @foreach($planta->plantaCuidados as $pc)
                                    <div class="pt-care-item">
                                        <strong>{{ $pc->cuidado->nombre }}</strong>
                                        <p>Cada {{ $pc->frecuencia }} días</p>
                                        @if($pc->instrucciones_esp)
                                            <span class="pt-text-muted">{{ Str::limit($pc->instrucciones_esp, 60) }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="pt-muted">No se han definido cuidados específicos para esta planta.</p>
                        @endif
                    </div>

                    <div class="pt-show-section">
                        <p class="pt-text"><strong>Zona recomendada:</strong> {{ $planta->tipo_zona ?? 'No especificada' }}</p>
                        <p class="pt-description">{{ $planta->descripcion ?? 'Sin descripción.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Formulario de adopción -->
            <div class="pt-card pt-adoption-form-card">
                <h4 class="pt-section-title">Datos de ubicación para la adopción</h4>

                @if($errors->any())
                    <div class="pt-alert-error">
                        <strong>Revisa los campos del formulario:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formulario-adopcion" action="{{ route('catalogo.plantas.adoptar', $planta) }}" method="POST">
                    @csrf

                    <div class="pt-form-group">
                        <label>Tipo de ubicación</label>
                        <select name="tipo" id="tipoUbicacion" required>
                            <option value="">Selecciona</option>
                            <option value="publico">Pública (parque, jardín público)</option>
                            <option value="privado">Privada (casa, jardín particular)</option>
                        </select>
                    </div>

                    <!-- Ubicación pública -->
                    <div id="ubicacionPublica" class="hidden">
                        <div class="pt-form-group">
                            <label>¿Cómo deseas seleccionar la ubicación?</label>
                            <div class="pt-radio-group">
                                <label>
                                    <input type="radio" name="metodo_ubicacion_publica" value="zona" checked class="metodo-ubicacion" data-metodo="zona">
                                    <span>Elegir zona recomendada</span>
                                </label>
                                <label>
                                    <input type="radio" name="metodo_ubicacion_publica" value="mapa" class="metodo-ubicacion" data-metodo="mapa">
                                    <span>Seleccionar en el mapa</span>
                                </label>
                            </div>
                        </div>

                        <div id="subopcion-zona" class="pt-form-group">
                            <label>Zona pública recomendada</label>
                            <select name="id_recomendacion_zona">
                                <option value="">Selecciona una zona</option>
                                @foreach($zonasRecomendadas as $zona)
                                    <option value="{{ $zona->id }}">{{ $zona->nombre_lugar }} - {{ $zona->tipo_zona ?? 'Sin tipo' }}</option>
                                @endforeach
                            </select>
                            <p class="pt-help-text">Se tomarán automáticamente los datos de la zona.</p>
                        </div>

                        <div id="subopcion-mapa" class="hidden">
                            <p class="pt-info-message">Selecciona tu ubicación en el mapa o usa geolocalización.</p>
                            <x-mapa-interactivo 
                                id="mapa-adopcion-publica"
                                :canSelectLocation="true"
                                showToolbar="true"
                                height="400px"
                            />
                            <div class="pt-location-box">
                                <p>Ubicación elegida: <strong id="ubicacion-seleccionada-publica">Ninguna</strong></p>
                            </div>
                            <input type="hidden" name="latitud" id="input-latitud">
                            <input type="hidden" name="longitud" id="input-longitud">
                            <input type="hidden" name="nombre_lugar" id="input-nombre_lugar">
                            <input type="hidden" name="es_publica" value="1">
                        </div>
                    </div>

                    <!-- Ubicación privada -->
                    <div id="ubicacionPrivada" class="hidden">
                        <div class="pt-form-group">
                            <label>¿Cómo deseas registrar la ubicación?</label>
                            <div class="pt-radio-group">
                                <label>
                                    <input type="radio" name="metodo_ubicacion_privada" value="nombre" checked class="metodo-ubicacion" data-metodo="nombre">
                                    <span>Solo nombre</span>
                                </label>
                                <label>
                                    <input type="radio" name="metodo_ubicacion_privada" value="mapa" class="metodo-ubicacion" data-metodo="mapa">
                                    <span>Con ubicación exacta (mapa)</span>
                                </label>
                            </div>
                        </div>

                        <div id="subopcion-nombre" class="pt-form-group">
                            <label>Nombre del lugar privado</label>
                            <input type="text" name="nombre_lugar_privado" placeholder="Ejemplo: Mi casa, patio trasero, jardín familiar">
                            <label class="pt-mt-3">Descripción (opcional)</label>
                            <textarea name="descripcion_privada" rows="2" placeholder="Comparte detalles como luz, sombra, etc."></textarea>
                        </div>

                        <div id="subopcion-mapa-privada" class="hidden">
                            <p class="pt-info-message">Selecciona tu ubicación en el mapa.</p>
                            <x-mapa-interactivo 
                                id="mapa-adopcion-privada"
                                :canSelectLocation="true"
                                showToolbar="true"
                                height="400px"
                            />
                            <div class="pt-location-box">
                                <p>Ubicación elegida: <strong id="ubicacion-seleccionada-privada">Ninguna</strong></p>
                            </div>
                            <div class="pt-form-group">
                                <label>Nombre del lugar (obligatorio)</label>
                                <input type="text" name="nombre_lugar_privado_mapa" id="input-nombre_lugar_privado" placeholder="Ejemplo: Mi hogar, oficina, huerto">
                                <label class="pt-mt-3">Descripción (opcional)</label>
                                <textarea name="descripcion_privada_mapa" id="input-descripcion_privada" rows="2" placeholder="Información adicional..."></textarea>
                            </div>
                            <input type="hidden" name="latitud_privada" id="input-latitud-privada">
                            <input type="hidden" name="longitud_privada" id="input-longitud-privada">
                            <input type="hidden" name="es_publica_privada" value="0">
                        </div>
                    </div>

                    <button type="submit" class="pt-submit-btn">Adoptar {{ $planta->nombre }}</button>
                </form>
            </div>

        </div>
    </div>

    <script>
        // El mismo JavaScript original, sin cambios
        const tipoUbicacion = document.getElementById('tipoUbicacion');
        const ubicacionPublica = document.getElementById('ubicacionPublica');
        const ubicacionPrivada = document.getElementById('ubicacionPrivada');
        const formulario = document.getElementById('formulario-adopcion');

        tipoUbicacion.addEventListener('change', function() {
            const tipo = this.value;
            ubicacionPublica.classList.toggle('hidden', tipo !== 'publico');
            ubicacionPrivada.classList.toggle('hidden', tipo !== 'privado');
        });

        document.querySelectorAll('input[name="metodo_ubicacion_publica"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const metodo = this.value;
                document.getElementById('subopcion-zona').classList.toggle('hidden', metodo !== 'zona');
                document.getElementById('subopcion-mapa').classList.toggle('hidden', metodo !== 'mapa');
                if (metodo === 'mapa' && window.mapaInstancias && window.mapaInstancias['mapa-adopcion-publica']) {
                    setTimeout(() => { window.mapaInstancias['mapa-adopcion-publica'].invalidateSize(); }, 50);
                }
            });
        });

        document.querySelectorAll('input[name="metodo_ubicacion_privada"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const metodo = this.value;
                document.getElementById('subopcion-nombre').classList.toggle('hidden', metodo !== 'nombre');
                document.getElementById('subopcion-mapa-privada').classList.toggle('hidden', metodo !== 'mapa');
                if (metodo === 'mapa' && window.mapaInstancias && window.mapaInstancias['mapa-adopcion-privada']) {
                    setTimeout(() => { window.mapaInstancias['mapa-adopcion-privada'].invalidateSize(); }, 50);
                }
            });
        });

        setInterval(() => {
            if (window.ubicacionSeleccionada) {
                const lat = window.ubicacionSeleccionada.latitud.toFixed(4);
                const lng = window.ubicacionSeleccionada.longitud.toFixed(4);
                if (!document.getElementById('subopcion-mapa').classList.contains('hidden')) {
                    document.getElementById('ubicacion-seleccionada-publica').textContent = `${lat}, ${lng}`;
                    document.getElementById('input-latitud').value = window.ubicacionSeleccionada.latitud;
                    document.getElementById('input-longitud').value = window.ubicacionSeleccionada.longitud;
                    document.getElementById('input-nombre_lugar').value = window.ubicacionSeleccionada.nombreLugar || 'Lugar seleccionado';
                }
                if (!document.getElementById('subopcion-mapa-privada').classList.contains('hidden')) {
                    document.getElementById('ubicacion-seleccionada-privada').textContent = `${lat}, ${lng}`;
                    document.getElementById('input-latitud-privada').value = window.ubicacionSeleccionada.latitud;
                    document.getElementById('input-longitud-privada').value = window.ubicacionSeleccionada.longitud;
                }
            }
        }, 500);

        formulario.addEventListener('submit', function(e) {
            const tipo = document.getElementById('tipoUbicacion').value;
            if (tipo === 'publico') {
                const metodo = document.querySelector('input[name="metodo_ubicacion_publica"]:checked')?.value;
                if (metodo === 'zona') {
                    const zona = document.querySelector('select[name="id_recomendacion_zona"]').value;
                    if (!zona) { e.preventDefault(); alert('Por favor selecciona una zona recomendada'); }
                } else if (metodo === 'mapa') {
                    if (!window.ubicacionSeleccionada) { e.preventDefault(); alert('Por favor selecciona una ubicación en el mapa'); }
                }
            } else if (tipo === 'privado') {
                const metodo = document.querySelector('input[name="metodo_ubicacion_privada"]:checked')?.value;
                if (metodo === 'nombre') {
                    const nombre = document.querySelector('input[name="nombre_lugar_privado"]').value;
                    if (!nombre) { e.preventDefault(); alert('Por favor ingresa el nombre del lugar'); }
                } else if (metodo === 'mapa') {
                    const nombre = document.getElementById('input-nombre_lugar_privado').value;
                    if (!nombre) { e.preventDefault(); alert('Por favor ingresa el nombre del lugar'); }
                    if (!window.ubicacionSeleccionada) { e.preventDefault(); alert('Por favor selecciona una ubicación en el mapa'); }
                }
            }
        });
    </script>
</x-app-layout>