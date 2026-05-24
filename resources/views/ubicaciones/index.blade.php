<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Ubicaciones</p>
                <h2 class="pt-header-title">Gestión de ubicaciones</h2>
                <p class="pt-header-subtitle">Panel de administración</p>
            </div>
            <div class="pt-header-actions">
                <a href="{{ route('ubicaciones.create') }}" class="pt-btn pt-btn-green">+ Registrar ubicación</a>
            </div>
        </div>
    </x-slot>

    <style>
        /* ========== ESTILOS ESPECÍFICOS PARA TABLA DE UBICACIONES ========== */
        .pt-admin-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1.5rem;
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
            overflow: hidden;
            padding: 1.5rem;
        }
        .pt-admin-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }
        .pt-admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .pt-admin-table thead tr {
            background: linear-gradient(90deg, #f0fdf4, #ecfdf5);
        }
        .pt-admin-table th {
            padding: 1rem;
            text-align: left;
            font-size: 0.85rem;
            font-weight: 900;
            color: #374151;
            border-bottom: 1px solid #d1fae5;
            white-space: nowrap;
        }
        .pt-admin-table td {
            padding: 1rem;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        .pt-admin-table tbody tr:hover {
            background: #f0fdf4;
        }
        .pt-table-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .pt-table-actions form {
            margin: 0;
        }
        .pt-action-btn {
            border: 1px solid transparent;
            border-radius: 0.75rem;
            padding: 0.45rem 0.75rem;
            font-size: 0.8rem;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .pt-action-btn.view {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }
        .pt-action-btn.view:hover {
            background: #2563eb;
            color: #ffffff;
        }
        .pt-action-btn.edit {
            background: #fefce8;
            color: #ca8a04;
            border-color: #fde68a;
        }
        .pt-action-btn.edit:hover {
            background: #ca8a04;
            color: #ffffff;
        }
        .pt-action-btn.delete {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }
        .pt-action-btn.delete:hover {
            background: #dc2626;
            color: #ffffff;
        }
        .pt-pagination {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }
        .pt-pagination nav {
            display: inline-flex;
            gap: 0.25rem;
        }
        .pt-pagination .page-link {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            color: #374151;
            text-decoration: none;
            font-size: 0.875rem;
        }
        .pt-pagination .active .page-link {
            background: #16a34a;
            border-color: #16a34a;
            color: white;
        }
        .pt-pagination .page-link:hover {
            background: #f0fdf4;
            border-color: #16a34a;
        }
        @media (max-width: 768px) {
            .pt-admin-card {
                padding: 1rem;
            }
            .pt-admin-table th,
            .pt-admin-table td {
                padding: 0.75rem;
            }
            .pt-table-actions {
                flex-direction: column;
                align-items: stretch;
            }
            .pt-action-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container">
            <div class="pt-admin-card">
                <div class="pt-admin-table-wrapper">
                    <table class="pt-admin-table">
                        <thead>
                            <tr>
                                <th>Lugar</th>
                                <th>Tipo</th>
                                <th>Usuario</th>
                                <th>Coordenadas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ubicaciones as $ubicacion)
                                <tr>
                                    <td>{{ $ubicacion->nombre_lugar }}</td>
                                    <td>{{ ucfirst($ubicacion->tipo) }}</td>
                                    <td>{{ $ubicacion->usuario?->name ?? '—' }}</td>
                                    <td>{{ $ubicacion->latitud }}, {{ $ubicacion->longitud }}</td>
                                    <td class="pt-table-actions">
                                        <a href="{{ route('ubicaciones.show', $ubicacion) }}" class="pt-action-btn view">Ver</a>
                                        <form action="{{ route('ubicaciones.destroy', $ubicacion) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pt-action-btn delete" onclick="return confirm('¿Eliminar esta ubicación?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="pt-empty center">No hay ubicaciones registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($ubicaciones instanceof \Illuminate\Pagination\LengthAwarePaginator && $ubicaciones->hasPages())
                    <div class="pt-pagination">
                        {{ $ubicaciones->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>