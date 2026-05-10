<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Asignar cuidado a planta
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('planta-cuidados.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Planta</label>
                        <select name="id_planta" class="w-full border-gray-300 rounded" required>
                            <option value="">Selecciona una planta</option>
                            @foreach($plantas as $planta)
                                <option value="{{ $planta->id }}">{{ $planta->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Cuidado</label>
                        <select name="id_cuidado" class="w-full border-gray-300 rounded" required>
                            <option value="">Selecciona un cuidado</option>
                            @foreach($cuidados as $cuidado)
                                <option value="{{ $cuidado->id }}">{{ $cuidado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Frecuencia (días)</label>
                        <input type="text"
                               name="frecuencia"
                               class="w-full border-gray-300 rounded"
                               placeholder="Ejemplo: 3"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Instrucciones</label>
                        <textarea name="instrucciones_esp"
                                  class="w-full border-gray-300 rounded"
                                  placeholder="Ejemplo: regar sin encharcar"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Evidencia (opcional)</label>
                        <input type="text"
                               name="evidencia"
                               class="w-full border-gray-300 rounded"
                               placeholder="Texto o referencia">
                    </div>

                    <div class="flex gap-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Guardar
                        </button>

                        <a href="{{ route('planta-cuidados.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>