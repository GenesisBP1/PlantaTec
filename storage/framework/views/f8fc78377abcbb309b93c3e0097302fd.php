<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => 'mapa-interactive',
    'canSelectLocation' => false,
    'onLocationSelected' => null,
    'showToolbar' => true,
    'height' => '500px'
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'id' => 'mapa-interactive',
    'canSelectLocation' => false,
    'onLocationSelected' => null,
    'showToolbar' => true,
    'height' => '500px'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<style>
    #<?php echo e($id); ?>-container {
        position: relative;
        width: 100%;
        height: <?php echo e($height); ?>;
        border-radius: 0.5rem;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    #<?php echo e($id); ?> {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }
    
    .leaflet-control {
        z-index: 999 !important;
    }
</style>

<div id="<?php echo e($id); ?>-container">
    <div id="<?php echo e($id); ?>"></div>
</div>

<?php if($showToolbar): ?>
<div class="mt-4 p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Geolocalización -->
        <button 
            type="button"
            class="obtener-geolocation-btn flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition"
            data-mapa-id="<?php echo e($id); ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19C3.592 15.327 1 10.895 1 7c0-3.866 2.686-7 6-7s6 3.134 6 7c0 3.895-2.592 8.327-8 12zm12-7c0-3.866-2.686-7-6-7s-6 3.134-6 7c0 3.895 2.592 8.327 8 12c5.408-3.673 8-8.105 8-12z"/>
            </svg>
            Mi ubicación
        </button>

        <!-- Búsqueda de ubicaciones -->
        <div class="flex gap-2">
            <input 
                type="text"
                id="busqueda-ubicacion-<?php echo e($id); ?>"
                placeholder="Buscar ubicaciones..."
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            <button 
                type="button"
                class="buscar-ubicacion-btn bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition"
                data-mapa-id="<?php echo e($id); ?>">
                Buscar
            </button>
        </div>
    </div>

    <?php if($canSelectLocation): ?>
    <div class="mt-4 p-3 bg-amber-50 border border-amber-200 rounded-lg">
        <p class="text-sm text-amber-800">💡 Haz clic en el mapa para seleccionar tu ubicación o usa la geolocalización automática.</p>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- Información del marcador seleccionado -->
<div id="info-marcador-<?php echo e($id); ?>" class="hidden mt-4 p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
    <div class="space-y-2">
        <p><strong>Ubicación:</strong> <span id="info-nombre"></span></p>
        <p><strong>Descripción:</strong> <span id="info-descripcion"></span></p>
        <p><strong>Tipo:</strong> <span id="info-tipo"></span></p>
        <p><strong>Usuario:</strong> <span id="info-usuario"></span></p>
        <p><strong>Plantas:</strong> <span id="info-plantas"></span></p>
        <p class="text-xs text-gray-500"><strong>Coordenadas:</strong> <span id="info-coords"></span></p>
    </div>
    <div class="mt-3 flex gap-2">
        <button type="button" onclick="cerrarInfoMarcador('<?php echo e($id); ?>')" class="flex-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
            Cerrar
        </button>
    </div>
</div>

<script>
// Esperar a que Leaflet esté listo
document.addEventListener('DOMContentLoaded', function() {
    if (typeof L === 'undefined') {
        console.error('Leaflet no está cargado');
        return;
    }

    // Inicializar mapa
    const mapa = L.map('<?php echo e($id); ?>').setView([25.5095, -97.1559], 13); // Matamoros, Tamaulipas

    // Capa de tiles (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(mapa);

    // Marcador para la ubicación seleccionada
    let marcadorSeleccionado = null;
    const mapaId = '<?php echo e($id); ?>';

// Cargar ubicaciones existentes
    cargarUbicacionesEnMapa(mapa, mapaId);

    // Llamar específicamente a cargar zonas
    setTimeout(function() {
        cargarZonasRecomendadas(mapa);
    }, 500);

    // Hacer función global accesible
    window.cargarZonasRecomendadas = function(mapaRef) {
        const mapToUse = mapaRef || (window.mapaInstancias ? window.mapaInstancias[mapaId] : null);
        if (!mapToUse) {
            console.error('No hay mapa disponible para cargar zonas');
            return;
        }

        fetch('<?php echo e(route("api.mapa.zonas-recomendadas")); ?>')
            .then(response => response.json())
            .then(data => {
                console.log('📍 Respuesta API Zonas:', data);
                if (data.success && data.data && data.data.length > 0) {
                    data.data.forEach((zona, index) => {
                        console.log(`Cargando zona ${index + 1}:`, zona.nombre_lugar);
                        
                        const lat = parseFloat(zona.latitud);
                        const lng = parseFloat(zona.longitud);
                        
                        if (isNaN(lat) || isNaN(lng)) {
                            console.warn(`Coordenadas inválidas para ${zona.nombre_lugar}:`, lat, lng);
                            return;
                        }

                        const marcador = L.marker([lat, lng], {
                            icon: L.icon({
                                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            })
                        }).addTo(mapToUse);

                        const popup = `
                            <div class="p-3">
                                <h4 class="font-bold text-sm">🌿 ${zona.nombre_lugar}</h4>
                                <p class="text-xs text-gray-600 mt-1">${zona.descripcion || 'Sin descripción'}</p>
                                <p class="text-xs font-semibold mt-1">
                                    <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-800">
                                        Zona Recomendada
                                    </span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Tipo: ${zona.tipo_zona || 'Sin clasificar'}</p>
                            </div>
                        `;

                        marcador.bindPopup(popup);
                        console.log(`✓ Zona ${zona.nombre_lugar} cargada en verde`);
                    });
                    console.log(`✅ ${data.data.length} zonas cargadas correctamente en verde`);
                } else {
                    console.log('⚠️ No hay zonas recomendadas para mostrar');
                }
            })
            .catch(error => console.error('❌ Error cargando zonas recomendadas:', error));
    };


    // Click en el mapa para seleccionar ubicación
    <?php if($canSelectLocation): ?>
    mapa.on('click', function(e) {
        if (marcadorSeleccionado) {
            mapa.removeLayer(marcadorSeleccionado);
        }
        
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;
        
        marcadorSeleccionado = L.marker([lat, lng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(mapa);
        
        // Guardar ubicación seleccionada
        window.ubicacionSeleccionada = {
            latitud: lat,
            longitud: lng,
            nombreLugar: `Ubicación (${lat.toFixed(4)}, ${lng.toFixed(4)})`
        };
        
        console.log('Ubicación seleccionada:', window.ubicacionSeleccionada);
    });
    <?php endif; ?>

    // Guardar referencias globales
    window.mapaInstancias = window.mapaInstancias || {};
    window.mapaInstancias['<?php echo e($id); ?>'] = mapa;

    // Agregar event listener al botón de geolocalización
    const botonGeo = document.querySelector(`[data-mapa-id="<?php echo e($id); ?>"]`);
    if (botonGeo) {
        botonGeo.addEventListener('click', function() {
            obtenerGeolocation('<?php echo e($id); ?>');
        });
    }

    // Agregar event listener al botón de búsqueda
    const botonBuscar = document.querySelector(`[class*="buscar-ubicacion-btn"][data-mapa-id="<?php echo e($id); ?>"]`);
    if (botonBuscar) {
        botonBuscar.addEventListener('click', function() {
            buscarUbicaciones('<?php echo e($id); ?>');
        });
    }
});

// Función para cargar ubicaciones
function cargarUbicacionesEnMapa(mapa, mapaId) {
    // Cargar ubicaciones
    fetch('<?php echo e(route("api.mapa.ubicaciones")); ?>')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                data.data.forEach(ubicacion => {
                    let iconColor = ubicacion.es_publica ? 'blue' : 'red';
                    let iconUrl = `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${iconColor}.png`;
                    
                    const marcador = L.marker(
                        [ubicacion.latitud, ubicacion.longitud],
                        {
                            icon: L.icon({
                                iconUrl: iconUrl,
                                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            })
                        }
                    ).addTo(mapa);

                    let popup = `
                        <div class="p-3">
                            <h4 class="font-bold text-sm">${ubicacion.nombre_lugar}</h4>
                            <p class="text-xs text-gray-600 mt-1">${ubicacion.descripcion || 'Sin descripción'}</p>
                            <p class="text-xs font-semibold mt-1">
                                <span class="inline-block px-2 py-1 rounded ${ubicacion.es_publica ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800'}">
                                    ${ubicacion.es_publica ? 'Pública' : 'Privada'}
                                </span>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Usuario: ${ubicacion.usuario_nombre}</p>
                            ${ubicacion.adopciones.length > 0 ? `
                                <p class="text-xs font-semibold mt-2">Plantas:</p>
                                <ul class="text-xs mt-1">
                                    ${ubicacion.adopciones.map(a => `<li>🌱 ${a.planta_nombre} (${a.fecha_adopcion})</li>`).join('')}
                                </ul>
                            ` : ''}
                        </div>
                    `;

                    marcador.bindPopup(popup);
                });
            }
        })
        .catch(error => console.error('Error cargando ubicaciones:', error));
}

// Obtener geolocalización del usuario
function obtenerGeolocation(mapaId) {
    if (!navigator.geolocation) {
        alert('Geolocalización no soportada en tu navegador');
        return;
    }

    if (!window.mapaInstancias || !window.mapaInstancias[mapaId]) {
        alert('Error: Mapa no inicializado');
        return;
    }

    const boton = document.querySelector(`[data-mapa-id="${mapaId}"]`);
    const textoOriginal = boton.textContent;
    boton.disabled = true;
    boton.textContent = '⏳ Obteniendo ubicación...';

    navigator.geolocation.getCurrentPosition(
        position => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            const mapa = window.mapaInstancias[mapaId];

            // Centrar mapa en la ubicación obtenida
            mapa.setView([lat, lng], 15);

            // SIEMPRE crear el marcador dorado
            const marcador = L.marker([lat, lng], {
                icon: L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                })
            }).addTo(mapa);

            // SIEMPRE guardar ubicación en window
            window.ubicacionSeleccionada = {
                latitud: lat,
                longitud: lng,
                marcador: marcador,
                nombreLugar: 'Mi ubicación actual'
            };

            console.log('✅ Ubicación obtenida:', window.ubicacionSeleccionada);

            boton.disabled = false;
            boton.textContent = textoOriginal;
        },
        error => {
            console.error('Error de geolocalización:', error);
            let mensaje = 'No se pudo obtener tu ubicación: ';
            
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    mensaje += 'Permiso denegado. Habilita la geolocalización en tu navegador.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    mensaje += 'Información de ubicación no disponible.';
                    break;
                case error.TIMEOUT:
                    mensaje += 'La solicitud tardó demasiado.';
                    break;
                default:
                    mensaje += error.message;
            }
            
            alert(mensaje);
            boton.disabled = false;
            boton.textContent = textoOriginal;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

// Buscar ubicaciones cercanas
function buscarUbicaciones(mapaId) {
    const inputBusqueda = document.getElementById('busqueda-ubicacion-' + mapaId);
    const busqueda = inputBusqueda.value.trim();
    const mapa = window.mapaInstancias[mapaId];

    if (!busqueda) {
        alert('Ingresa un término de búsqueda');
        return;
    }

    if (!mapa) {
        alert('Error: Mapa no inicializado');
        return;
    }

    // Usar Nominatim (OpenStreetMap) para buscar
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(busqueda)}&viewbox=-97.5,25,-96.8,26&bounded=1`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                alert('No se encontraron resultados para: ' + busqueda);
                return;
            }

            const resultado = data[0];
            console.log('Resultado de búsqueda:', resultado);
            mapa.setView([parseFloat(resultado.lat), parseFloat(resultado.lon)], 14);
        })
        .catch(error => {
            console.error('Error en búsqueda:', error);
            alert('Error al buscar ubicación');
        });
}

function cerrarInfoMarcador(mapaId) {
    document.getElementById('info-marcador-' + mapaId).classList.add('hidden');
}
</script>
<?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/components/mapa-interactivo.blade.php ENDPATH**/ ?>