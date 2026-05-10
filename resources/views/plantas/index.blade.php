<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Plantas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 flex gap-4">
                <a href="{{ route('plantas.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Registrar Planta
                </a>

            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Nombre</th>
                            <th class="p-3 text-left">Especie</th>
                            <th class="p-3 text-left">Zona</th>
                            <th class="p-3 text-left">Estado</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($plantas as $planta)
                            <tr class="border-t">
                                <td class="p-3">{{ $planta->nombre }}</td>
                                <td class="p-3">{{ $planta->especie }}</td>
                                <td class="p-3">{{ $planta->tipo_zona }}</td>
                                <td class="p-3">{{ $planta->estado }}</td>
                                <td class="p-3 flex gap-2">
                                    <a href="{{ route('plantas.show', $planta) }}"
                                       class="bg-blue-500 text-white px-3 py-1 rounded">
                                        Ver
                                    </a>

                                    <a href="{{ route('plantas.edit', $planta) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                                        Editar
                                    </a>

                                    <form action="{{ route('plantas.destroy', $planta) }}" method="POST">
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
                                <td colspan="5" class="p-4 text-center text-gray-500">
                                    No hay plantas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>