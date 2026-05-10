<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🌱 Adoptar Planta
        </h2>
    </x-slot>

    <style>
        /* Tus estilos (los mismos que ya tienes, no los repito para ahorrar espacio) */
        .adopcion-container { max-width: 1100px; margin: 0 auto; padding: 1rem; }
        .planta-card { background: white; border-radius: 24px; box-shadow: 0 12px 28px rgba(0,32,0,0.08); margin-bottom: 2rem; display: flex; flex-wrap: wrap; }
        .planta-imagen { flex:1; min-width:250px; background:#e2f0e6; display:flex; align-items:center; justify-content:center; padding:1.5rem; }
        .planta-imagen img { max-width:100%; max-height:280px; object-fit:contain; border-radius:20px; }
        .planta-info { flex:2; padding:2rem; }
        .formulario-card { background:white; border-radius:24px; box-shadow:0 12px 28px rgba(0,32,0,0.08); padding:2rem; }
        .form-group { margin-bottom:1.5rem; }
        .form-group label { display:block; font-weight:600; margin-bottom:0.5rem; color:#2c5e44; }
        .form-group input, .form-group select, .form-group textarea { width:100%; padding:0.8rem 1rem; border-radius:16px; border:1px solid #cde0d4; background:#fefef9; }
        .btn-adoptar { background:linear-gradient(105deg,#2b7840,#3e8a5a); color:white; border:none; padding:0.9rem 1.8rem; border-radius:60px; font-weight:700; cursor:pointer; }
        @media (max-width:768px){ .planta-card { flex-direction:column; } }
    </style>

    <div class="py-8">
        <div class="adopcion-container">
            <div class="planta-card">
                <div class="planta-imagen">
                    <img src="{{ $planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&fit=crop' }}" alt="{{ $planta->nombre }}">
                </div>
                <div class="planta-info">
                    <h3>{{ $planta->nombre }}</h3>
                    <div class="especie">{{ $planta->especie }}</div>
                    <span class="zona-badge">{{ $planta->tipo_zona ?? 'Zona no especificada' }}</span>
                    <p><strong>Estado:</strong> {{ ucfirst($planta->estado) }}</p>
                    <div class="descripcion">{{ $planta->descripcion ?? 'Sin descripción.' }}</div>
                </div>
            </div>

            <div class="formulario-card">
                <h4>Datos de ubicación (opcional)</h4>
                <form action="{{ route('catalogo.plantas.adoptar', $planta) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Tipo de ubicación</label>
                        <select name="tipo" id="tipo_ubicacion">
                            <option value="">Selecciona (opcional)</option>
                            <option value="publico">Público (zona recomendada)</option>
                            <option value="privado">Privado (jardín, maceta, etc.)</option>
                        </select>
                    </div>

                    <div id="contenedor_nombre" class="form-group"></div>

                    <div class="form-group">
                        <label>Descripción (opcional)</label>
                        <textarea name="descripcion" rows="2" placeholder="Detalles adicionales..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Latitud</label>
                        <input type="text" name="latitud" id="latitud" placeholder="Ej: 25.8792">
                    </div>
                    <div class="form-group">
                        <label>Longitud</label>
                        <input type="text" name="longitud" id="longitud" placeholder="Ej: -97.5044">
                    </div>

                    <button type="submit" class="btn-adoptar">Adoptar planta</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Datos de zonas desde el controlador
                const zonas = @json($zonasRecomendadas);
                console.log('Zonas recibidas:', zonas);

                const tipoSelect = document.getElementById('tipo_ubicacion');
                const contenedor = document.getElementById('contenedor_nombre');
                const latInput = document.getElementById('latitud');
                const lngInput = document.getElementById('longitud');

                function actualizarCampo() {
                    const tipo = tipoSelect.value;
                    
                    if (tipo === 'publico') {
                        let html = '<label>Nombre del lugar (zona pública) <span style="color:red;">*</span></label>';
                        html += '<select name="nombre_lugar" id="select_publico" required>';
                        html += '<option value="">Selecciona una zona</option>';
                        zonas.forEach(z => {
                            html += `<option value="${z.nombre_lugar}" data-lat="${z.latitud || ''}" data-lng="${z.longitud || ''}" data-desc="${z.descripcion || ''}">${z.nombre_lugar}</option>`;
                        });
                        html += '</select>';
                        contenedor.innerHTML = html;

                        const select = document.getElementById('select_publico');
                        select.addEventListener('change', function() {
                            const opt = this.options[this.selectedIndex];
                            latInput.value = opt.getAttribute('data-lat') || '';
                            lngInput.value = opt.getAttribute('data-lng') || '';
                        });
                        
                        // Campos de solo lectura para públicos
                        latInput.readOnly = true;
                        lngInput.readOnly = true;
                        latInput.style.backgroundColor = '#f0f0f0';
                        lngInput.style.backgroundColor = '#f0f0f0';
                        latInput.style.cursor = 'not-allowed';
                        lngInput.style.cursor = 'not-allowed';
                        
                        if (select.value) select.dispatchEvent(new Event('change'));
                    } 
                    else if (tipo === 'privado') {
                        contenedor.innerHTML = '<label>Nombre del lugar (privado) <span style="color:red;">*</span></label><input type="text" name="nombre_lugar" id="input_privado" placeholder="Ej: Mi jardín, Terraza..." required>';
                        
                        // Campos editables para privados
                        latInput.readOnly = false;
                        lngInput.readOnly = false;
                        latInput.style.backgroundColor = '#fefef9';
                        lngInput.style.backgroundColor = '#fefef9';
                        latInput.style.cursor = 'text';
                        lngInput.style.cursor = 'text';
                        latInput.value = '';
                        lngInput.value = '';
                    }
                    else {
                        // Sin tipo seleccionado - opcional
                        contenedor.innerHTML = '<label>Nombre del lugar</label><input type="text" name="nombre_lugar" placeholder="Opcional">';
                        
                        // Campos editables
                        latInput.readOnly = false;
                        lngInput.readOnly = false;
                        latInput.style.backgroundColor = '#fefef9';
                        lngInput.style.backgroundColor = '#fefef9';
                        latInput.style.cursor = 'text';
                        lngInput.style.cursor = 'text';
                        latInput.value = '';
                        lngInput.value = '';
                    }
                }

                tipoSelect.addEventListener('change', actualizarCampo);
                actualizarCampo(); // ejecutar al inicio
            });
        </script>
    @endpush
</x-app-layout>