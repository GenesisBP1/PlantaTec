<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de recomendación de cuidado
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-2xl p-6">
                <h1 class="text-2xl font-bold text-green-800 mb-6">
                    Recomendación de cuidado
                </h1>

                <div class="space-y-4 text-gray-700">
                    <p>
                        <strong>Planta:</strong>
                        {{ $recomendacion->adopcion->planta->nombre ?? 'Sin planta registrada' }}
                    </p>

                    <p>
                        <strong>Cuidado:</strong>
                        {{ $recomendacion->plantaCuidado->cuidado->nombre ?? 'Sin cuidado registrado' }}
                    </p>

                    <p>
                        <strong>Mensaje:</strong>
                        {{ $recomendacion->mensaje ?? 'Sin mensaje registrado' }}
                    </p>

                    <p>
                        <strong>Prioridad:</strong>
                        {{ ucfirst($recomendacion->prioridad ?? 'Sin prioridad') }}
                    </p>

                    <p>
                        <strong>Estado:</strong>
                        {{ ucfirst($recomendacion->estado ?? 'Sin estado') }}
                    </p>

                    <p>
                        <strong>Fecha de registro:</strong>
                        {{ $recomendacion->created_at ? $recomendacion->created_at->format('d/m/Y') : 'Sin fecha' }}
                    </p>
                </div>

                <div class="flex gap-3 mt-6">
                    <a href="{{ route('recomendaciones-cuidado.edit', $recomendacion->id) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                        Editar
                    </a>

                    <a href="{{ route('recomendaciones-cuidado.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>