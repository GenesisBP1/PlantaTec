<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis notificaciones
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                @forelse($notificaciones as $notificacion)
                    <div class="border-b py-4 {{ $notificacion->leida ? 'opacity-60' : '' }}">
                        <h3 class="font-bold text-lg">
                            {{ $notificacion->titulo }}
                        </h3>

                        <p class="text-gray-700">
                            {{ $notificacion->mensaje }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            Tipo: {{ $notificacion->tipo ?? 'General' }} |
                            Fecha: {{ $notificacion->fecha_envio }}
                        </p>

                        @if(!$notificacion->leida)
                            <form action="{{ route('notificaciones.update', $notificacion) }}" method="POST" class="mt-3">
                                @csrf
                                @method('PUT')

                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                    Marcar como leída
                                </button>
                            </form>
                        @else
                            <span class="inline-block mt-3 text-green-600 text-sm">
                                Leída
                            </span>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 text-center">
                        No tienes notificaciones.
                    </p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>