<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Catálogo</p>
                <h2 class="pt-header-title">Catálogo de Plantas</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <p class="pt-page-description">
                Explora y adopta plantas según tu entorno.
            </p>

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
                    <option value="Clima humedo">Clima humedo</option>
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