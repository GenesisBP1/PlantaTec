<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Catálogo de Plantas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($plantas as $planta)
                    <div class="bg-white shadow rounded-lg p-5">
                        <h3 class="text-xl font-bold text-green-700">
                            {{ $planta->nombre }}
                        </h3>

                        <p class="text-gray-600 mt-1">
                            {{ $planta->especie }}
                        </p>

                        <p class="mt-2 text-sm">
                            <strong>Zona:</strong> {{ $planta->tipo_zona ?? 'No especificada' }}
                        </p>

                        <p class="mt-2 text-sm">
                            <strong>Estado:</strong> {{ $planta->estado }}
                        </p>

                        <p class="mt-3 text-gray-700">
                            {{ Str::limit($planta->descripcion, 80) }}
                        </p>

                        <div class="mt-4">
                            <a href="{{ route('catalogo.plantas.show', $planta) }}"
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                                Ver y adoptar
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white shadow rounded-lg p-6 text-center text-gray-500">
                        No hay plantas disponibles en el catálogo.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>