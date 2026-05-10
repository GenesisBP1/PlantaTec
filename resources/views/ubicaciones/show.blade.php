<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de Ubicación
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-4">{{ $ubicacion->nombre_lugar }}</h3>

                <p><strong>Tipo:</strong> {{ ucfirst($ubicacion->tipo) }}</p>

                <p><strong>Latitud:</strong> {{ $ubicacion->latitud ?? 'No especificada' }}</p>

                <p><strong>Longitud:</strong> {{ $ubicacion->longitud ?? 'No especificada' }}</p>

                <div class="mt-4">
                    <strong>Descripción:</strong>
                    <p class="text-gray-700">
                        {{ $ubicacion->descripcion ?? 'Sin descripción.' }}
                    </p>
                </div>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('ubicaciones.edit', $ubicacion) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Editar
                    </a>

                    <a href="{{ route('ubicaciones.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Volver
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>