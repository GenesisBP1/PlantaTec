<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Tratamiento
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 md:p-8">

                <div class="mb-6">
                    <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wide">
                        Nuevo registro
                    </p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">
                        Crear tratamiento
                    </h3>
                    <p class="text-sm text-slate-500 mt-2">
                        Completa los datos para relacionar el problema con una planta, cuidado y frecuencia del tratamiento.
                    </p>
                </div>

                @if($errors->any())
                    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">
                        <p class="font-semibold">Revisa los campos del formulario:</p>
                        <ul class="mt-2 list-disc pl-5 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tratamientos.store') }}" method="POST">
                    @csrf

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">
                                Problema
                            </label>
                            <select name="id_problema"
                                    class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
                                    required>
                                <option value="">Selecciona un problema</option>
                                @foreach($problemas as $problema)
                                    <option value="{{ $problema->id }}" {{ old('id_problema') == $problema->id ? 'selected' : '' }}>
                                        {{ $problema->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">
                                Planta
                            </label>
                            <select name="id_planta"
                                    class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="" {{ old('id_planta') == null ? 'selected' : '' }}>
                                    Aplicable a cualquier planta
                                </option>
                                @foreach($plantas as $planta)
                                    <option value="{{ $planta->id }}" {{ old('id_planta') == $planta->id ? 'selected' : '' }}>
                                        {{ $planta->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-1 block text-sm font-semibold text-slate-700">
                                Cuidado que ayuda a resolver
                            </label>
                            <select name="id_cuidado"
                                    class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="" {{ old('id_cuidado') == null ? 'selected' : '' }}>
                                    Sin cuidado específico
                                </option>
                                @foreach($cuidados as $cuidado)
                                    <option value="{{ $cuidado->id }}" {{ old('id_cuidado') == $cuidado->id ? 'selected' : '' }}>
                                        {{ $cuidado->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">
                                Frecuencia del tratamiento
                            </label>
                            <div class="flex items-center gap-2">
                                <input type="number"
                                       name="frecuencia_dias"
                                       min="1"
                                       value="{{ old('frecuencia_dias', 1) }}"
                                       class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
                                       required>
                                <span class="text-sm text-slate-500">días</span>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-1 block text-sm font-semibold text-slate-700">
                                Descripción
                            </label>
                            <textarea name="descripcion"
                                      class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
                                      rows="3">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-1 block text-sm font-semibold text-slate-700">
                                Indicaciones
                            </label>
                            <textarea name="indicaciones"
                                      class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
                                      rows="4">{{ old('indicaciones') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-2.5 font-semibold text-white transition hover:bg-emerald-700">
                            Guardar
                        </button>

                        <a href="{{ route('tratamientos.index') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-slate-600 px-5 py-2.5 font-semibold text-white transition hover:bg-slate-700">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>