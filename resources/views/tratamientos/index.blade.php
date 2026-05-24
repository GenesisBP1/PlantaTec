<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Tratamientos</p>
                <h2 class="pt-header-title">Gestión de tratamientos</h2>
                <p class="pt-header-subtitle">Panel de administración</p>
            </div>
            <div class="pt-header-actions">
                <a href="{{ route('tratamientos.create') }}" class="pt-btn pt-btn-green">+ Registrar tratamiento</a>
            </div>
        </div>
    </x-slot>

    <style>
      /* ========== ESTILOS ESPECÍFICOS PARA TRATAMIENTOS ========== */

* {
    box-sizing: border-box;
}

/* =========================
   ESPACIADO GENERAL
========================= */
.pt{
    background: var(--background);
}
.pt-page {
    padding: 2.5rem 0 3.5rem;
    background: #ffffff;
    min-height: calc(100vh - 80px);
}

.pt-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1.5rem;
    background: transparent;
}

/* =========================
   CARD
========================= */

.pt-admin-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 1.5rem;
    box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
    overflow: hidden;
    padding: 1.5rem;
}

/* =========================
   TABLA
========================= */

.pt-admin-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.pt-admin-table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    table-layout: fixed;
}

/* Ancho de columnas */
.pt-admin-table th:nth-child(1),
.pt-admin-table td:nth-child(1) {
    width: 15%;
}

.pt-admin-table th:nth-child(2),
.pt-admin-table td:nth-child(2) {
    width: 9%;
}

.pt-admin-table th:nth-child(3),
.pt-admin-table td:nth-child(3) {
    width: 9%;
}

.pt-admin-table th:nth-child(4),
.pt-admin-table td:nth-child(4) {
    width: 22%;
}

.pt-admin-table th:nth-child(5),
.pt-admin-table td:nth-child(5) {
    width: 30%;
}

.pt-admin-table th:nth-child(6),
.pt-admin-table td:nth-child(6) {
    width: 15%;
    min-width: 260px;
}

.pt-admin-table thead tr {
    background: linear-gradient(90deg, #f0fdf4, #ecfdf5);
}

.pt-admin-table th {
    padding: 1rem;
    text-align: left;
    font-size: 0.78rem;
    font-weight: 900;
    color: #166534;
    border-bottom: 1px solid #d1fae5;
    white-space: nowrap;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.pt-admin-table td {
    padding: 1rem;
    font-size: 0.9rem;
    color: #374151;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: middle;
    line-height: 1.45;
    word-wrap: break-word;
}

.pt-admin-table tbody tr {
    transition: 0.2s ease;
}

.pt-admin-table tbody tr:hover {
    background: #f8fbf8;
}

.pt-admin-table tbody tr:last-child td {
    border-bottom: none;
}

/* =========================
   ACCIONES
========================= */

.pt-table-actions {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 0.55rem;
    flex-wrap: nowrap;
}

.pt-table-actions form {
    margin: 0 !important;
    display: inline-flex !important;
}

.pt-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid transparent;
    border-radius: 999px;
    padding: 0.5rem 0.85rem;
    font-size: 0.78rem;
    font-weight: 900;
    text-decoration: none;
    cursor: pointer;
    transition: 0.2s ease;
    font-family: inherit;
    line-height: 1;
    white-space: nowrap;
    min-width: 72px;
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

/* =========================
   EMPTY
========================= */

.pt-empty.center {
    text-align: center;
    padding: 2rem;
    color: #6b7280;
    font-weight: 700;
    background: #f9fafb;
    border-radius: 1rem;
}

/* =========================
   PAGINACIÓN
========================= */

.pt-pagination {
    margin-top: 1.5rem;
}

.pt-pagination nav[role="navigation"] {
    margin-top: 1rem;
}

.pt-pagination nav[role="navigation"] > div {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 1rem !important;
    flex-wrap: wrap !important;
}

.pt-pagination nav[role="navigation"] svg {
    width: 18px !important;
    height: 18px !important;
    max-width: 18px !important;
    max-height: 18px !important;
}

.pt-pagination nav[role="navigation"] a,
.pt-pagination nav[role="navigation"] span {
    width: auto !important;
    height: auto !important;
    min-width: 36px !important;
    min-height: 36px !important;
    max-width: none !important;
    max-height: none !important;
    padding: 0.45rem 0.75rem !important;
    border-radius: 0.7rem !important;
    font-size: 0.875rem !important;
    line-height: 1.2 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    position: static !important;
}

.pt-pagination nav[role="navigation"] a {
    color: #374151 !important;
    background: #ffffff !important;
    border: 1px solid #e5e7eb !important;
    text-decoration: none !important;
}

.pt-pagination nav[role="navigation"] a:hover {
    background: #f0fdf4 !important;
    color: #15803d !important;
    border-color: #bbf7d0 !important;
}

.pt-pagination nav[role="navigation"] span[aria-current="page"] span {
    background: #16a34a !important;
    color: #ffffff !important;
    border-color: #16a34a !important;
}

.pt-pagination nav[role="navigation"] p {
    margin: 0 !important;
    color: #6b7280 !important;
    font-size: 0.875rem !important;
}

.pt-pagination nav[role="navigation"] .hidden {
    display: none !important;
}

/* =========================
   SPAN CORREGIDO
========================= */

.pt-page span,
.pt-admin-card span,
.pt-admin-table span,
.pt-pagination span {
    position: static !important;
    top: auto !important;
    right: auto !important;
    left: auto !important;
    bottom: auto !important;
    width: auto !important;
    height: auto !important;
    min-width: auto !important;
    max-width: none !important;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 900px) {
    .pt-admin-table {
        min-width: 1050px;
    }
}

@media (max-width: 768px) {
    .pt-page {
        padding: 2rem 0;
    }

    .pt-container {
        padding: 0 1rem;
    }

    .pt-admin-card {
        padding: 1rem;
        border-radius: 1.2rem;
    }

    .pt-admin-table,
    .pt-admin-table thead,
    .pt-admin-table tbody,
    .pt-admin-table tr,
    .pt-admin-table td,
    .pt-admin-table th {
        display: block;
        width: 100% !important;
        min-width: 0 !important;
    }

    .pt-admin-table thead {
        display: none;
    }

    .pt-admin-table tr {
        margin-bottom: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 0.75rem;
        background: #ffffff;
    }

    .pt-admin-table td {
        border: none;
        padding: 0.5rem 0;
    }

    .pt-admin-table td:nth-child(1)::before {
        content: "Problema: ";
        font-weight: 900;
        color: #166534;
    }

    .pt-admin-table td:nth-child(2)::before {
        content: "Planta: ";
        font-weight: 900;
        color: #166534;
    }

    .pt-admin-table td:nth-child(3)::before {
        content: "Cuidado: ";
        font-weight: 900;
        color: #166534;
    }

    .pt-admin-table td:nth-child(4)::before {
        content: "Descripción: ";
        font-weight: 900;
        color: #166534;
    }

    .pt-admin-table td:nth-child(5)::before {
        content: "Indicaciones: ";
        font-weight: 900;
        color: #166534;
    }

    .pt-admin-table td:nth-child(6)::before {
        content: "Acciones: ";
        font-weight: 900;
        color: #166534;
        display: block;
        margin-bottom: 0.5rem;
    }

    .pt-table-actions {
        flex-direction: column;
        align-items: stretch;
        width: 100%;
    }

    .pt-table-actions form {
        width: 100%;
    }

    .pt-action-btn {
        width: 100%;
    }

    .pt-pagination nav[role="navigation"] > div {
        justify-content: center !important;
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
                                <th>Problema</th>
                                <th>Planta</th>
                                <th>Cuidado</th>
                                <th>Descripción</th>
                                <th>Indicaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tratamientos as $tratamiento)
                                <tr>
                                    <td>{{ $tratamiento->problema->nombre ?? 'Sin problema' }}</td>
                                    <td>{{ $tratamiento->planta->nombre ?? 'General' }}</td>
                                    <td>{{ $tratamiento->cuidado->nombre ?? 'Sin cuidado' }}</td>
                                    <td>{{ Str::limit($tratamiento->descripcion, 50) }}</td>
                                    <td>{{ Str::limit($tratamiento->indicaciones, 50) }}</td>
                                    <td class="pt-table-actions">
                                        <a href="{{ route('tratamientos.show', $tratamiento) }}" class="pt-action-btn view">Ver</a>
                                        <a href="{{ route('tratamientos.edit', $tratamiento) }}" class="pt-action-btn edit">Editar</a>
                                        <form action="{{ route('tratamientos.destroy', $tratamiento) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pt-action-btn delete" onclick="return confirm('¿Eliminar este tratamiento?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="pt-empty center">No hay tratamientos registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pt-pagination">
                    {{ $tratamientos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>