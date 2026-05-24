<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Cuidados por planta</p>
                <h2 class="pt-header-title">Gestión de asignaciones</h2>
                <p class="pt-header-subtitle">Panel de administración</p>
            </div>
            <div class="pt-header-actions">
                <a href="{{ route('planta-cuidados.create') }}" class="pt-btn pt-btn-green">+ Asignar cuidado</a>
            </div>
        </div>
    </x-slot>

    <style>
      * {
    box-sizing: border-box;
}

.pt-page {
    padding: 2.5rem 0 3.5rem;
    background: #f6f8f5;
    min-height: calc(100vh - 80px);
}

.pt-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* HEADER */

.pt-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.pt-header-label {
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #16a34a;
    margin: 0 0 0.25rem;
}

.pt-header-title {
    font-size: 1.5rem;
    font-weight: 900;
    color: #111827;
    line-height: 1.2;
    margin: 0;
}

.pt-header-subtitle {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 0.25rem 0 0;
}

.pt-header-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

/* BOTÓN PRINCIPAL */

.pt-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.65rem 1rem;
    border-radius: 0.9rem;
    font-size: 0.875rem;
    font-weight: 800;
    text-decoration: none;
    transition: 0.2s ease;
    border: none;
    cursor: pointer;
    font-family: inherit;
}

.pt-btn-green {
    background: #16a34a;
    color: #ffffff;
}

.pt-btn-green:hover {
    background: #15803d;
    transform: translateY(-1px);
}

/* CARD ADMIN */

.pt-admin-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 1.5rem;
    box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
    overflow: hidden;
    padding: 1.5rem;
}

/* TABLA */

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
    font-size: 0.8rem;
    font-weight: 900;
    color: #166534;
    border-bottom: 1px solid #d1fae5;
    white-space: nowrap;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.pt-admin-table td {
    padding: 1rem;
    font-size: 0.875rem;
    color: #374151;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: middle;
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

/* ACCIONES */

.pt-table-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.pt-table-actions form {
    margin: 0;
    display: inline-flex;
}

.pt-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid transparent;
    border-radius: 999px;
    padding: 0.45rem 0.8rem;
    font-size: 0.78rem;
    font-weight: 800;
    text-decoration: none;
    cursor: pointer;
    transition: 0.2s ease;
    font-family: inherit;
    line-height: 1;
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

/* ESTADO VACÍO */

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

/* PAGINACIÓN DE LARAVEL */
.pt-nav {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
    background: #ffffff;
}
.pt-admin-card nav {
    margin-top: 1.5rem;
}

.pt-admin-card nav .flex {
    align-items: center;
}

.pt-admin-card nav a,
.pt-admin-card nav span {
    border-radius: 0.65rem !important;
    font-size: 0.85rem;
}

.pt-admin-card nav a:hover {
    background: #f0fdf4 !important;
    color: #15803d !important;
}

/* SPAN GENERAL PARA QUE NO FLOTE NI SE DESACOMODE */

.pt-admin-card span,
.pt-admin-table span,
.pt-header span {
    position: static !important;
    top: auto !important;
    right: auto !important;
    min-width: auto;
    height: auto;
}

/* RESPONSIVE */

@media (max-width: 768px) {
    .pt-page {
        padding: 2rem 0;
    }

    .pt-container {
        padding: 0 1rem;
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
        border-radius: 1.2rem;
    }

    .pt-admin-table,
    .pt-admin-table thead,
    .pt-admin-table tbody,
    .pt-admin-table tr,
    .pt-admin-table td,
    .pt-admin-table th {
        display: block;
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
        padding: 0.45rem 0;
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
}
/* =========================
   CORRECCIÓN NAV
========================= */

.pt-navbar {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 50;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
}

.pt-nav-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1rem;
}
.pt-nav-link {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.6rem 0.85rem;
    border-radius: 0.75rem;
    color: #374151;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 700;
    border: none;
    background: transparent;
    cursor: pointer;
    font-family: inherit;
    transition: 0.2s ease;
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
    color: #000000;
    font-size: 1.25rem;
    font-weight: 900;
}

.pt-logo-icon {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    background: #15803d;
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
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.6rem 0.85rem;
    border-radius: 0.75rem;
    color: #000000;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 700;
    border: none;
    background: transparent;
    cursor: pointer;
    font-family: inherit;
    transition: 0.2s ease;
}

.pt-logo-icon {
    width: 34px;
    height: 34px;
    border-radius: 0.9rem;
    background: linear-gradient(135deg, #16a34a, #047857);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pt-nav-link:hover,
.pt-nav-link.active {
    background: rgba(255,255,255,0.16);
    color: #ffffff;
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
    box-shadow: 0 16px 32px rgba(0,0,0,0.14);
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
    color: #374151;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    background: transparent;
    border: none;
    text-align: left;
    cursor: pointer;
    font-family: inherit;
}

.pt-dropdown-menu a:hover,
.pt-user-dropdown a:hover,
.pt-user-dropdown button:hover {
    background: #f3e8ff;
    color: #7e22ce;
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
    background: transparent;
    border: none;
    cursor: pointer;
    font-family: inherit;
    color: #ffffff;
}

.pt-user-btn:hover {
    background: rgba(255,255,255,0.16);
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
    color: #ffffff;
    font-size: 0.875rem;
    font-weight: 800;
}

.pt-user-text span {
    display: block;
    color: rgba(255,255,255,0.8);
    font-size: 0.75rem;
    line-height: 1.2;
}

.pt-user-arrow {
    color: #ffffff;
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
    font-weight: 800;
    color: #111827;
}

.pt-user-info span {
    display: block;
    color: #6b7280;
    font-size: 0.75rem;
    overflow: hidden;
    text-overflow: ellipsis;
}

.pt-mobile-btn {
    display: none;
    border: none;
    background: rgba(255,255,255,0.18);
    color: #ffffff;
    width: 40px;
    height: 40px;
    border-radius: 0.75rem;
    font-size: 1.4rem;
    cursor: pointer;
    font-family: inherit;
}

.pt-mobile-menu {
    display: none;
    background: #ffffff;
    border-top: 1px solid #e5e7eb;
    padding: 0.75rem 1rem;
}

.pt-mobile-menu a,
.pt-mobile-menu button {
    display: block;
    width: 100%;
    padding: 0.75rem;
    border-radius: 0.75rem;
    color: #374151;
    text-decoration: none;
    font-weight: 700;
    border: none;
    background: transparent;
    text-align: left;
    font-family: inherit;
}

.pt-mobile-menu a:hover,
.pt-mobile-menu a.active,
.pt-mobile-menu button:hover {
    background: #f3e8ff;
    color: #7e22ce;
}
/* =========================
   CORRECCIÓN SPAN
========================= */
p{
    color: black !important;
    position: static !important;
    top: auto !important;
    right: auto !important;
    left: auto !important;
    bottom: auto !important;
    width: auto !important;
    height: auto !important;
    min-width: auto !important;
    max-width: none !important;
    display: block;
    font-size: inherit;
    line-height: inherit;
}
span {
    color: black !important;
    position: static !important;
    top: auto !important;
    right: auto !important;
    left: auto !important;
    bottom: auto !important;
    width: auto !important;
    height: auto !important;
    min-width: auto !important;
    max-width: none !important;
    display: inline;
    font-size: inherit;
    line-height: inherit;
}
.pt-page span,
.pt-admin-card span,
.pt-admin-table span,
.pt-header span,
.pt-card span {
    position: static !important;
    top: auto !important;
    right: auto !important;
    left: auto !important;
    bottom: auto !important;
    width: auto !important;
    height: auto !important;
    min-width: auto !important;
    max-width: none !important;
    display: inline;
    font-size: inherit;
    line-height: inherit;
}

.pt-badge,
.pt-status-badge,
.pt-nav-badge {
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    width: auto !important;
    height: auto !important;
    min-width: auto !important;
    position: static !important;
    border-radius: 999px;
    line-height: 1;
}
/* =========================
   CORRECCIÓN PAGINACIÓN
========================= */

.pt-admin-card nav,
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
    background: #16a34a !important;
    color: #ffffff !important;
    border-color: #16a34a !important;
}

.pt-admin-card nav[role="navigation"] p,
.pt-page nav[role="navigation"] p {
    margin: 0 !important;
    color: #6b7280 !important;
    font-size: 0.875rem !important;
}

/* Oculta el texto largo de Laravel si estorba */
.pt-admin-card nav[role="navigation"] .hidden,
.pt-page nav[role="navigation"] .hidden {
    display: none !important;
}
    </style>

    <div class="pt-page">
        <div class="pt-container">
            <div class="pt-admin-card">
                <div class="pt-admin-table-wrapper">
                    <table class="pt-admin-table">
                        <thead>
                            <tr>
                                <th>Planta</th>
                                <th>Cuidado</th>
                                <th>Frecuencia</th>
                                <th>Instrucciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($asignaciones as $asignacion)
                                <tr>
                                    <td>{{ $asignacion->planta->nombre ?? 'Sin planta' }}</td>
                                    <td>{{ $asignacion->cuidado->nombre ?? 'Sin cuidado' }}</td>
                                    <td>{{ $asignacion->frecuencia }} días</td>
                                    <td>{{ Str::limit($asignacion->instrucciones_esp, 60) }}</td>
                                    <td class="pt-table-actions">
                                        <a href="{{ route('planta-cuidados.show', $asignacion) }}" class="pt-action-btn view">Ver</a>
                                        <a href="{{ route('planta-cuidados.edit', $asignacion) }}" class="pt-action-btn edit">Editar</a>
                                        <form action="{{ route('planta-cuidados.destroy', $asignacion) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pt-action-btn delete" onclick="return confirm('¿Eliminar esta asignación?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="pt-empty center">No hay cuidados asignados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $asignaciones->links() }}
            </div>
        </div>
    </div>
</x-app-layout>