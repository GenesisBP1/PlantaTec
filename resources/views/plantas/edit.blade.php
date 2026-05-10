<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Planta
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('plantas.update', $planta) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nombre</label>
                        <input type="text" name="nombre" value="{{ $planta->nombre }}" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Especie</label>
                        <input type="text" name="especie" value="{{ $planta->especie }}" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tipo de zona</label>
                        <input type="text" name="tipo_zona" value="{{ $planta->tipo_zona }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Imagen</label>
                        <input type="text" name="imagen" value="{{ $planta->imagen }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion" class="w-full border-gray-300 rounded">{{ $planta->descripcion }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Estado</label>
                        <select name="estado" class="w-full border-gray-300 rounded">
                            <option value="saludable" {{ $planta->estado == 'saludable' ? 'selected' : '' }}>Saludable</option>
                            <option value="observacion" {{ $planta->estado == 'observacion' ? 'selected' : '' }}>Observación</option>
                            <option value="problema" {{ $planta->estado == 'problema' ? 'selected' : '' }}>Problema</option>
                            <option value="tratamiento" {{ $planta->estado == 'tratamiento' ? 'selected' : '' }}>Tratamiento</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                            Actualizar
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