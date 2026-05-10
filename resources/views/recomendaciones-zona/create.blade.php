<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Nueva zona pública
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6">
                <form action="{{ route('recomendaciones-zona.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Nombre del lugar *</label>
                        <input type="text" name="nombre_lugar" value="{{ old('nombre_lugar') }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        @error('nombre_lugar') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Tipo de zona</label>
                        <input type="text" name="tipo_zona" value="{{ old('tipo_zona') }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Ej: Parque urbano, Jardín botánico...">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Indicaciones</label>
                        <textarea name="indicaciones" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm"
                                  placeholder="Recomendaciones para plantar...">{{ old('indicaciones') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Latitud</label>
                            <input type="text" name="latitud" value="{{ old('latitud') }}" 
                                   class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Ej: 25.8792">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Longitud</label>
                            <input type="text" name="longitud" value="{{ old('longitud') }}" 
                                   class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Ej: -97.5044">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Descripción completa</label>
                        <textarea name="descripcion" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm"
                                  placeholder="Información adicional sobre el lugar...">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('recomendaciones-zona.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg">Cancelar</a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Guardar zona</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>