<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de Planta
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">{{ $planta->nombre }}</h3>

                <p><strong>Especie:</strong> {{ $planta->especie }}</p>
                <p><strong>Tipo de zona:</strong> {{ $planta->tipo_zona ?? 'No especificada' }}</p>
                <p><strong>Estado:</strong> {{ $planta->estado }}</p>

                <div class="mt-4">
                    <strong>Descripción:</strong>
                    <p class="text-gray-700">
                        {{ $planta->descripcion ?? 'Sin descripción.' }}
                    </p>
                </div>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('plantas.edit', $planta) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Editar
                    </a>

                    <a href="{{ route('plantas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                        Volver
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>