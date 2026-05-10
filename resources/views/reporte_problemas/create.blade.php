<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reportar problema
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-xl font-bold text-green-700 mb-4">
                    {{ $adopcion->planta->nombre }}
                </h3>

                <form action="{{ route('reporte-problemas.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id_adopcion" value="{{ $adopcion->id }}">

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Problema detectado</label>
                        <select name="id_problema" class="w-full border-gray-300 rounded" required>
                            <option value="">Selecciona un problema</option>

                            @foreach($problemas as $problema)
                                <option value="{{ $problema->id }}">
                                    {{ $problema->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Gravedad</label>
                        <select name="gravedad" class="w-full border-gray-300 rounded" required>
                            <option value="leve">Leve</option>
                            <option value="media">Media</option>
                            <option value="grave">Grave</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion"
                                  class="w-full border-gray-300 rounded"
                                  placeholder="Describe lo que observas"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Imagen (opcional)</label>
                        <input type="file"
                               name="imagen"
                               class="w-full border-gray-300 rounded">
                    </div>

                    <div class="flex gap-2">
                        <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                            Reportar problema
                        </button>

                        <a href="{{ route('adopciones.show', $adopcion) }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>