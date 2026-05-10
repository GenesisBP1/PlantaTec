<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Diagnóstico y tratamiento sugerido
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Reporte --}}
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-green-700">
                    {{ $reporteProblema->adopcion->planta->nombre }}
                </h3>

                <p class="mt-2">
                    <strong>Problema:</strong>
                    {{ $reporteProblema->problema->nombre }}
                </p>

                <p class="mt-2">
                    <strong>Gravedad:</strong>
                    {{ ucfirst($reporteProblema->gravedad) }}
                </p>

                <p class="mt-2">
                    <strong>Descripción:</strong>
                    {{ $reporteProblema->descripcion ?? 'Sin descripción' }}
                </p>

                @if($reporteProblema->imagen)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $reporteProblema->imagen) }}"
                             alt="Problema reportado"
                             class="w-64 rounded shadow">
                    </div>
                @endif
            </div>

            {{-- Tratamientos --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-xl font-semibold mb-4">
                    Tratamientos sugeridos
                </h4>

                @forelse($tratamientos as $tratamiento)
                    <div class="border-b py-4">
                        <p>
                            <strong>Descripción:</strong>
                            {{ $tratamiento->descripcion ?? 'Sin descripción' }}
                        </p>

                        <p class="mt-2">
                            <strong>Indicaciones:</strong>
                            {{ $tratamiento->indicaciones ?? 'Sin indicaciones' }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500">
                        No se encontraron tratamientos para este problema y planta.
                    </p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>