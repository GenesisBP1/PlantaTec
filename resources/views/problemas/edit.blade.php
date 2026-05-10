<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar problema
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('problemas.update', $problema) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nombre</label>
                        <input type="text"
                               name="nombre"
                               value="{{ $problema->nombre }}"
                               class="w-full border-gray-300 rounded"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion"
                                  class="w-full border-gray-300 rounded">{{ $problema->descripcion }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Imagen (opcional)</label>
                        <input type="text"
                               name="imagen"
                               value="{{ $problema->imagen }}"
                               class="w-full border-gray-300 rounded">
                    </div>

                    <div class="flex gap-2">
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded">
                            Actualizar
                        </button>

                        <a href="{{ route('problemas.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>