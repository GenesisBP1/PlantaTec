@forelse($plantas as $planta)
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 border border-purple-100 hover:border-purple-300">
        <img src="{{ $planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&h=200&fit=crop' }}" 
             alt="{{ $planta->nombre }}"
             class="w-full h-48 object-cover">

        <div class="p-5">
            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $planta->nombre }}</h3>

            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700 mb-3">
                {{ $planta->tipo_zona ?? 'Zona no especificada' }}
            </span>

            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($planta->descripcion, 80) }}</p>

            <a href="{{ route('catalogo.plantas.show', $planta) }}" 
               class="inline-flex items-center justify-center w-full px-4 py-2 bg-gradient-to-r from-purple-600 to-fuchsia-500 hover:from-purple-700 hover:to-fuchsia-600 text-white font-semibold rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                Ver y adoptar
            </a>
        </div>
    </div>
@empty
    <div class="col-span-full text-center py-12 bg-white rounded-2xl shadow-md border border-purple-100">
        <div class="text-6xl mb-4">🌱</div>
        <h3 class="text-xl font-bold text-gray-800">No hay plantas disponibles</h3>
        <p class="text-gray-500 mt-2">Pronto añadiremos nuevas especies.</p>
    </div>
@endforelse