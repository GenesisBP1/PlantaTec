<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Planta
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('plantas.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nombre</label>
                        <input type="text" name="nombre" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Especie</label>
                        <input type="text" name="especie" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tipo de zona</label>
                        <input type="text" name="tipo_zona" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Imagen</label>
                        <input type="text" name="imagen" class="w-full border-gray-300 rounded" placeholder="URL o nombre de imagen">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion" class="w-full border-gray-300 rounded"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Estado</label>
                        <select name="estado" class="w-full border-gray-300 rounded" required>
                            <option value="saludable">Saludable</option>
                            <option value="observacion">Observación</option>
                            <option value="problema">Problema</option>
                            <option value="tratamiento">Tratamiento</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Guardar
                        </button>

                        <a href="{{ route('plantas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>