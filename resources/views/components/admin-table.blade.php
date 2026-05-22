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
        <div class="pt-header">
            <div>
                <p class="pt-header-label">{{ $subtitle }}</p>
                <h2 class="pt-header-title">{{ $title }}</h2>
            </div>

            @if($createRoute)
                <div class="pt-header-actions">
                    <a href="{{ $createRoute }}" class="pt-btn pt-btn-green">
                        + {{ $createLabel }}
                    </a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-admin-card">

                @if(session('success'))
                    <div class="pt-alert-success">
                        <strong>¡Éxito!</strong>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="pt-alert-error">
                        <strong>Error</strong>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <div class="pt-admin-table-wrapper">
                    <table class="pt-admin-table">
                        <thead>
                            <tr>
                                @foreach($columns as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($rows as $index => $row)
                                <tr>
                                    @foreach($row as $cell)
                                        <td>{!! $cell !!}</td>
                                    @endforeach

                                    <td>
                                        <div class="pt-table-actions">
                                            @if(isset($actions[$index]['view']))
                                                <a href="{{ $actions[$index]['view'] }}" class="pt-action-btn view">
                                                    Ver
                                                </a>
                                            @endif

                                            @if(isset($actions[$index]['edit']))
                                                <a href="{{ $actions[$index]['edit'] }}" class="pt-action-btn edit">
                                                    Editar
                                                </a>
                                            @endif

                                            @if(isset($actions[$index]['delete']))
                                                <form method="POST"
                                                      action="{{ $actions[$index]['delete'] }}"
                                                      onsubmit="return confirm('¿Estás seguro? Esta acción no se puede deshacer.');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="pt-action-btn delete">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($columns) + 1 }}">
                                        <div class="pt-empty-state">
                                            <div class="pt-empty-icon">📭</div>
                                            <p>{{ $emptyMessage }}</p>
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