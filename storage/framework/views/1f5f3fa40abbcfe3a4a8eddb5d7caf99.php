<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Catálogo</p>
                <h2 class="pt-header-title">Catálogo de Plantas</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

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
                <?php echo $__env->make('catalogo.partials.plantas_grid', ['plantas' => $plantas], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
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
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/catalogo/index.blade.php ENDPATH**/ ?>