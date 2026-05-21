@forelse($plantas as $planta)
    <div class="card">
        <img src="{{ $planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&h=200&fit=crop' }}" 
             alt="{{ $planta->nombre }}">
        <div class="card-body">
            <h3>{{ $planta->nombre }}</h3>
            <span class="zona">{{ $planta->tipo_zona ?? 'Zona no especificada' }}</span>
            <p>{{ Str::limit($planta->descripcion, 80) }}</p>
            <a href="{{ route('catalogo.plantas.show', $planta) }}" class="btn-adoptar">
                Ver y adoptar
            </a>
        </div>
    </div>
@empty
    <div class="col-span-3 text-center py-10 text-gray-500">
        No hay plantas disponibles.
    </div>
@endforelse