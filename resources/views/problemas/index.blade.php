<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Problemas</p>
                <h2 class="pt-header-title">Gestión de problemas</h2>
                <p class="pt-header-subtitle">Panel de administración</p>
            </div>
            <div class="pt-header-actions">
                <a href="{{ route('problemas.create') }}" class="pt-btn pt-btn-green">+ Registrar problema</a>
            </div>
        </div>
    </x-slot>

    <style>
        /* ========== ESTILOS ESPECÍFICOS PARA LA TABLA DE PROBLEMAS ========== */
        /* (El layout base ya trae reset, navbar, colores, etc.) */
        .pt-admin-card {
            background: #ffffff;
            border-radius: 1.25rem;
            border: 1px solid #f3f4f6;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            padding: 1rem 0;
        }
        .pt-admin-table-wrapper {
            overflow-x: auto;
        }
        .pt-admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .pt-admin-table th,
        .pt-admin-table td {
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }
        .pt-admin-table th {
            background: #f9fafb;
            font-weight: 800;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #4b5563;
        }
        .pt-admin-table tbody tr:hover {
            background: #faf9f6;
        }
        .pt-table-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            align-items: center;
        }
        .pt-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.4rem 0.8rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 800;
            text-decoration: none;
            transition: 0.2s ease;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }
        .pt-action-btn.view {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }
        .pt-action-btn.view:hover {
            background: #2563eb;
            color: white;
        }
        .pt-action-btn.edit {
            background: #fefce8;
            color: #ca8a04;
            border: 1px solid #fde68a;
        }
        .pt-action-btn.edit:hover {
            background: #ca8a04;
            color: white;
        }
        .pt-action-btn.delete {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .pt-action-btn.delete:hover {
            background: #dc2626;
            color: white;
        }
        .pt-empty.center {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
        }
        @media (max-width: 768px) {
            .pt-admin-table th,
            .pt-admin-table td {
                padding: 0.75rem 1rem;
            }
            .pt-table-actions {
                flex-direction: column;
                align-items: flex-start;
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
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($problemas as $problema)
                                <tr>
                                    <td>{{ $problema->nombre }}</td>
                                    <td>{{ Str::limit($problema->descripcion, 80) }}</td>
                                    <td class="pt-table-actions">
                                        <a href="{{ route('problemas.show', $problema) }}" class="pt-action-btn view">Ver</a>
                                        <a href="{{ route('problemas.edit', $problema) }}" class="pt-action-btn edit">Editar</a>
                                        <form action="{{ route('problemas.destroy', $problema) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pt-action-btn delete" onclick="return confirm('¿Eliminar este problema?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="pt-empty center">No hay problemas registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pt-pagination">
                    {{ $problemas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>