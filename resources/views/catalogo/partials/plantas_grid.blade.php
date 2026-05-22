@forelse($plantas as $planta)
    <div class="pt-catalog-card">
        <img src="{{ $planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&h=200&fit=crop' }}" 
             alt="{{ $planta->nombre }}">

        <div class="pt-catalog-card-body">
            <h3>{{ $planta->nombre }}</h3>

            <span class="pt-catalog-zone">
                {{ $planta->tipo_zona ?? 'Zona no especificada' }}
            </span>

            <p>{{ Str::limit($planta->descripcion, 80) }}</p>

            <a href="{{ route('catalogo.plantas.show', $planta) }}" class="pt-adopt-btn">
                Ver y adoptar
            </a>
        </div>
    </div>
@empty
    <div class="pt-empty center pt-catalog-empty">
        No hay plantas disponibles.
    </div>
@endforelse