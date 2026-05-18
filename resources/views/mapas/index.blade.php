<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-green-600 dark:text-green-400 mb-0.5">Mapa interactivo</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                    🗺️ Ubicaciones de plantas en Matamoros
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Explora y descubre dónde se encuentran las plantas adoptadas</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            <!-- Información de privacidad -->
            <div class="mb-12 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 8a1 1 0 11-2 0 1 1 0 012 0zm4 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="font-semibold text-blue-900 text-sm">Ubicaciones públicas</h3>
                        <p class="text-xs text-blue-700 mt-1">Los marcadores <span class="inline-block w-3 h-3 bg-blue-500 rounded-full align-middle mx-1"></span> son ubicaciones públicas visibles para todos</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="font-semibold text-red-900 text-sm">Ubicaciones privadas</h3>
                        <p class="text-xs text-red-700 mt-1">Los marcadores <span class="inline-block w-3 h-3 bg-red-500 rounded-full align-middle mx-1"></span> son solo visibles para ti y los administradores</p>
                    </div>
                </div>
            </div>

            <!-- Mapa -->
            <div class="mt-8 bg-white rounded-2xl shadow-lg overflow-hidden">
                <x-mapa-interactivo 
                    id="mapa-principal"
                    :canSelectLocation="false"
                    showToolbar="true"
                    height="600px"
                />
            </div>

            <!-- Estadísticas -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19C3.592 15.327 1 10.895 1 7c0-3.866 2.686-7 6-7s6 3.134 6 7c0 3.895-2.592 8.327-8 12zm12-7c0-3.866-2.686-7-6-7s-6 3.134-6 7c0 3.895 2.592 8.327 8 12c5.408-3.673 8-8.105 8-12z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Ubicaciones públicas</p>
                            <p class="text-2xl font-bold text-gray-900" id="stats-publicas">-</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Ubicaciones privadas</p>
                            <p class="text-2xl font-bold text-gray-900" id="stats-privadas">-</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c7.2 0 9 1.8 9 9s-1.8 9-9 9-9-1.8-9-9 1.8-9 9-9z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Plantas totales</p>
                            <p class="text-2xl font-bold text-gray-900" id="stats-plantas">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
// Cargar estadísticas
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
