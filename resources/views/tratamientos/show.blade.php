<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del tratamiento
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-2xl p-6">
                <h1 class="text-2xl font-bold text-green-800 mb-4">
                    Tratamiento registrado
                </h1>

                <p class="mb-3">
                    <strong>Problema:</strong>
                    {{ $tratamiento->problema->nombre ?? 'Sin problema' }}
                </p>

                <p class="mb-3">
                    <strong>Planta:</strong>
                    {{ $tratamiento->planta->nombre ?? 'General' }}
                </p>

                <p class="mb-3">
                    <strong>Cuidado:</strong>
                    {{ $tratamiento->cuidado->nombre ?? 'Sin cuidado específico' }}
                </p>

                <p class="mb-3">
                    <strong>Descripción:</strong>
                    {{ $tratamiento->descripcion ?? 'Sin descripción' }}
                </p>

                <p class="mb-3">
                    <strong>Indicaciones:</strong>
                    {{ $tratamiento->indicaciones ?? 'Sin indicaciones' }}
                </p>

                <div class="flex gap-3 mt-6">
                    <a href="{{ route('tratamientos.edit', $tratamiento) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                        Editar
                    </a>

                    <a href="{{ route('tratamientos.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>