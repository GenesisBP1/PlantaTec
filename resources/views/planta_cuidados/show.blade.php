<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de asignación de cuidado
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-2xl p-6">
                <h1 class="text-2xl font-bold text-green-800 mb-6">
                    Asignación de cuidado
                </h1>

                <div class="space-y-4 text-gray-700">
                    <p>
                        <strong>Planta:</strong>
                        {{ $asignacion->planta->nombre ?? 'Sin planta registrada' }}
                    </p>

                    <p>
                        <strong>Cuidado:</strong>
                        {{ $asignacion->cuidado->nombre ?? 'Sin cuidado registrado' }}
                    </p>

                    <p>
                        <strong>Frecuencia:</strong>
                        {{ $asignacion->frecuencia ?? 'Sin frecuencia registrada' }}
                    </p>

                    <p>
                        <strong>Instrucciones:</strong>
                        {{ $asignacion->instrucciones_esp ?? 'Sin instrucciones registradas' }}
                    </p>

                    <p>
                        <strong>Evidencia requerida:</strong>
                        {{ $asignacion->evidencia ?? 'No especificada' }}
                    </p>

                    <p>
                        <strong>Fecha de registro:</strong>
                        {{ $asignacion->created_at ? $asignacion->created_at->format('d/m/Y') : 'Sin fecha' }}
                    </p>
                </div>

                <div class="flex gap-3 mt-6">
                    <a href="{{ route('planta-cuidados.edit', $asignacion) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                        Editar
                    </a>

                    <a href="{{ route('planta-cuidados.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>