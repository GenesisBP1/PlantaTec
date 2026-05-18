@props([
    'title' => 'Gestión de Registros',
    'subtitle' => 'Panel de Administración',
    'createRoute' => null,
    'createLabel' => 'Crear Registro',
    'columns' => [],
    'rows' => [],
    'actions' => [],
    'emptyMessage' => 'No hay registros disponibles',
])

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-green-600 dark:text-green-400 mb-0.5">
                    {{ $subtitle }}
                </p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                    {{ $title }}
                </h2>
            </div>
            @if($createRoute)
            <div>
                <a href="{{ $createRoute }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    + {{ $createLabel }}
                </a>
            </div>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-2xl border border-gray-100 dark:border-gray-700">
                <!-- Mensajes de sesión -->
                <div class="p-6 space-y-2">
                    @if(session('success'))
                        <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 rounded-lg flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="font-semibold">¡Éxito!</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 rounded-lg flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="font-semibold">Error</p>
                                <p class="text-sm">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Tabla -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <!-- Encabezado -->
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-600">
                                @foreach($columns as $column)
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $column }}
                                </th>
                                @endforeach
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <!-- Cuerpo -->
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($rows as $index => $row)
                                <tr class="hover:bg-green-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    @foreach($row as $cell)
                                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                            {!! $cell !!}
                                        </td>
                                    @endforeach

                                    <!-- Acciones -->
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            @if(isset($actions[$index]['view']))
                                                <a href="{{ $actions[$index]['view'] }}" 
                                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    Ver
                                                </a>
                                            @endif

                                            @if(isset($actions[$index]['edit']))
                                                <a href="{{ $actions[$index]['edit'] }}" 
                                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-yellow-600 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-600 hover:text-white hover:border-yellow-600 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Editar
                                                </a>
                                            @endif

                                            @if(isset($actions[$index]['delete']))
                                                <form method="POST" action="{{ $actions[$index]['delete'] }}" onsubmit="return confirm('¿Estás seguro? Esta acción no se puede deshacer.');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($columns) + 1 }}" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                            <p class="text-gray-500 dark:text-gray-400 font-medium">{{ $emptyMessage }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
