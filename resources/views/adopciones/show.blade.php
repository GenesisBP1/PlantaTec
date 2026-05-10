<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de adopción
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-green-700">
                    {{ $adopcion->planta->nombre }}
                </h3>

                <p class="mt-2">
                    <strong>Especie:</strong>
                    {{ $adopcion->planta->especie }}
                </p>

                <p class="mt-2">
                    <strong>Estado adopción:</strong>
                    {{ $adopcion->estado_adopcion }}
                </p>

                <p class="mt-2">
                    <strong>Ubicación:</strong>
                    {{ $adopcion->ubicacion->nombre_lugar ?? 'No registrada' }}
                </p>

                <p class="mt-2">
                    <strong>Descripción planta:</strong>
                    {{ $adopcion->planta->descripcion ?? 'Sin descripción.' }}
                </p>
            </div>

            {{-- Botones de acción --}}
            <div class="mb-6 flex gap-2">
                <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id]) }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Registrar cuidado
                </a>

                <a href="{{ route('reporte-problemas.create', ['adopcion_id' => $adopcion->id]) }}"
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Reportar problema
                </a>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-xl font-semibold mb-4">
                    Historial de cuidados
                </h4>

                @forelse($adopcion->registrosCuidados as $registro)
                    <div class="border-b py-3">
                        <p>
                            <strong>Cuidado:</strong>
                            {{ $registro->plantaCuidado->cuidado->nombre }}
                        </p>

                        <p>
                            <strong>Fecha:</strong>
                            {{ $registro->fecha }}
                        </p>

                        <p>
                            <strong>Descripción:</strong>
                            {{ $registro->descripcion ?? 'Sin descripción' }}
                        </p>

                        <p>
                            <strong>Estado observado:</strong>
                            {{ $registro->estado_observado ?? 'No especificado' }}
                        </p>

                        @if($registro->imagen)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $registro->imagen) }}"
                                     alt="Evidencia cuidado"
                                     class="w-48 rounded shadow">
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">
                        Aún no hay cuidados registrados.
                    </p>
                @endforelse
            </div>

            {{-- ══ PROBLEMAS REPORTADOS (con badges visuales) ══ --}}
            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <h4 class="text-xl font-semibold mb-4">
                    Problemas reportados
                </h4>

                @forelse($adopcion->reportesProblemas as $reporte)
                    <div class="border-b py-3">
                        <p>
                            <strong>Problema:</strong>
                            {{ $reporte->problema->nombre }}
                        </p>

                        <p>
                            <strong>Gravedad:</strong>
                            {{ ucfirst($reporte->gravedad) }}
                        </p>

                        <p>
                            <strong>Estado:</strong>
                            {{-- Badge visual según estado --}}
                            @if($reporte->estado === 'activo')
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm font-semibold">
                                    Activo
                                </span>
                            @elseif($reporte->estado === 'en_revision')
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm font-semibold">
                                    En revisión
                                </span>
                            @elseif($reporte->estado === 'resuelto')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm font-semibold">
                                    Resuelto
                                </span>
                            @else
                                {{ $reporte->estado }}
                            @endif
                        </p>

                        <p>
                            <strong>Descripción:</strong>
                            {{ $reporte->descripcion ?? 'Sin descripción' }}
                        </p>

                        <div class="mt-3">
                            <a href="{{ route('reporte-problemas.show', $reporte) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                Ver diagnóstico
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">
                        No hay problemas reportados.
                    </p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>