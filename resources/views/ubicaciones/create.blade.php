<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Ubicación
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('ubicaciones.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tipo</label>
                        <select name="tipo" class="w-full border-gray-300 rounded" required>
                            <option value="publico">Público</option>
                            <option value="privado">Privado</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nombre del lugar</label>
                        <input type="text" name="nombre_lugar" class="w-full border-gray-300 rounded" required>
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

                    <div class="flex gap-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Guardar
                        </button>

                        <a href="{{ route('ubicaciones.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>