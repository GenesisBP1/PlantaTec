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
        /* ============================================
   PlantaTec - Gestión de asignaciones
   Tabla con encabezado verde claro
============================================ */

:root {
    --pt-green: #16a34a;
    --pt-green-dark: #15803d;
    --pt-green-soft: #eefaf2;
    --pt-green-hover: #f0fdf4;
    --pt-green-border: #d1fae5;
    --pt-bg: #f6f8f5;
    --pt-card: #ffffff;
    --pt-text: #111827;
    --pt-muted: #6b7280;
    --pt-border: #e5e7eb;
    --pt-blue: #2563eb;
    --pt-yellow: #ca8a04;
    --pt-red: #dc2626;
}

* {
    box-sizing: border-box;
}

/* =========================
   NAV BLANCO
========================= */

.pt-navbar {
    background: #ffffff !important;
    border-bottom: 1px solid #e5e7eb !important;
    position: sticky;
    top: 0;
    z-index: 50;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
}

.pt-nav-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1rem;
}

.pt-nav-inner {
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.pt-nav-left {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.pt-logo {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    text-decoration: none;
    color: #111827 !important;
    font-size: 1.25rem;
    font-weight: 900;
}

.pt-logo-icon {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    background: #166534;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pt-desktop-menu {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.pt-nav-link {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.6rem 0.85rem;
    border-radius: 0.75rem;
    color: #111827 !important;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 800;
    border: none;
    background: transparent;
    cursor: pointer;
    font-family: inherit;
    transition: 0.2s ease;
}

.pt-nav-link:hover,
.pt-nav-link.active {
    background: #f0fdf4 !important;
    color: #15803d !important;
}

.pt-dropdown {
    position: relative;
}

.pt-dropdown-menu,
.pt-user-dropdown {
    position: absolute;
    top: 115%;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 1rem;
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.12);
    overflow: hidden;
    z-index: 100;
}

.pt-dropdown-menu {
    left: 0;
    width: 270px;
    padding: 0.4rem;
}

.pt-dropdown-menu a,
.pt-user-dropdown a,
.pt-user-dropdown button {
    display: block;
    width: 100%;
    padding: 0.75rem 1rem;
    color: #374151 !important;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 700;
    background: transparent;
    border: none;
    text-align: left;
    cursor: pointer;
    font-family: inherit;
}

.pt-dropdown-menu a:hover,
.pt-user-dropdown a:hover,
.pt-user-dropdown button:hover {
    background: #f0fdf4 !important;
    color: #15803d !important;
}

.pt-user-menu {
    position: relative;
}

.pt-user-btn {
    display: flex;
    align-items: center;
    gap: 0.65rem;
    padding: 0.45rem 0.7rem;
    border-radius: 0.9rem;
    background: transparent !important;
    border: none !important;
    cursor: pointer;
    font-family: inherit;
    color: #111827 !important;
}

.pt-user-btn:hover {
    background: #f9fafb !important;
}

.pt-avatar {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    background: #166534;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
}

.pt-user-text {
    text-align: left;
}

.pt-user-text p {
    margin: 0;
    color: #111827 !important;
    font-size: 0.875rem;
    font-weight: 900;
}

.pt-user-text span {
    display: block;
    color: #6b7280 !important;
    font-size: 0.75rem;
    line-height: 1.2;
}

.pt-user-arrow {
    color: #374151 !important;
}

.pt-user-dropdown {
    right: 0;
    width: 230px;
}

.pt-user-info {
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.pt-user-info p {
    margin: 0;
    font-weight: 900;
    color: #111827 !important;
}

.pt-user-info span {
    display: block;
    color: #6b7280 !important;
    font-size: 0.75rem;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* =========================
   HEADER DE LA VISTA
========================= */

.pt-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.pt-header-label {
    font-size: 0.75rem;
    font-weight: 900;
    color: var(--pt-green);
    text-transform: uppercase;
    letter-spacing: 0.16em;
    margin: 0 0 0.35rem;
}

.pt-header-title {
    font-size: 1.5rem;
    font-weight: 900;
    color: var(--pt-text);
    margin: 0;
    line-height: 1.2;
}

.pt-header-subtitle {
    color: var(--pt-muted);
    font-size: 0.875rem;
    margin: 0.35rem 0 0;
}

.pt-header-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

/* =========================
   LAYOUT GENERAL
========================= */

.pt-page {
    background: var(--pt-bg);
    min-height: calc(100vh - 80px);
    padding: 3rem 1rem 4rem;
}

.pt-container {
    max-width: 1320px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* =========================
   BOTONES GENERALES
========================= */

.pt-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.7rem 1.15rem;
    border-radius: 0.9rem;
    font-size: 0.875rem;
    font-weight: 900;
    text-decoration: none;
    border: none;
    cursor: pointer;
    font-family: inherit;
    transition: 0.2s ease;
}

.pt-btn-green {
    background: var(--pt-green);
    color: #ffffff;
}

.pt-btn-green:hover {
    background: var(--pt-green-dark);
    transform: translateY(-1px);
}

.pt-btn-light {
    background: #ffffff;
    color: #374151;
    border: 1px solid var(--pt-border);
}

.pt-btn-light:hover {
    background: #f9fafb;
}

/* =========================
   CARD DE TABLA
========================= */

.pt-admin-card {
    background: var(--pt-card);
    border: 1px solid #dbe7df;
    border-radius: 1.5rem;
    box-shadow: 0 14px 34px rgba(0, 32, 0, 0.08);
    overflow: hidden;
    padding: 1.5rem;
}

/* =========================
   TABLA
========================= */

.pt-admin-table-wrapper {
    width: 100%;
    overflow-x: auto;
    background: #ffffff;
}

.pt-admin-table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    table-layout: fixed;
}

/* Columnas para tabla de asignaciones */
.pt-admin-table th:nth-child(1),
.pt-admin-table td:nth-child(1) {
    width: 18%;
}

.pt-admin-table th:nth-child(2),
.pt-admin-table td:nth-child(2) {
    width: 14%;
}

.pt-admin-table th:nth-child(3),
.pt-admin-table td:nth-child(3) {
    width: 12%;
}

.pt-admin-table th:nth-child(4),
.pt-admin-table td:nth-child(4) {
    width: 36%;
}

.pt-admin-table th:nth-child(5),
.pt-admin-table td:nth-child(5) {
    width: 20%;
    min-width: 290px;
}

/* Encabezado verde claro */
.pt-admin-table thead tr {
    background: var(--pt-green-soft);
}

.pt-admin-table th {
    background: var(--pt-green-soft);
    padding: 1rem;
    text-align: left;
    font-size: 0.78rem;
    font-weight: 900;
    color: #166534;
    border-bottom: 1px solid var(--pt-green-border);
    white-space: nowrap;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}

/* Celdas */
.pt-admin-table td {
    padding: 1rem;
    font-size: 0.9rem;
    color: #374151;
    border-bottom: 1px solid #eef2f0;
    vertical-align: middle;
    line-height: 1.45;
    word-wrap: break-word;
}

.pt-admin-table tbody tr {
    background: #ffffff;
    transition: 0.2s ease;
}

.pt-admin-table tbody tr:nth-child(even) {
    background: #fbfefc;
}

.pt-admin-table tbody tr:hover,
.pt-admin-table tbody tr:nth-child(even):hover {
    background: var(--pt-green-hover);
}

.pt-admin-table tbody tr:last-child td {
    border-bottom: none;
}

.pt-admin-table td strong {
    color: #111827;
    font-weight: 900;
}

.pt-admin-table td span {
    color: #6b7280;
    font-size: 0.8rem;
}

/* =========================
   ACCIONES DE TABLA
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
    padding: 0.5rem 0.9rem;
    font-size: 0.78rem;
    font-weight: 900;
    text-decoration: none;
    cursor: pointer;
    transition: 0.2s ease;
    font-family: inherit;
    line-height: 1;
    white-space: nowrap;
    min-width: 74px;
}

.pt-action-btn.view {
    background: #eff6ff;
    color: var(--pt-blue);
    border-color: #bfdbfe;
}

.pt-action-btn.view:hover {
    background: var(--pt-blue);
    color: #ffffff;
}

.pt-action-btn.edit {
    background: #fefce8;
    color: var(--pt-yellow);
    border-color: #fde68a;
}

.pt-action-btn.edit:hover {
    background: var(--pt-yellow);
    color: #ffffff;
}

.pt-action-btn.delete {
    background: #fef2f2;
    color: var(--pt-red);
    border-color: #fecaca;
}

.pt-action-btn.delete:hover {
    background: var(--pt-red);
    color: #ffffff;
}

/* =========================
   EMPTY STATE
========================= */

.pt-empty {
    background: #f9fafb;
    border: 1px solid #f3f4f6;
    border-radius: 1rem;
    padding: 2rem 1rem;
    color: #6b7280;
    font-size: 0.875rem;
}

.pt-empty.center {
    text-align: center;
}

/* =========================
   PAGINACIÓN
========================= */

.pt-admin-card nav[role="navigation"],
.pt-page nav[role="navigation"] {
    margin-top: 1.5rem;
}

.pt-admin-card nav[role="navigation"] > div,
.pt-page nav[role="navigation"] > div {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 1rem !important;
    flex-wrap: wrap !important;
}

.pt-admin-card nav[role="navigation"] svg,
.pt-page nav[role="navigation"] svg {
    width: 18px !important;
    height: 18px !important;
    max-width: 18px !important;
    max-height: 18px !important;
}

.pt-admin-card nav[role="navigation"] a,
.pt-admin-card nav[role="navigation"] span,
.pt-page nav[role="navigation"] a,
.pt-page nav[role="navigation"] span {
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

.pt-admin-card nav[role="navigation"] a,
.pt-page nav[role="navigation"] a {
    color: #374151 !important;
    background: #ffffff !important;
    border: 1px solid #e5e7eb !important;
    text-decoration: none !important;
}

.pt-admin-card nav[role="navigation"] a:hover,
.pt-page nav[role="navigation"] a:hover {
    background: #f0fdf4 !important;
    color: #15803d !important;
    border-color: #bbf7d0 !important;
}

.pt-admin-card nav[role="navigation"] span[aria-current="page"] span,
.pt-page nav[role="navigation"] span[aria-current="page"] span {
    background: var(--pt-green) !important;
    color: #ffffff !important;
    border-color: var(--pt-green) !important;
}

.pt-admin-card nav[role="navigation"] p,
.pt-page nav[role="navigation"] p {
    margin: 0 !important;
    color: #6b7280 !important;
    font-size: 0.875rem !important;
}

/* =========================
   CORRECCIÓN GENERAL DE SPAN
========================= */

.pt-navbar span,
.pt-page span,
.pt-admin-card span,
.pt-admin-table span,
.pt-header span,
.pt-user-text span,
.pt-user-info span {
    position: static !important;
    top: auto !important;
    right: auto !important;
    left: auto !important;
    bottom: auto !important;
    width: auto !important;
    height: auto !important;
    min-width: auto !important;
    max-width: none !important;
    line-height: inherit;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 900px) {
    .pt-admin-table {
        min-width: 980px;
    }
}

@media (max-width: 768px) {
    .pt-page {
        padding: 2rem 1rem;
    }

    .pt-container {
        padding: 0;
        max-width: 100%;
    }

    .pt-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .pt-header-actions {
        width: 100%;
    }

    .pt-btn {
        width: 100%;
    }

    .pt-admin-card {
        padding: 1rem;
        border-radius: 1.25rem;
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
        content: "Planta: ";
        font-weight: 900;
        color: #166534;
    }

    .pt-admin-table td:nth-child(2)::before {
        content: "Cuidado: ";
        font-weight: 900;
        color: #166534;
    }

    .pt-admin-table td:nth-child(3)::before {
        content: "Frecuencia: ";
        font-weight: 900;
        color: #166534;
    }

    .pt-admin-table td:nth-child(4)::before {
        content: "Instrucciones: ";
        font-weight: 900;
        color: #166534;
    }

    .pt-admin-table td:nth-child(5)::before {
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

    .pt-desktop-menu,
    .pt-user-menu {
        display: none !important;
    }

    .pt-mobile-btn {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    .pt-mobile-menu {
        display: block;
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