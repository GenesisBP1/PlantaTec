<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Administración</p>
                <h2 class="pt-header-title">Gestión de Usuarios</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <x-admin-table 
                title="Gestión de Usuarios"
                subtitle="Panel de Administración"
                :createRoute="route('admin.usuarios.create')"
                createLabel="Crear Usuario"
                :columns="['Nombre', 'Email', 'Rol', 'Registro']"
                :rows="$tableUsuariosRows"
                :actions="$tableUsuariosActions"
                emptyMessage="No hay usuarios registrados"
            />

        </div>
    </div>

    <style>
        /* ============================================
           StarClass - Admin Table (Morado / Fucsia)
           Coherente con la app móvil
           ============================================ */

        :root {
            --primary: #7C3AED;
            --primary-dark: #6D28D9;
            --primary-light: #A78BFA;
            --secondary: #D946EF;
            --background: #F8F4FF;
            --card-bg: #FFFFFF;
            --text-dark: #1E1B2E;
            --text-gray: #6B7280;
            --border: #E9E8F0;
            --success: #10B981;
            --warning: #F59E0B;
            --error: #EF4444;
        }

        .pt-page {
            background-color: var(--background);
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .pt-container {
            max-width: 80rem;
            margin-left: auto;
            margin-right: auto;
        }

        .pt-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary), var(--secondary));
            padding: 1.5rem 2rem;
            border-bottom-left-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .pt-header-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 600;
            opacity: 0.8;
            margin-bottom: 0.25rem;
        }

        .pt-header-title {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0;
        }

        /* Estilos para el componente x-admin-table (suponiendo una estructura HTML estándar) */
        .admin-table-card {
            background: var(--card-bg);
            border-radius: 1.5rem;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .admin-table-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            background-color: var(--card-bg);
        }

        .admin-table-title h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .admin-table-title p {
            color: var(--text-gray);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .admin-table-create-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .admin-table-create-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(124, 58, 237, 0.2);
        }

        table.admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        table.admin-table thead {
            background-color: #F9F7FF;
        }

        table.admin-table th {
            text-align: left;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: var(--primary);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border);
        }

        table.admin-table td {
            padding: 1rem 1.5rem;
            color: var(--text-dark);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        /* Botones de acción (editar, eliminar) */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .action-edit {
            background-color: #FEF3C7;
            color: #D97706;
        }

        .action-edit:hover {
            background-color: #FDE68A;
            transform: scale(1.05);
        }

        .action-delete {
            background-color: #FEE2E2;
            color: #DC2626;
        }

        .action-delete:hover {
            background-color: #FECACA;
            transform: scale(1.05);
        }

        /* Paginación y mensaje vacío */
        .admin-table-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
            background-color: #F9F7FF;
        }

        .empty-message {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-gray);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-table-header {
                flex-direction: column;
                align-items: stretch;
            }
            table.admin-table,
            table.admin-table thead,
            table.admin-table tbody,
            table.admin-table th,
            table.admin-table td,
            table.admin-table tr {
                display: block;
            }
            table.admin-table thead {
                display: none;
            }
            table.admin-table tr {
                margin-bottom: 1rem;
                border: 1px solid var(--border);
                border-radius: 1rem;
                padding: 0.5rem;
            }
            table.admin-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: none;
                padding: 0.75rem;
            }
            table.admin-table td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--primary);
                width: 40%;
            }
            .action-buttons {
                justify-content: flex-end;
            }
        }
    </style>
</x-app-layout>