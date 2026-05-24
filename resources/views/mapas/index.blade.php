<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Mapa interactivo</p>
                <h2 class="pt-header-title">🗺️ Ubicaciones de plantas en Matamoros</h2>
                <p class="pt-header-subtitle">Explora y descubre dónde se encuentran las plantas adoptadas</p>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <!-- Leyenda de ubicaciones -->
            <div class="pt-legend-grid">
                <div class="pt-legend-card pt-legend-public">
                    <div class="pt-legend-icon">
                        <svg class="pt-legend-svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 8a1 1 0 11-2 0 1 1 0 012 0zm4 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="pt-legend-title">Ubicaciones públicas</h3>
                        <p class="pt-legend-text">Los marcadores <span class="pt-marker pt-marker-public"></span> son ubicaciones públicas visibles para todos</p>
                    </div>
                </div>

                <div class="pt-legend-card pt-legend-private">
                    <div class="pt-legend-icon">
                        <svg class="pt-legend-svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="pt-legend-title">Ubicaciones privadas</h3>
                        <p class="pt-legend-text">Los marcadores <span class="pt-marker pt-marker-private"></span> son solo visibles para ti y los administradores</p>
                    </div>
                </div>
            </div>

            <!-- Mapa -->
            <div class="pt-map-container">
                <x-mapa-interactivo 
                    id="mapa-principal"
                    :canSelectLocation="false"
                    showToolbar="true"
                    height="600px"
                />
            </div>

            <!-- Estadísticas -->
            <div class="pt-stats-grid">
                <div class="pt-stat-card">
                    <div class="pt-stat-icon pt-stat-icon-public">
                        <svg class="pt-stat-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19C3.592 15.327 1 10.895 1 7c0-3.866 2.686-7 6-7s6 3.134 6 7c0 3.895-2.592 8.327-8 12zm12-7c0-3.866-2.686-7-6-7s-6 3.134-6 7c0 3.895 2.592 8.327 8 12c5.408-3.673 8-8.105 8-12z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="pt-stat-label">Ubicaciones públicas</p>
                        <p class="pt-stat-value" id="stats-publicas">-</p>
                    </div>
                </div>

                <div class="pt-stat-card">
                    <div class="pt-stat-icon pt-stat-icon-private">
                        <svg class="pt-stat-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="pt-stat-label">Ubicaciones privadas</p>
                        <p class="pt-stat-value" id="stats-privadas">-</p>
                    </div>
                </div>

                <div class="pt-stat-card">
                    <div class="pt-stat-icon pt-stat-icon-total">
                        <svg class="pt-stat-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c7.2 0 9 1.8 9 9s-1.8 9-9 9-9-1.8-9-9 1.8-9 9-9z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="pt-stat-label">Plantas totales</p>
                        <p class="pt-stat-value" id="stats-plantas">-</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* ============================================
           StarClass - Mapa Interactivo (Morado / Fucsia)
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
            --public: #3B82F6;
            --private: #EF4444;
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
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 600;
            opacity: 0.8;
            margin-bottom: 0.25rem;
        }

        .pt-header-title {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0;
        }

        .pt-header-subtitle {
            font-size: 0.875rem;
            opacity: 0.85;
            margin-top: 0.25rem;
        }

        /* Grid de leyenda */
        .pt-legend-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .pt-legend-card {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 1rem;
            border-radius: 1rem;
            background-color: var(--card-bg);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .pt-legend-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .pt-legend-public {
            border-left: 4px solid var(--public);
        }

        .pt-legend-private {
            border-left: 4px solid var(--private);
        }

        .pt-legend-icon {
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .pt-legend-public .pt-legend-icon {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--public);
        }

        .pt-legend-private .pt-legend-icon {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--private);
        }

        .pt-legend-svg {
            width: 1.125rem;
            height: 1.125rem;
        }

        .pt-legend-title {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 0.25rem 0;
        }

        .pt-legend-text {
            font-size: 0.75rem;
            color: var(--text-gray);
            margin: 0;
        }

        .pt-marker {
            display: inline-block;
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 9999px;
            vertical-align: middle;
            margin: 0 0.125rem;
        }

        .pt-marker-public {
            background-color: var(--public);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .pt-marker-private {
            background-color: var(--private);
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
        }

        /* Contenedor del mapa */
        .pt-map-container {
            margin-top: 1rem;
            margin-bottom: 2rem;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
        }

        /* Grid de estadísticas */
        .pt-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .pt-stat-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.2s ease;
        }

        .pt-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.08);
            border-color: var(--primary-light);
        }

        .pt-stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .pt-stat-icon-public {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--public);
        }

        .pt-stat-icon-private {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--private);
        }

        .pt-stat-icon-total {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .pt-stat-svg {
            width: 1.5rem;
            height: 1.5rem;
        }

        .pt-stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            color: var(--text-gray);
            margin: 0 0 0.25rem 0;
        }

        .pt-stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
            margin: 0;
            line-height: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pt-legend-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .pt-stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .pt-header-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('{{ route("api.mapa.ubicaciones") }}')
                .then(response => response.json())
                .then(data => {
                    let publicasCount = 0;
                    let privadasCount = 0;
                    let plantasCount = 0;

                    data.data.forEach(ubicacion => {
                        if (ubicacion.es_publica) {
                            publicasCount++;
                        } else {
                            privadasCount++;
                        }
                        plantasCount += ubicacion.adopciones.length;
                    });

                    document.getElementById('stats-publicas').textContent = publicasCount;
                    document.getElementById('stats-privadas').textContent = privadasCount;
                    document.getElementById('stats-plantas').textContent = plantasCount;
                })
                .catch(error => console.error('Error cargando estadísticas:', error));
        });
    </script>
</x-app-layout>