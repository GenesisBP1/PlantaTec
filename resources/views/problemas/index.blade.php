<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Problemas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('problemas.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Registrar problema
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Nombre</th>
                            <th class="p-3 text-left">Descripción</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($problemas as $problema)
                            <tr class="border-t">
                                <td class="p-3">{{ $problema->nombre }}</td>
                                <td class="p-3">{{ $problema->descripcion ?? 'Sin descripción' }}</td>
                                <td class="p-3 flex gap-2">
                                    <a href="{{ route('problemas.edit', $problema) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                                        Editar
                                    </a>

                                    <form action="{{ route('problemas.destroy', $problema) }}" method="POST">
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
                                <td colspan="3" class="p-4 text-center text-gray-500">
                                    No hay problemas registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>