<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adoptar Planta
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-green-700">
                    {{ $planta->nombre }}
                </h3>

                <p class="text-gray-600 mt-2">
                    <strong>Especie:</strong> {{ $planta->especie }}
                </p>

                <p class="mt-2">
                    <strong>Zona recomendada:</strong>
                    {{ $planta->tipo_zona ?? 'No especificada' }}
                </p>

                <p class="mt-2">
                    <strong>Estado:</strong>
                    {{ $planta->estado }}
                </p>

                <div class="mt-4">
                    <strong>Descripción:</strong>
                    <p class="text-gray-700">
                        {{ $planta->descripcion ?? 'Sin descripción.' }}
                    </p>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-xl font-semibold mb-4">
                    Datos de ubicación (opcional)
                </h4>

                <form action="{{ route('catalogo.plantas.adoptar', $planta) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tipo</label>
                        <select name="tipo" class="w-full border-gray-300 rounded">
                            <option value="">Selecciona</option>
                            <option value="publico">Público</option>
                            <option value="privado">Privado</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nombre del lugar</label>
                        <input type="text" name="nombre_lugar" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion" class="w-full border-gray-300 rounded"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Latitud</label>
                        <input type="text" name="latitud" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Longitud</label>
                        <input type="text" name="longitud" class="w-full border-gray-300 rounded">
                    </div>

                    <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded">
                        Adoptar planta
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>