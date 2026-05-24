<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-purple-600 dark:text-purple-400 mb-0.5">Perfil de usuario</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">{{ $usuario->name }}</h2>
            </div>
            <a href="{{ route('admin.usuarios.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Información personal -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden border border-purple-100 dark:border-purple-800">
                <div class="border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-fuchsia-50 dark:from-purple-900/20 dark:to-fuchsia-900/20 px-6 py-4">
                    <h3 class="text-lg font-bold text-purple-700 dark:text-purple-400 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Información personal
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nombre completo</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $usuario->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Correo electrónico</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $usuario->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Rol</p>
                            <p class="font-semibold text-gray-900 dark:text-white">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                    {{ $usuario->rol === 'admin' ? 'Administrador' : 'Usuario' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Fecha de registro</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $usuario->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Adopciones -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden border border-purple-100 dark:border-purple-800">
                <div class="border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-fuchsia-50 dark:from-purple-900/20 dark:to-fuchsia-900/20 px-6 py-4">
                    <h3 class="text-lg font-bold text-purple-700 dark:text-purple-400 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        🌱 Adopciones
                    </h3>
                </div>
                <div class="p-6">
                    @if($adopciones->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-purple-50 dark:bg-purple-900/30">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-purple-700 dark:text-purple-300 uppercase tracking-wider">Planta</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-purple-700 dark:text-purple-300 uppercase tracking-wider">Fecha</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-purple-700 dark:text-purple-300 uppercase tracking-wider">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @foreach($adopciones as $adopcion)
                                        <tr class="hover:bg-purple-50/30 dark:hover:bg-purple-900/10 transition">
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $adopcion->planta->nombre }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $adopcion->created_at->format('d/m/Y') }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @if($adopcion->estado_adopcion === 'activa') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($adopcion->estado_adopcion === 'cancelada') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">
                                                    {{ ucfirst($adopcion->estado_adopcion) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $adopciones->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-purple-100 dark:bg-purple-900/50 mb-4">
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4M12 4v16"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400">Este usuario aún no ha realizado adopciones.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>