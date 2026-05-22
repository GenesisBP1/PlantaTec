<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Ubicaciones</p>
                <h2 class="pt-header-title">Detalle de ubicación</h2>
            </div>
        </div>
    </x-slot>

   <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;600;700;800&display=swap');

        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --verde-muy-claro: #f4fbf2;
            --gris-verde: #6f8f7a;
            --blanco: #ffffff;
            --sombra-suave: 0 12px 28px rgba(0, 32, 0, 0.08);
            --sombra-elevada: 0 20px 35px rgba(0, 0, 0, 0.12);
            --border-radius-card: 36px;
            --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .adopciones-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 1rem 2rem;
        }

        .titulo-principal {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(125deg, #1c593f, var(--verde-medio));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .descripcion-pagina {
            font-size: 1.15rem;
            color: var(--gris-verde);
            margin-bottom: 2rem;
            border-left: 5px solid var(--verde-suave);
            padding-left: 1.2rem;
        }

        .plantas-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            margin: 2rem 0 3rem;
        }

        .planta-card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            padding: 1.8rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2rem;
            box-shadow: var(--sombra-suave);
            transition: var(--transition);
            border: 1px solid rgba(100, 140, 110, 0.2);
            position: relative;
        }

        .planta-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--sombra-elevada);
        }

        .planta-img {
            width: 180px;
            height: 180px;
            border-radius: 32px;
            object-fit: cover;
            box-shadow: 0 12px 22px rgba(0, 0, 0, 0.12);
            border: 3px solid white;
            outline: 1px solid #cde0d4;
            flex-shrink: 0;
            cursor: pointer;
            transition: var(--transition);
        }

        .planta-img:hover {
            transform: scale(1.02);
        }

        .sin-imagen {
            width: 180px;
            height: 180px;
            border-radius: 32px;
            background: var(--verde-muy-claro);
            color: var(--verde-profundo);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-weight: 800;
            border: 2px dashed var(--verde-suave);
            padding: 1rem;
        }

        .info-planta {
            flex: 2;
            min-width: 250px;
        }

        .info-planta h3 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .info-planta h3 a {
            text-decoration: none;
            color: var(--verde-profundo);
            transition: color 0.2s;
        }

        .info-planta h3 a:hover {
            color: var(--verde-medio);
            text-decoration: underline;
        }

        .especie {
            color: var(--verde-medio);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .cuidados-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin: 1rem 0;
        }

        .cuidado-badge {
            background: var(--verde-claro);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--verde-profundo);
        }

        .ultima-evidencia {
            margin-top: 1rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8faf6;
            padding: 0.5rem 1rem;
            border-radius: 60px;
            width: fit-content;
        }

        .ultima-evidencia img {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            object-fit: cover;
        }

        .acciones {
            text-align: center;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .btn-evidencia,
        .btn-problema,
        .btn-detalle {
            background: var(--blanco);
            border: 1.5px solid var(--verde-medio);
            color: var(--verde-medio);
            padding: 0.7rem 1.2rem;
            border-radius: 60px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
        }

        .btn-evidencia:hover,
        .btn-detalle:hover {
            background: var(--verde-medio);
            color: white;
        }

        .btn-problema {
            border-color: #dc2626;
            color: #dc2626;
        }

        .btn-problema:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--blanco);
            margin: auto;
            border-radius: 36px;
            width: 90%;
            max-width: 550px;
            box-shadow: var(--sombra-elevada);
            animation: fadeSlideUp 0.3s ease;
        }

        .modal-header {
            background: var(--verde-claro);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 36px 36px 0 0;
        }

        .modal-header h4 {
            margin: 0;
            font-weight: 800;
            color: var(--verde-profundo);
        }

        .close-modal {
            font-size: 1.8rem;
            cursor: pointer;
            color: var(--verde-medio);
        }

        .modal-body {
            padding: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.7rem;
            border-radius: 20px;
            border: 1px solid #cde0d4;
        }

        .btn-submit {
            background: var(--verde-medio);
            color: white;
            border: none;
            padding: 0.7rem;
            border-radius: 60px;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 850px) {
            .planta-card {
                flex-direction: column;
                text-align: center;
            }

            .info-planta .cuidados-list {
                justify-content: center;
            }

            .ultima-evidencia {
                margin: 0 auto;
            }

            .acciones {
                width: 100%;
            }
        }
    </style>


    <div class="pt-page">
        <div class="pt-container pt-form-container">
            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Registro guardado</p>
                    <h3 class="pt-form-title">{{ $ubicacion->nombre_lugar }}</h3>
                    <p class="pt-form-subtitle">Información completa de la ubicación registrada.</p>
                </div>

                <div class="pt-detail-grid">
                    <div class="pt-detail-item">
                        <strong>Tipo</strong>
                        <span>{{ ucfirst($ubicacion->tipo) }}</span>
                    </div>
                    <div class="pt-detail-item">
                        <strong>Latitud</strong>
                        <span>{{ $ubicacion->latitud ?? 'No especificada' }}</span>
                    </div>
                    <div class="pt-detail-item">
                        <strong>Longitud</strong>
                        <span>{{ $ubicacion->longitud ?? 'No especificada' }}</span>
                    </div>
                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span>{{ $ubicacion->descripcion ?? 'Sin descripción.' }}</span>
                    </div>
                </div>

                <div class="pt-form-actions">
                    <a href="{{ route('ubicaciones.edit', $ubicacion) }}" class="pt-btn pt-btn-yellow">Editar</a>
                    <a href="{{ route('ubicaciones.index') }}" class="pt-btn pt-btn-dark">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>