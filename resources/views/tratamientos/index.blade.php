<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Tratamientos
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6">
                <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wide">Catálogo interno</p>
                        <h3 class="text-2xl font-bold text-slate-900 mt-1">Tratamientos registrados</h3>
                        <p class="text-sm text-slate-500 mt-2 max-w-2xl">
                            Revisa, edita o elimina los tratamientos disponibles para cada problema, planta o cuidado.
                        </p>
                    </div>

                    <a href="{{ route('tratamientos.create') }}"
                       class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                        Registrar tratamiento
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Problema</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Planta</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Cuidado</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Descripción</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Indicaciones</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse($tratamientos as $tratamiento)
                                <tr class="align-top hover:bg-slate-50/70">
                                    <td class="px-4 py-4 font-medium text-slate-900">
                                        {{ $tratamiento->problema->nombre ?? 'Sin problema' }}
                                    </td>

                                    <td class="px-4 py-4 text-slate-600">
                                        {{ $tratamiento->planta->nombre ?? 'General' }}
                                    </td>

                                    <td class="px-4 py-4 text-slate-600">
                                        {{ $tratamiento->cuidado->nombre ?? 'Sin cuidado específico' }}
                                    </td>

                                    <td class="px-4 py-4 text-slate-600">
                                        {{ $tratamiento->descripcion ?? 'Sin descripción' }}
                                    </td>

                                    <td class="px-4 py-4 text-slate-600">
                                        {{ $tratamiento->indicaciones ?? 'Sin indicaciones' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('tratamientos.edit', $tratamiento) }}"
                                               class="inline-flex items-center rounded-lg bg-amber-500 px-3 py-1.5 text-sm font-semibold text-white transition hover:bg-amber-600">
                                                Editar
                                            </a>

                                            <form action="{{ route('tratamientos.destroy', $tratamiento) }}" method="POST"
                                                  onsubmit="return confirm('¿Eliminar este tratamiento?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="inline-flex items-center rounded-lg bg-rose-600 px-3 py-1.5 text-sm font-semibold text-white transition hover:bg-rose-700">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-10 text-center text-slate-500">
                                        No hay tratamientos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>