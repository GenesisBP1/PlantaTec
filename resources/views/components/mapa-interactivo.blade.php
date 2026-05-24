@props([
    'id' => 'mapa-interactive',
    'canSelectLocation' => false,
    'onLocationSelected' => null,
    'showToolbar' => true,
    'height' => '500px'
])

<style>
    #{{ $id }}-container {
        height: {{ $height }};
    }
    /* Asegura que el canvas del mapa llene el contenedor padre */
    #{{ $id }} {
        height: 100%;
        width: 100%;
    }
</style>

<div id="{{ $id }}-container" class="pt-map-component">
    <div id="{{ $id }}" class="pt-map-canvas"></div>
</div>

@if($showToolbar)
    <div class="pt-map-toolbar">
        <div class="pt-map-toolbar-grid">
            <button 
                type="button"
                class="pt-map-btn blue obtener-geolocation-btn"
                data-mapa-id="{{ $id }}">
                📍 Mi ubicación
            </button>

            <div class="pt-map-search">
                <input 
                    type="text"
                    id="busqueda-ubicacion-{{ $id }}"
                    placeholder="Buscar ubicaciones...">

                <button 
                    type="button"
                    class="pt-map-btn green buscar-ubicacion-btn"
                    data-mapa-id="{{ $id }}">
                    Buscar
                </button>
            </div>
        </div>

        @if($canSelectLocation)
            <div class="pt-map-tip">
                💡 Haz clic en el mapa para seleccionar tu ubicación o usa la geolocalización automática.
            </div>
        @endif
    </div>
@endif

<div id="info-marcador-{{ $id }}" class="hidden pt-map-info">
    <p><strong>Ubicación:</strong> <span id="info-nombre"></span></p>
    <p><strong>Descripción:</strong> <span id="info-descripcion"></span></p>
    <p><strong>Tipo:</strong> <span id="info-tipo"></span></p>
    <p><strong>Usuario:</strong> <span id="info-usuario"></span></p>
    <p><strong>Plantas:</strong> <span id="info-plantas"></span></p>
    <p><strong>Coordenadas:</strong> <span id="info-coords"></span></p>

    <button type="button" onclick="cerrarInfoMarcador('{{ $id }}')" class="pt-small-btn green">
        Cerrar
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof L === 'undefined') {
        console.error('Leaflet no está cargado');
        return;
    }

    const mapa = L.map('{{ $id }}').setView([25.5095, -97.1559], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(mapa);

    let marcadorSeleccionado = null;
    const mapaId = '{{ $id }}';

    cargarUbicacionesEnMapa(mapa, mapaId);

    setTimeout(function() {
        cargarZonasRecomendadas(mapa);
    }, 500);

    window.cargarZonasRecomendadas = function(mapaRef) {
        const mapToUse = mapaRef || (window.mapaInstancias ? window.mapaInstancias[mapaId] : null);

        if (!mapToUse) {
            console.error('No hay mapa disponible para cargar zonas');
            return;
        }

        fetch('{{ route("api.mapa.zonas-recomendadas") }}')
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

    @if($canSelectLocation)
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
    @endif

    window.mapaInstancias = window.mapaInstancias || {};
    window.mapaInstancias['{{ $id }}'] = mapa;

    const botonGeo = document.querySelector(`.obtener-geolocation-btn[data-mapa-id="{{ $id }}"]`);
    if (botonGeo) {
        botonGeo.addEventListener('click', function() {
            obtenerGeolocation('{{ $id }}');
        });
    }

    const botonBuscar = document.querySelector(`.buscar-ubicacion-btn[data-mapa-id="{{ $id }}"]`);
    if (botonBuscar) {
        botonBuscar.addEventListener('click', function() {
            buscarUbicaciones('{{ $id }}');
        });
    }
});

function cargarUbicacionesEnMapa(mapa, mapaId) {
    fetch('{{ route("api.mapa.ubicaciones") }}')
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
                        <div class="pt-map-popup">
                            <h4>${ubicacion.nombre_lugar}</h4>
                            <p>${ubicacion.descripcion || 'Sin descripción'}</p>
                            <span class="pt-popup-badge ${ubicacion.es_publica ? 'blue' : 'red'}">
                                ${ubicacion.es_publica ? 'Pública' : 'Privada'}
                            </span>
                            <p>Usuario: ${ubicacion.usuario_nombre}</p>
                            ${ubicacion.adopciones.length > 0 ? `
                                <strong>Plantas:</strong>
                                <ul>
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
</script>