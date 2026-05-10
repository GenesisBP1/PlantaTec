<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reportes de problemas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Usuario</th>
                            <th class="p-3 text-left">Planta</th>
                            <th class="p-3 text-left">Problema</th>
                            <th class="p-3 text-left">Gravedad</th>
                            <th class="p-3 text-left">Estado</th>
                            <th class="p-3 text-left">Fecha</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reportes as $reporte)
                            <tr class="border-t">
                                <td class="p-3">
                                    {{ $reporte->adopcion->usuario->name ?? 'Sin usuario' }}
                                </td>

                                <td class="p-3">
                                    {{ $reporte->adopcion->planta->nombre ?? 'Sin planta' }}
                                </td>

                                <td class="p-3">
                                    {{ $reporte->problema->nombre ?? 'Sin problema' }}
                                </td>

                                <td class="p-3">
                                    {{ ucfirst($reporte->gravedad) }}
                                </td>

                                <td class="p-3">
                                    {{ $reporte->estado }}
                                </td>

                                <td class="p-3">
                                    {{ $reporte->created_at->format('d/m/Y') }}
                                </td>

                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('reporte-problemas.show', $reporte) }}"
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                            Ver
                                        </a>

                                        @if($reporte->estado !== 'resuelto')
                                            <form action="{{ route('reporte-problemas.resolver', $reporte) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                                    Resolver
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">
                                    No hay reportes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>