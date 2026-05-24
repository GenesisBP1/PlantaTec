<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Catálogo</p>
                <h2 class="pt-header-title">Plantas disponibles</h2>
                <p class="pt-header-subtitle">Explora y adopta plantas según tu entorno</p>
            </div>
        </div>
    </x-slot>

    <style>
        .pt-header-label {
            color: var(--verde-medio);
            font-weight: 600;
        }
        .pt-header-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--verde-profundo);
        }
        /* ========== ESTILOS ESPECÍFICOS DEL CATÁLOGO ========== */
        .pt-catalog-filters {
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(8px);
            padding: 0.85rem 1.25rem;
            border-radius: 999px;
            margin: 1.5rem 0 2rem;
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
            border: 1px solid rgba(75, 130, 90, 0.2);
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
        }
        .pt-page {
            padding: 1rem 0;
        }
        .pt-search-box {
            flex: 1;
            position: relative;
        }
        .pt-search-input,
        .pt-filter-select {
            width: 100%;
            padding: 0.75rem 1.1rem;
            border-radius: 999px;
            border: 1px solid #cde0d4;
            background: #ffffff;
            outline: none;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
        }
        .pt-filter-select {
            max-width: 220px;
        }
        .pt-search-input:focus,
        .pt-filter-select:focus {
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
        }
        .pt-suggestions {
            position: absolute;
            top: 110%;
            left: 0;
            right: 0;
            background: #ffffff;
            border-radius: 1.25rem;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.12);
            z-index: 100;
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid rgba(75, 130, 90, 0.2);
            display: none;
        }
        .pt-suggestions ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .pt-suggestions li {
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            border-bottom: 1px solid #e2ecd9;
        }
        .pt-suggestions li:hover {
            background: #e2f0e6;
        }
        .pt-suggestions img {
            width: 42px;
            height: 42px;
            border-radius: 0.8rem;
            object-fit: cover;
        }
        .pt-suggestions strong {
            display: block;
            color: #1e3a2f;
            font-size: 0.9rem;
        }
        .pt-suggestions span {
            color: #6f8f7a;
            font-size: 0.75rem;
        }
        .pt-catalog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        .pt-catalog-card {
            background: #ffffff;
            border-radius: 1.75rem;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
            border: 1px solid rgba(100, 140, 110, 0.2);
            transition: 0.25s ease;
        }
        .pt-catalog-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.12);
            border-color: rgba(75, 130, 90, 0.4);
        }
        .pt-catalog-card img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            border-bottom: 2px solid #e2f0e6;
            transition: 0.25s ease;
        }
        .pt-catalog-card:hover img {
            transform: scale(1.02);
        }
        .pt-catalog-card-body {
            padding: 1.2rem 1.2rem 1.5rem;
        }
        .pt-catalog-card-body h3 {
            font-size: 1.45rem;
            font-weight: 900;
            color: #1e3a2f;
            margin-bottom: 0.35rem;
        }
        .pt-catalog-zone {
            font-size: 0.75rem;
            font-weight: 800;
            background: #e2f0e6;
            color: #2b7840;
            display: inline-block;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            margin: 0.6rem 0;
        }
        .pt-catalog-card-body p {
            font-size: 0.9rem;
            color: #6f8f7a;
            margin-bottom: 1.2rem;
            line-height: 1.5;
        }
        .pt-adopt-btn {
            background: linear-gradient(105deg, #2b7840, #3e8a5a);
            color: #ffffff;
            padding: 0.75rem 1rem;
            border-radius: 999px;
            font-weight: 800;
            width: 100%;
            text-decoration: none;
            transition: 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pt-adopt-btn:hover {
            background: linear-gradient(105deg, #236a3b, #2b7840);
            transform: scale(0.98);
            box-shadow: 0 8px 18px rgba(43, 120, 64, 0.3);
        }
        .pt-catalog-empty {
            grid-column: 1 / -1;
        }
        @media (max-width: 950px) {
            .pt-catalog-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 650px) {
            .pt-catalog-filters {
                flex-direction: column;
                border-radius: 1.25rem;
            }
            .pt-filter-select {
                max-width: 100%;
            }
            .pt-catalog-grid {
                grid-template-columns: 1fr;
            }
            .pt-catalog-card img {
                height: 190px;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-catalog-filters">
                <div class="pt-search-box">
                    <input type="text"
                           id="search-input"
                           class="pt-search-input"
                           placeholder="Buscar por nombre o especie..."
                           autocomplete="off">

                    <div id="suggestions" class="pt-suggestions"></div>
                </div>

                <select id="zona-filter" class="pt-filter-select">
                    <option value="">Todas las zonas</option>
                    <option value="Interior">Interior</option>
                    <option value="Exterior">Exterior</option>
                    <option value="Clima seco">Clima seco</option>
                    <option value="Clima humedo">Clima húmedo</option>
                </select>
            </div>

            <div id="grid-plantas" class="pt-catalog-grid">
                @include('catalogo.partials.plantas_grid', ['plantas' => $plantas])
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        const searchInput = document.getElementById('search-input');
        const suggestionsDiv = document.getElementById('suggestions');
        const gridContainer = document.getElementById('grid-plantas');
        const zonaFilter = document.getElementById('zona-filter');

        let debounceTimer;

        function fetchSuggestions() {
            const query = searchInput.value.trim();

            if (query.length < 2) {
                suggestionsDiv.style.display = 'none';
                return;
            }

            fetch(`/catalogo-plantas/buscar?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.length) {
                        suggestionsDiv.style.display = 'none';
                        return;
                    }

                    let html = '<ul>';

                    data.forEach(planta => {
                        const imgSrc = planta.imagen || 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=40&h=40&fit=crop';

                        html += `
                            <li data-id="${planta.id}">
                                <img src="${imgSrc}" alt="${planta.nombre}">
                                <div>
                                    <strong>${planta.nombre}</strong>
                                    <span>${planta.especie}</span>
                                </div>
                            </li>
                        `;
                    });

                    html += '</ul>';

                    suggestionsDiv.innerHTML = html;
                    suggestionsDiv.style.display = 'block';

                    document.querySelectorAll('#suggestions li').forEach(li => {
                        li.addEventListener('click', () => {
                            const plantaId = li.getAttribute('data-id');
                            window.location.href = `/catalogo-plantas/${plantaId}`;
                        });
                    });
                })
                .catch(() => {
                    suggestionsDiv.style.display = 'none';
                });
        }

        function fetchGrid() {
            const term = searchInput.value.trim();
            const zona = zonaFilter.value;

            const url = `/catalogo-plantas?term=${encodeURIComponent(term)}&zona=${encodeURIComponent(zona)}`;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.text())
                .then(html => {
                    gridContainer.innerHTML = html;
                });
        }

        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(() => {
                fetchSuggestions();
                fetchGrid();
            }, 300);
        });

        zonaFilter.addEventListener('change', () => fetchGrid());

        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.style.display = 'none';
            }
        });
    </script>
    @endpush
</x-app-layout>