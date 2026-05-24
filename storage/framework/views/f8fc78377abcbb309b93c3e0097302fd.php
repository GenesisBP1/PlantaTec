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
        height: <?php echo e($height); ?>;
    }
    /* Asegura que el canvas del mapa llene el contenedor padre */
    #<?php echo e($id); ?> {
        height: 100%;
        width: 100%;
    }
</style>

<div id="<?php echo e($id); ?>-container" class="pt-map-component">
    <div id="<?php echo e($id); ?>" class="pt-map-canvas"></div>
</div>

<?php if($showToolbar): ?>
    <div class="pt-map-toolbar">
        <div class="pt-map-toolbar-grid">
            <button 
                type="button"
                class="pt-map-btn blue obtener-geolocation-btn"
                data-mapa-id="<?php echo e($id); ?>">
                📍 Mi ubicación
            </button>

            <div class="pt-map-search">
                <input 
                    type="text"
                    id="busqueda-ubicacion-<?php echo e($id); ?>"
                    placeholder="Buscar ubicaciones...">

                <button 
                    type="button"
                    class="pt-map-btn green buscar-ubicacion-btn"
                    data-mapa-id="<?php echo e($id); ?>">
                    Buscar
                </button>
            </div>
        </div>

        <?php if($canSelectLocation): ?>
            <div class="pt-map-tip">
                💡 Haz clic en el mapa para seleccionar tu ubicación o usa la geolocalización automática.
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<div id="info-marcador-<?php echo e($id); ?>" class="hidden pt-map-info">
    <p><strong>Ubicación:</strong> <span id="info-nombre-<?php echo e($id); ?>"></span></p>
    <p><strong>Descripción:</strong> <span id="info-descripcion-<?php echo e($id); ?>"></span></p>
    <p><strong>Tipo:</strong> <span id="info-tipo-<?php echo e($id); ?>"></span></p>
    <p><strong>Usuario:</strong> <span id="info-usuario-<?php echo e($id); ?>"></span></p>
    <p><strong>Plantas:</strong> <span id="info-plantas-<?php echo e($id); ?>"></span></p>
    <p><strong>Coordenadas:</strong> <span id="info-coords-<?php echo e($id); ?>"></span></p>

    <button type="button" onclick="cerrarInfoMarcador('<?php echo e($id); ?>')" class="pt-small-btn green">
        Cerrar
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof L === 'undefined') {
        console.error('Leaflet no está cargado');
        return;
    }

    const mapa = L.map('<?php echo e($id); ?>').setView([25.5095, -97.1559], 13);

    // Forzar recalculo de tamaño por si el contenedor cambia al renderizar
    setTimeout(function() {
        try { mapa.invalidateSize(); } catch (e) { /* ignore */ }
    }, 300);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(mapa);

    let marcadorSeleccionado = null;
    const mapaId = '<?php echo e($id); ?>';
    // Mantener lista de marcadores para poder limpiar/filtrar
    let marcadoresArray_<?php echo e($id); ?> = [];

    // Solo definir y usar URLs de API si las rutas existen
    <?php if(\Illuminate\Support\Facades\Route::has('api.mapa.ubicaciones')): ?>
        const urlUbicaciones = "<?php echo e(route('api.mapa.ubicaciones')); ?>";
    <?php endif; ?>

    <?php if(\Illuminate\Support\Facades\Route::has('api.mapa.zonas-recomendadas')): ?>
        const urlZonasRecomendadas = "<?php echo e(route('api.mapa.zonas-recomendadas')); ?>";
    <?php endif; ?>

    if (typeof urlUbicaciones !== 'undefined') {
        cargarUbicacionesEnMapa(mapa, mapaId);
    }

    if (typeof urlZonasRecomendadas !== 'undefined') {
        setTimeout(function() {
            cargarZonasRecomendadas(mapa);
        }, 500);
    }

    window.cargarZonasRecomendadas = function(mapaRef) {
        const mapToUse = mapaRef || (window.mapaInstancias ? window.mapaInstancias[mapaId] : null);

        if (!mapToUse) {
            console.error('No hay mapa disponible para cargar zonas');
            return;
        }

        if (typeof urlZonasRecomendadas === 'undefined') return Promise.resolve();

        return fetch(urlZonasRecomendadas)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data && data.data.length > 0) {
                    data.data.forEach(zona => {
                        const lat = parseFloat(zona.latitud);
                        const lng = parseFloat(zona.longitud);

                        if (isNaN(lat) || isNaN(lng)) {
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
                            <div class="pt-map-popup">
                                <h4>🌿 ${zona.nombre_lugar}</h4>
                                <p>${zona.descripcion || 'Sin descripción'}</p>
                                <span class="pt-popup-badge green">Zona Recomendada</span>
                                <p>Tipo: ${zona.tipo_zona || 'Sin clasificar'}</p>
                            </div>
                        `;

                        marcador.bindPopup(popup);
                    });
                }
            })
            .catch(error => console.error('Error cargando zonas recomendadas:', error));
    };

        // Exponer función para recargar ubicaciones filtrando por usuario
        window.recargarUbicacionesPorUsuario = function(usuarioId) {
            if (typeof urlUbicaciones === 'undefined') return;
            const separador = urlUbicaciones.indexOf('?') === -1 ? '?' : '&';
            const url = usuarioId ? (urlUbicaciones + separador + 'usuario_id=' + encodeURIComponent(usuarioId)) : urlUbicaciones;
            cargarUbicacionesEnMapa(mapa, mapaId, url);
        };

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

        window.ubicacionSeleccionada = {
            latitud: lat,
            longitud: lng,
            nombreLugar: `Ubicación (${lat.toFixed(4)}, ${lng.toFixed(4)})`
        };
    });
    <?php endif; ?>

    window.mapaInstancias = window.mapaInstancias || {};
    window.mapaInstancias['<?php echo e($id); ?>'] = mapa;

    const botonGeo = document.querySelector(`.obtener-geolocation-btn[data-mapa-id="<?php echo e($id); ?>"]`);
    if (botonGeo) {
        botonGeo.addEventListener('click', function() {
            obtenerGeolocation('<?php echo e($id); ?>');
        });
    }

    const botonBuscar = document.querySelector(`.buscar-ubicacion-btn[data-mapa-id="<?php echo e($id); ?>"]`);
    if (botonBuscar) {
        botonBuscar.addEventListener('click', function() {
            buscarUbicaciones('<?php echo e($id); ?>');
        });
    }
});

function cargarUbicacionesEnMapa(mapa, mapaId, urlOverride) {
    const fetchUrl = urlOverride || (typeof urlUbicaciones !== 'undefined' ? urlUbicaciones : null);
    if (!fetchUrl) return;

    // Limpiar marcadores previos
    try {
        marcadoresArray_<?php echo e($id); ?>.forEach(m => { if (m && mapa.hasLayer(m)) mapa.removeLayer(m); });
    } catch (e) { /* ignore */ }
    marcadoresArray_<?php echo e($id); ?> = [];

    fetch(fetchUrl)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                data.data.forEach(ubicacion => {
                    const lat = parseFloat(ubicacion.latitud);
                    const lng = parseFloat(ubicacion.longitud);

                    if (isNaN(lat) || isNaN(lng)) {
                        return;
                    }

                    const adopciones = ubicacion.adopciones || [];

                    let iconColor = ubicacion.es_publica ? 'blue' : 'red';
                    let iconUrl = `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${iconColor}.png`;

                    const marcador = L.marker(
                        [lat, lng],
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

                    marcadoresArray_<?php echo e($id); ?>.push(marcador);

                    let popup = `
                        <div class="pt-map-popup">
                            <h4>${ubicacion.nombre_lugar || 'Sin nombre'}</h4>
                            <p>${ubicacion.descripcion || 'Sin descripción'}</p>

                            <span class="pt-popup-badge ${ubicacion.es_publica ? 'blue' : 'red'}">
                                ${ubicacion.es_publica ? 'Pública' : 'Privada'}
                            </span>

                            <p>Usuario: ${ubicacion.usuario_nombre || 'Sin usuario'}</p>

                            ${adopciones.length > 0 ? `
                                <strong>Plantas:</strong>
                                <ul>
                                    ${adopciones.map(a => `<li>🌱 ${a.planta_nombre || 'Planta'} (${a.fecha_adopcion || 'Sin fecha'})</li>`).join('')}
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

function obtenerGeolocation(mapaId) {
    if (!navigator.geolocation) {
        alert('Geolocalización no soportada en tu navegador');
        return;
    }

    if (!window.mapaInstancias || !window.mapaInstancias[mapaId]) {
        alert('Error: Mapa no inicializado');
        return;
    }

    const boton = document.querySelector(`.obtener-geolocation-btn[data-mapa-id="${mapaId}"]`);
    const textoOriginal = boton.textContent;

    boton.disabled = true;
    boton.textContent = '⏳ Obteniendo ubicación...';

    navigator.geolocation.getCurrentPosition(
        position => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            const mapa = window.mapaInstancias[mapaId];

            mapa.setView([lat, lng], 15);

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

            window.ubicacionSeleccionada = {
                latitud: lat,
                longitud: lng,
                marcador: marcador,
                nombreLugar: 'Mi ubicación actual'
            };

            boton.disabled = false;
            boton.textContent = textoOriginal;
        },
        error => {
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

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(busqueda)}&viewbox=-97.5,25,-96.8,26&bounded=1`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                alert('No se encontraron resultados para: ' + busqueda);
                return;
            }

            const resultado = data[0];
            mapa.setView([parseFloat(resultado.lat), parseFloat(resultado.lon)], 14);
        })
        .catch(() => {
            alert('Error al buscar ubicación');
        });
}

function cerrarInfoMarcador(mapaId) {
    document.getElementById('info-marcador-' + mapaId).classList.add('hidden');
}
</script><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/components/mapa-interactivo.blade.php ENDPATH**/ ?>