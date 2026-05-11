<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar tratamiento
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 md:p-8">

                <div class="mb-6">
                    <p class="text-sm font-semibold text-amber-600 uppercase tracking-wide">Edición de registro</p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">Actualizar tratamiento</h3>
                    <p class="text-sm text-slate-500 mt-2">
                        Cambia el problema, planta o descripción asociada sin perder la información actual.
                    </p>
                </div>

                <form action="{{ route('tratamientos.update', $tratamiento) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Problema</label>
                            <select name="id_problema" class="w-full rounded-xl border-slate-300 focus:border-amber-500 focus:ring-amber-500" required>
                                <option value="">Selecciona un problema</option>
                                @foreach($problemas as $problema)
                                    <option value="{{ $problema->id }}" {{ old('id_problema', $tratamiento->id_problema) == $problema->id ? 'selected' : '' }}>
                                        {{ $problema->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Planta</label>
                            <select name="id_planta" class="w-full rounded-xl border-slate-300 focus:border-amber-500 focus:ring-amber-500">
                                <option value="" {{ old('id_planta', $tratamiento->id_planta) == null ? 'selected' : '' }}>
                                    General para todas las plantas
                                </option>
                                @foreach($plantas as $planta)
                                    <option value="{{ $planta->id }}" {{ old('id_planta', $tratamiento->id_planta) == $planta->id ? 'selected' : '' }}>
                                        {{ $planta->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Descripción</label>
                            <textarea name="descripcion" class="w-full rounded-xl border-slate-300 focus:border-amber-500 focus:ring-amber-500" rows="3">{{ old('descripcion', $tratamiento->descripcion) }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Indicaciones</label>
                            <textarea name="indicaciones" class="w-full rounded-xl border-slate-300 focus:border-amber-500 focus:ring-amber-500" rows="4">{{ old('indicaciones', $tratamiento->indicaciones) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-amber-600 px-5 py-2.5 font-semibold text-white transition hover:bg-amber-700">
                            Actualizar
                        </button>

                        <a href="{{ route('tratamientos.index') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-600 px-5 py-2.5 font-semibold text-white transition hover:bg-slate-700">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>