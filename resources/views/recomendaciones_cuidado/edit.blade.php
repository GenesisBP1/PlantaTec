<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar recomendación de cuidado
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-2xl p-6">
                <h1 class="text-2xl font-bold text-green-800 mb-6">
                    Editar recomendación
                </h1>

                <form method="POST" action="{{ route('recomendaciones-cuidado.update', $recomendacion->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700 mb-2">
                            Planta
                        </label>
                        <input type="text"
                               value="{{ $recomendacion->adopcion->planta->nombre ?? 'Sin planta registrada' }}"
                               disabled
                               class="w-full rounded-lg border-gray-300 bg-gray-100">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700 mb-2">
                            Cuidado
                        </label>
                        <input type="text"
                               value="{{ $recomendacion->plantaCuidado->cuidado->nombre ?? 'Sin cuidado registrado' }}"
                               disabled
                               class="w-full rounded-lg border-gray-300 bg-gray-100">
                    </div>

                    <div class="mb-4">
                        <label for="mensaje" class="block font-semibold text-gray-700 mb-2">
                            Mensaje
                        </label>
                        <textarea name="mensaje"
                                  id="mensaje"
                                  rows="4"
                                  required
                                  class="w-full rounded-lg border-gray-300">{{ old('mensaje', $recomendacion->mensaje) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="prioridad" class="block font-semibold text-gray-700 mb-2">
                            Prioridad
                        </label>
                        <select name="prioridad"
                                id="prioridad"
                                required
                                class="w-full rounded-lg border-gray-300">
                            <option value="baja" {{ old('prioridad', $recomendacion->prioridad) == 'baja' ? 'selected' : '' }}>
                                Baja
                            </option>
                            <option value="media" {{ old('prioridad', $recomendacion->prioridad) == 'media' ? 'selected' : '' }}>
                                Media
                            </option>
                            <option value="alta" {{ old('prioridad', $recomendacion->prioridad) == 'alta' ? 'selected' : '' }}>
                                Alta
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="estado" class="block font-semibold text-gray-700 mb-2">
                            Estado
                        </label>
                        <select name="estado"
                                id="estado"
                                required
                                class="w-full rounded-lg border-gray-300">
                            <option value="pendiente" {{ old('estado', $recomendacion->estado) == 'pendiente' ? 'selected' : '' }}>
                                Pendiente
                            </option>
                            <option value="revisada" {{ old('estado', $recomendacion->estado) == 'revisada' ? 'selected' : '' }}>
                                Revisada
                            </option>
                            <option value="atendida" {{ old('estado', $recomendacion->estado) == 'atendida' ? 'selected' : '' }}>
                                Atendida
                            </option>
                        </select>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                            Guardar cambios
                        </button>

                        <a href="{{ route('recomendaciones-cuidado.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>