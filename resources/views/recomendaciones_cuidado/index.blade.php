<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Recomendaciones de cuidado
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Planta</th>
                            <th class="p-3 text-left">Cuidado</th>
                            <th class="p-3 text-left">Mensaje</th>
                            <th class="p-3 text-left">Prioridad</th>
                            <th class="p-3 text-left">Estado</th>
                            <th class="p-3 text-left">Fecha</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($recomendaciones as $recomendacion)
                            <tr class="border-t">
                                <td class="p-3">
                                    {{ $recomendacion->adopcion->planta->nombre ?? 'Sin planta' }}
                                </td>

                                <td class="p-3">
                                    {{ $recomendacion->plantaCuidado->cuidado->nombre ?? 'Sin cuidado' }}
                                </td>

                                <td class="p-3">
                                    {{ $recomendacion->mensaje }}
                                </td>

                                <td class="p-3">
                                    {{ $recomendacion->prioridad }}
                                </td>

                                <td class="p-3">
                                    {{ $recomendacion->estado }}
                                </td>

                                <td class="p-3">
                                    {{ $recomendacion->fecha_generada }}
                                </td>

                                <td class="p-3">
                                    <form action="{{ route('recomendaciones-cuidado.destroy', $recomendacion) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-600 text-white px-3 py-1 rounded">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">
                                    No hay recomendaciones generadas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>