<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis adopciones
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- FILTRO POR ESTADO --}}
            <form method="GET" action="{{ route('adopciones.index') }}" class="mb-6 flex gap-3">
                <select name="estado" class="border-gray-300 rounded">
                    <option value="">Todos los estados</option>
                    <option value="activa" {{ request('estado') == 'activa' ? 'selected' : '' }}>Activa</option>
                    <option value="finalizada" {{ request('estado') == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                    <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>

                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Filtrar
                </button>

                <a href="{{ route('adopciones.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Limpiar
                </a>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($adopciones as $adopcion)
                    <div class="bg-white shadow rounded-lg p-5">

                        @if(auth()->user()->rol === 'admin')
                            <p class="text-sm text-gray-500 mb-2">
                                Usuario: {{ $adopcion->usuario->name }}
                            </p>
                        @endif

                        <h3 class="text-xl font-bold text-green-700">
                            {{ $adopcion->planta->nombre }}
                        </h3>

                        <p class="text-gray-600">
                            {{ $adopcion->planta->especie }}
                        </p>

                        {{-- Estado: editable para admin, solo texto para usuario --}}
                        @if(auth()->user()->rol === 'admin')
                            <form action="{{ route('adopciones.update', $adopcion) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')

                                <label><strong>Estado:</strong></label>

                                <select name="estado_adopcion"
                                        onchange="this.form.submit()"
                                        class="border-gray-300 rounded">
                                    <option value="activa" {{ $adopcion->estado_adopcion == 'activa' ? 'selected' : '' }}>Activa</option>
                                    <option value="finalizada" {{ $adopcion->estado_adopcion == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                                    <option value="cancelada" {{ $adopcion->estado_adopcion == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                            </form>
                        @else
                            <p class="mt-2">
                                <strong>Estado adopción:</strong>
                                {{ $adopcion->estado_adopcion }}
                            </p>
                        @endif

                        <p class="mt-2">
                            <strong>Ubicación:</strong>
                            {{ $adopcion->ubicacion->nombre_lugar ?? 'No registrada' }}
                        </p>

                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('adopciones.show', $adopcion) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded">
                                Ver
                            </a>

                            {{-- Botón Cancelar: solo visible si la adopción está activa --}}
                            @if($adopcion->estado_adopcion === 'activa')
                                <form action="{{ route('adopciones.destroy', $adopcion) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                                        Cancelar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white shadow rounded-lg p-6 text-center text-gray-500">
                        Aún no tienes plantas adoptadas.
                    </div>
                @endforelse
            </div>

        </div>
        
    </div>
    
    
</x-app-layout>
