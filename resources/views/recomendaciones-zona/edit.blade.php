<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Zonas públicas</p>
                <h2 class="pt-header-title">Editar zona pública</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title">{{ $zona->nombre_lugar }}</h3>
                    <p class="pt-form-subtitle">
                        Actualiza la información de esta zona recomendada.
                    </p>
                </div>

                @if($errors->any())
                    <div class="pt-alert-error">
                        <p><strong>Revisa los campos del formulario:</strong></p>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('recomendaciones-zona.update', $zona) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Nombre del lugar *</label>
                            <input type="text" name="nombre_lugar" value="{{ old('nombre_lugar', $zona->nombre_lugar) }}" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Tipo de zona</label>
                            <input type="text" name="tipo_zona" value="{{ old('tipo_zona', $zona->tipo_zona) }}">
                        </div>

                        <div class="pt-form-group full">
                            <label>Indicaciones</label>
                            <textarea name="indicaciones" rows="3">{{ old('indicaciones', $zona->indicaciones) }}</textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Latitud</label>
                            <input type="text" name="latitud" value="{{ old('latitud', $zona->latitud) }}">
                        </div>

                        <div class="pt-form-group">
                            <label>Longitud</label>
                            <input type="text" name="longitud" value="{{ old('longitud', $zona->longitud) }}">
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción completa</label>
                            <textarea name="descripcion" rows="4">{{ old('descripcion', $zona->descripcion) }}</textarea>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="{{ route('recomendaciones-zona.index') }}" class="pt-btn pt-btn-dark">Cancelar</a>
                        <button type="submit" class="pt-btn pt-btn-yellow">Actualizar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <style>
        /* ============================================
           StarClass - Editar Zona Pública (Morado / Fucsia)
           Coherente con la app móvil
           ============================================ */

        :root {
            --primary: #7C3AED;
            --primary-dark: #6D28D9;
            --primary-light: #A78BFA;
            --secondary: #D946EF;
            --background: #F8F4FF;
            --card-bg: #FFFFFF;
            --text-dark: #1E1B2E;
            --text-gray: #6B7280;
            --border: #E9E8F0;
            --success: #10B981;
            --warning: #F59E0B;
            --error: #EF4444;
        }

        /* Layout general */
        .pt-page {
            background-color: var(--background);
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .pt-container {
            max-width: 80rem;
            margin-left: auto;
            margin-right: auto;
        }

        .pt-form-container {
            max-width: 48rem;
            margin-left: auto;
            margin-right: auto;
        }

        /* Header */
        .pt-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary), var(--secondary));
            padding: 1.5rem 2rem;
            border-bottom-left-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .pt-header-label {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            opacity: 0.8;
            margin-bottom: 0.25rem;
        }

        .pt-header-title {
            font-size: 1.875rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0;
        }

        /* Tarjeta de formulario */
        .pt-form-card {
            background-color: var(--card-bg);
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            border: 1px solid var(--border);
            transition: box-shadow 0.3s ease;
        }

        .pt-form-card:hover {
            box-shadow: 0 20px 25px -12px rgba(124, 58, 237, 0.15);
        }

        /* Introducción */
        .pt-form-intro {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, rgba(167, 139, 250, 0.05), rgba(217, 70, 239, 0.05));
        }

        .pt-form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-top: 0.5rem;
            margin-bottom: 0.25rem;
        }

        .pt-form-subtitle {
            color: var(--text-gray);
            font-size: 0.875rem;
        }

        /* Alertas de error */
        .pt-alert-error {
            margin: 1rem 1.5rem 0 1.5rem;
            padding: 1rem;
            background-color: #FEE2E2;
            border-left: 4px solid var(--error);
            border-radius: 0.75rem;
            color: #991B1B;
        }

        .pt-alert-error p {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .pt-alert-error ul {
            margin: 0;
            padding-left: 1.5rem;
        }

        .pt-alert-error li {
            font-size: 0.875rem;
        }

        /* Grid del formulario */
        .pt-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
            padding: 1.5rem;
        }

        .pt-form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .pt-form-group.full {
            grid-column: span 2;
        }

        .pt-form-group label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: var(--primary);
        }

        .pt-form-group input,
        .pt-form-group textarea,
        .pt-form-group select {
            padding: 0.625rem 0.875rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border);
            background-color: #F9F7FF;
            font-size: 0.9rem;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .pt-form-group input:focus,
        .pt-form-group textarea:focus,
        .pt-form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        /* Botones */
        .pt-form-actions {
            padding: 1.5rem;
            background-color: #F9F7FF;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .pt-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            font-weight: 600;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-size: 0.875rem;
        }

        .pt-btn-yellow {
            background-color: var(--warning);
            color: white;
            box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2);
        }

        .pt-btn-yellow:hover {
            background-color: #D97706;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
        }

        .pt-btn-dark {
            background-color: var(--text-dark);
            color: white;
        }

        .pt-btn-dark:hover {
            background-color: #111827;
            transform: translateY(-1px);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .pt-header-title {
                font-size: 1.5rem;
            }
            .pt-form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .pt-form-group.full {
                grid-column: span 1;
            }
            .pt-form-actions {
                justify-content: stretch;
            }
            .pt-btn {
                flex: 1;
                text-align: center;
            }
        }
    </style>
</x-app-layout>