<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar tratamiento
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('tratamientos.update', $tratamiento) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Problema</label>
                        <select name="id_problema" class="w-full border-gray-300 rounded" required>
                            <option value="">Selecciona un problema</option>
                            @foreach($problemas as $problema)
                                <option value="{{ $problema->id }}" {{ $tratamiento->id_problema == $problema->id ? 'selected' : '' }}>
                                    {{ $problema->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Planta</label>
                        <select name="id_planta" class="w-full border-gray-300 rounded">
                            {{-- Opción general (sin planta) --}}
                            <option value="" {{ $tratamiento->id_planta == null ? 'selected' : '' }}>
                                General para todas las plantas
                            </option>
                            @foreach($plantas as $planta)
                                <option value="{{ $planta->id }}" {{ $tratamiento->id_planta == $planta->id ? 'selected' : '' }}>
                                    {{ $planta->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion" class="w-full border-gray-300 rounded">{{ old('descripcion', $tratamiento->descripcion) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Indicaciones</label>
                        <textarea name="indicaciones" class="w-full border-gray-300 rounded">{{ old('indicaciones', $tratamiento->indicaciones) }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button class="bg-green-600 text-white px-4 py-2 rounded">
                            Actualizar
                        </button>

                        <a href="{{ route('tratamientos.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>