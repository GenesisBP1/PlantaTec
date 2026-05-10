<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🌍 Zonas públicas recomendadas
            </h2>
            <a href="{{ route('recomendaciones-zona.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                + Nueva zona
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Latitud</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Longitud</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($zonas as $zona)
                                <tr>
                                    <td class="px-6 py-4">{{ $zona->nombre_lugar }}</td>
                                    <td class="px-6 py-4">{{ $zona->tipo_zona ?? '—' }}</td>
                                    <td class="px-6 py-4">{{ $zona->latitud ?? '—' }}</td>
                                    <td class="px-6 py-4">{{ $zona->longitud ?? '—' }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('recomendaciones-zona.edit', $zona) }}" 
                                           class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                            Editar
                                        </a>
                                        <form action="{{ route('recomendaciones-zona.destroy', $zona) }}" method="POST" 
                                              onsubmit="return confirm('¿Eliminar esta zona?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-500">No hay zonas registradas.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $zonas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>