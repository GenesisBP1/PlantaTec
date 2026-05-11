<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $usuario->name }}</h2>
            <a href="{{ route('admin.usuarios.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-xl">Volver</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6">
                <h3 class="text-lg font-bold mb-4">Información personal</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><p class="text-gray-500">Nombre:</p><p class="font-semibold">{{ $usuario->name }}</p></div>
                    <div><p class="text-gray-500">Email:</p><p class="font-semibold">{{ $usuario->email }}</p></div>
                    <div><p class="text-gray-500">Rol:</p><p class="font-semibold">{{ $usuario->rol === 'admin' ? 'Administrador' : 'Usuario' }}</p></div>
                    <div><p class="text-gray-500">Registro:</p><p class="font-semibold">{{ $usuario->created_at->format('d/m/Y') }}</p></div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6">
                <h3 class="text-lg font-bold mb-4">🌱 Adopciones</h3>
                @if($adopciones->count() > 0)
                    <table class="min-w-full">
                        <thead>
                            <tr><th>Planta</th><th>Fecha</th><th>Estado</th></tr>
                        </thead>
                        <tbody>
                            @foreach($adopciones as $adopcion)
                            <tr>
                                <td>{{ $adopcion->planta->nombre }}</td>
                                <td>{{ $adopcion->created_at->format('d/m/Y') }}</td>
                                <td>{{ $adopcion->estado_adopcion }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $adopciones->links() }}
                @else
                    <p>Sin adopciones</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>