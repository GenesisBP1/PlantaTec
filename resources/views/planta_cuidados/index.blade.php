<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cuidados asignados a plantas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('planta-cuidados.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Asignar cuidado
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Planta</th>
                            <th class="p-3 text-left">Cuidado</th>
                            <th class="p-3 text-left">Frecuencia</th>
                            <th class="p-3 text-left">Instrucciones</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($asignaciones as $asignacion)
                            <tr class="border-t">
                                <td class="p-3">{{ $asignacion->planta->nombre }}</td>
                                <td class="p-3">{{ $asignacion->cuidado->nombre }}</td>
                                <td class="p-3">Cada {{ $asignacion->frecuencia }} días</td>
                                <td class="p-3">{{ $asignacion->instrucciones_esp ?? 'Sin instrucciones' }}</td>
                                <td class="p-3">
                                    <form action="{{ route('planta-cuidados.destroy', $asignacion) }}" method="POST">
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
                                    No hay cuidados asignados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>