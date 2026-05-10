<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Cuidado
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('cuidados.update', $cuidado) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nombre del cuidado</label>
                        <input type="text"
                               name="nombre"
                               value="{{ $cuidado->nombre }}"
                               class="w-full border-gray-300 rounded"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion"
                                  class="w-full border-gray-300 rounded">{{ $cuidado->descripcion }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                            Actualizar
                        </button>

                        <a href="{{ route('cuidados.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>