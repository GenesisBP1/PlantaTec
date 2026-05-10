<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🌱 Adoptar Planta
        </h2>
    </x-slot>

    <style>
        /* Estilos mejorados para la página de adopción */
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;600;700;800&display=swap');

        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --blanco: #ffffff;
            --sombra-suave: 0 12px 28px rgba(0, 32, 0, 0.08);
            --border-radius-card: 24px;
            --transition: all 0.3s ease;
        }

        .adopcion-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 1rem;
        }

        .planta-card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            overflow: hidden;
            box-shadow: var(--sombra-suave);
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
        }

        .planta-imagen {
            flex: 1;
            min-width: 250px;
            background: var(--verde-claro);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .planta-imagen img {
            max-width: 100%;
            max-height: 280px;
            object-fit: contain;
            border-radius: 20px;
        }

        .planta-info {
            flex: 2;
            padding: 2rem;
        }

        .planta-info h3 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--verde-profundo);
            margin-bottom: 0.5rem;
        }

        .planta-info .especie {
            font-size: 1.1rem;
            color: var(--verde-medio);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .planta-info .zona-badge {
            background: var(--verde-claro);
            display: inline-block;
            padding: 0.3rem 1.2rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--verde-medio);
            margin-bottom: 1rem;
        }

        .planta-info .descripcion {
            color: #4a5b52;
            line-height: 1.6;
            margin-top: 1rem;
        }

        /* Formulario */
        .formulario-card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            box-shadow: var(--sombra-suave);
            padding: 2rem;
        }

        .formulario-card h4 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--verde-profundo);
            margin-bottom: 1rem;
            border-left: 5px solid var(--verde-medio);
            padding-left: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #2c5e44;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 16px;
            border: 1px solid #cde0d4;
            background: #fefef9;
            transition: var(--transition);
            font-family: 'Inter', sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--verde-medio);
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
        }

        .btn-adoptar {
            background: linear-gradient(105deg, var(--verde-medio), #3e8a5a);
            color: white;
            border: none;
            padding: 0.9rem 1.8rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-adoptar:hover {
            transform: scale(0.98);
            box-shadow: 0 10px 20px rgba(43, 120, 64, 0.3);
        }

        @media (max-width: 768px) {
            .planta-card {
                flex-direction: column;
            }
            .planta-imagen, .planta-info {
                width: 100%;
            }
        }
    </style>

    <div class="py-8">
        <div class="adopcion-container">
            <!-- Tarjeta de información de la planta -->
            <div class="planta-card">
                <div class="planta-imagen">
                    <img src="{{ $planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&fit=crop' }}" 
                         alt="{{ $planta->nombre }}">
                </div>
                <div class="planta-info">
                    <h3>{{ $planta->nombre }}</h3>
                    <div class="especie">{{ $planta->especie }}</div>
                    <span class="zona-badge">
                        <i class="fas fa-map-marker-alt"></i> {{ $planta->tipo_zona ?? 'Zona no especificada' }}
                    </span>
                    <p><strong>Estado en catálogo:</strong> {{ ucfirst($planta->estado) }}</p>
                    <div class="descripcion">
                        <strong>📝 Descripción:</strong>
                        <p>{{ $planta->descripcion ?? 'Sin descripción disponible.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Formulario de adopción con ubicación opcional -->
            <div class="formulario-card">
                <h4><i class="fas fa-map-pin"></i> Datos de ubicación (opcional)</h4>
                <form action="{{ route('catalogo.plantas.adoptar', $planta) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Tipo de ubicación</label>
                        <select name="tipo">
                            <option value="">Selecciona</option>
                            <option value="publico">Público (zona recomendada)</option>
                            <option value="privado">Privado (jardín, maceta, etc.)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nombre del lugar</label>
                        <input type="text" name="nombre_lugar" placeholder="Ej: Parque Olímpico, Mi jardín...">
                    </div>

                    <div class="form-group">
                        <label>Descripción (opcional)</label>
                        <textarea name="descripcion" rows="3" placeholder="Detalles adicionales..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Latitud</label>
                        <input type="text" name="latitud" placeholder="Ej: 25.8792">
                    </div>

                    <div class="form-group">
                        <label>Longitud</label>
                        <input type="text" name="longitud" placeholder="Ej: -97.5044">
                    </div>

                    <button type="submit" class="btn-adoptar">
                        <i class="fas fa-hand-holding-heart"></i> Adoptar planta
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @endpush
</x-app-layout>