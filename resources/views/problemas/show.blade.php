<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del problema
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-2xl p-6">
                <h1 class="text-2xl font-bold text-green-800 mb-4">
                    {{ $problema->nombre }}
                </h1>

                <p class="text-gray-700 mb-4">
                    <strong>Descripción:</strong>
                    {{ $problema->descripcion ?? 'Sin descripción' }}
                </p>

                @if($problema->imagen)
                    <img src="{{ asset('storage/' . $problema->imagen) }}"
                         alt="{{ $problema->nombre }}"
                         class="w-64 h-64 object-cover rounded-xl mb-4">
                @endif

                <div class="flex gap-3 mt-6">
                    <a href="{{ route('problemas.edit', $problema) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                        Editar
                    </a>

                    <a href="{{ route('problemas.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>