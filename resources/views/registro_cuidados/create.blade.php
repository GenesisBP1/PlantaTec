<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar cuidado
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-xl font-bold text-green-700 mb-4">
                    {{ $adopcion->planta->nombre }}
                </h3>

                <!-- ✅ 1. AÑADIDO enctype="multipart/form-data" -->
                <form action="{{ route('registro-cuidados.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id_adopcion" value="{{ $adopcion->id }}">

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tipo de cuidado</label>
                        <select name="id_planta_cuidado" class="w-full border-gray-300 rounded" required>
                            <option value="">Selecciona un cuidado</option>

                            @foreach($cuidados as $cuidado)
                                <option value="{{ $cuidado->id }}">
                                    {{ $cuidado->cuidado->nombre }} (cada {{ $cuidado->frecuencia }} días)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Fecha</label>
                        <input type="date"
                               name="fecha"
                               class="w-full border-gray-300 rounded"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion"
                                  class="w-full border-gray-300 rounded"
                                  placeholder="Ejemplo: regué la planta por la mañana"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Estado observado</label>
                        <input type="text"
                               name="estado_observado"
                               class="w-full border-gray-300 rounded"
                               placeholder="Ejemplo: hojas saludables">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Imagen (opcional)</label>
                        <!-- ✅ 2. CAMBIADO a type="file" -->
                        <input type="file"
                               name="imagen"
                               class="w-full border-gray-300 rounded"
                               accept="image/*">
                    </div>

                    <div class="flex gap-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Guardar registro
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