<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Diagnóstico del problema
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Datos del problema --}}
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-green-700 mb-2">
                    {{ $reporteProblema->problema->nombre }}
                </h3>
                <p class="text-gray-600">Gravedad: {{ ucfirst($reporteProblema->gravedad) }} - Estado: {{ ucfirst($reporteProblema->estado) }}</p>
                <p class="mt-2">{{ $reporteProblema->descripcion ?? 'Sin descripción adicional.' }}</p>
                @if($reporteProblema->imagen)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $reporteProblema->imagen) }}" class="w-48 rounded shadow" alt="Evidencia del problema">
                    </div>
                @endif
            </div>

            {{-- Tratamiento sugerido --}}
            @php
                $tratamiento = $reporteProblema->tratamientoSugerido();
            @endphp

            @if($tratamiento)
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                    <h4 class="text-xl font-bold text-green-800">Tratamiento sugerido</h4>
                    <p class="mt-2"><strong>Descripción:</strong> {{ $tratamiento->descripcion }}</p>
                    <p><strong>Indicaciones:</strong> {{ $tratamiento->indicaciones }}</p>
                    <p><strong>Frecuencia:</strong> Cada {{ $tratamiento->frecuencia_dias }} días</p>

                    <form action="{{ route('reporte-problemas.aplicar-tratamiento', $reporteProblema) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <input type="hidden" name="id_tratamiento" value="{{ $tratamiento->id }}">
                        <div class="mb-4">
                            <label class="block font-medium">Fecha de aplicación</label>
                            <input type="datetime-local" name="fecha_aplicacion" value="{{ now()->format('Y-m-d\TH:i') }}" required class="w-full border rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium">Imagen (evidencia)</label>
                            <input type="file" name="imagen" accept="image/*">
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium">Observaciones</label>
                            <textarea name="observaciones" rows="2" class="w-full border rounded"></textarea>
                        </div>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Registrar aplicación</button>
                    </form>
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                    <p class="text-yellow-800">No hay un tratamiento sugerido para este problema en esta planta.</p>
                </div>
            @endif

            {{-- Historial de aplicaciones --}}
            @php
                $aplicaciones = $reporteProblema->seguimientoTratamientos()->with('tratamiento')->latest()->get();
            @endphp
            @if($aplicaciones->count())
                <div class="bg-white shadow rounded-lg p-6">
                    <h4 class="text-xl font-bold">Historial de aplicaciones</h4>
                    <div class="space-y-4 mt-4">
                        @foreach($aplicaciones as $aplicacion)
                            <div class="border-b pb-3">
                                <p><strong>Aplicado el:</strong> {{ $aplicacion->fecha_aplicacion->format('d/m/Y H:i') }}</p>
                                <p><strong>Tratamiento:</strong> {{ $aplicacion->tratamiento->descripcion }}</p>
                                @if($aplicacion->observaciones)<p>{{ $aplicacion->observaciones }}</p>@endif
                                @if($aplicacion->imagen)
                                    <img src="{{ asset('storage/' . $aplicacion->imagen) }}" class="w-32 rounded shadow mt-2">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>