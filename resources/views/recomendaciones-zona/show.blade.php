<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de recomendación por zona
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-2xl p-6">
                <h1 class="text-2xl font-bold text-green-800 mb-4">
                    {{ $zona->nombre_lugar }}
                </h1>

                <p><strong>Tipo de zona:</strong> {{ $zona->tipo_zona ?? 'Sin tipo' }}</p>
                <p><strong>Descripción:</strong> {{ $zona->descripcion ?? 'Sin descripción' }}</p>
                <p><strong>Indicaciones:</strong> {{ $zona->indicaciones ?? 'Sin indicaciones' }}</p>
                <p><strong>Latitud:</strong> {{ $zona->latitud ?? 'No registrada' }}</p>
                <p><strong>Longitud:</strong> {{ $zona->longitud ?? 'No registrada' }}</p>

                <div class="flex gap-3 mt-6">
                    <a href="{{ route('recomendaciones-zona.edit', $zona) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                        Editar
                    </a>

                    <a href="{{ route('recomendaciones-zona.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>