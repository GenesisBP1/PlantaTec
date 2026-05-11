<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-green-600 mb-0.5">Panel de Administración</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                    Gestión de Usuarios
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-2xl">
                <div class="p-6">
                    
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-xl">{{ session('error') }}</div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Rol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Registro</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($usuarios as $usuario)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white">
                                                {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                            </div>
                                            {{ $usuario->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">{{ $usuario->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $usuario->rol === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-green-100 text-green-700' }}">
                                            {{ $usuario->rol === 'admin' ? 'Admin' : 'Usuario' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $usuario->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.usuarios.show', $usuario->id) }}" class="text-blue-600 hover:text-blue-800"><b>Ver</b></a>
                                            <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="text-yellow-600 hover:text-yellow-800"><b>Editar</b></a>
                                            @if($usuario->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.usuarios.destroy', $usuario->id) }}" onsubmit="return confirm('¿Eliminar?')">
                                                @csrf @method('DELETE')
                                                <button class="text-red-600 hover:text-red-800"><b>Eliminar</b></button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No hay usuarios</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $usuarios->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>