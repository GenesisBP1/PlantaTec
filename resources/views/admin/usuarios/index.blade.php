<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Administración</p>
                <h2 class="pt-header-title">Gestión de usuarios</h2>
                <p class="pt-header-subtitle">Consulta adopciones, cuidados y problemas de cada usuario</p>
            </div>
            <div class="pt-header-actions">
                <a href="{{ route('dashboard') }}" class="pt-btn pt-btn-light">Volver al Dashboard</a>
            </div>
        </div>
    </x-slot>

    <style>
        /* ========== MEJORAS EXCLUSIVAS PARA ESTA VISTA ========== */
        /* Mayor espaciado entre cards y elementos */
        .pt-card {
            margin-bottom: 2rem;
            transition: all 0.2s ease;
        }
        .pt-card-header {
            border-bottom: 1px solid #eef2ee;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .pt-table th, .pt-table td {
            padding: 1rem 0.85rem;
        }
        .pt-table tbody tr {
            transition: background 0.15s;
        }
        .pt-small-btn {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        /* Mejora del buscador */
        .pt-card .pt-card-body form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-end;
            padding: 0;
        }
        .pt-card .pt-card-body label {
            font-weight: 700;
            font-size: 0.8rem;
            margin-bottom: 0.25rem;
            display: block;
            color: #2b5e3b;
        }
        .pt-form-control {
            width: 100%;
            min-width: 220px;
            padding: 0.7rem 1rem;
            border-radius: 1rem;
            border: 1px solid #cde0d4;
            transition: all 0.2s;
        }
        .pt-form-control:focus {
            border-color: #2b7840;
            outline: none;
            box-shadow: 0 0 0 3px rgba(43,120,64,0.1);
        }

        /* Modal mejorado: más grande y mejor organizado */
        .modal-resumen {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            backdrop-filter: blur(6px);
            align-items: center;
            justify-content: center;
        }
        .modal-resumen .modal-content {
            background: #ffffff;
            border-radius: 2rem;
            width: 90%;
            max-width: 950px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 30px 50px rgba(0,0,0,0.3);
            animation: fadeInUp 0.3s ease;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .modal-header {
            background: linear-gradient(115deg, #e2f0e6, #c8e0d0);
            padding: 1.2rem 1.8rem;
            border-radius: 2rem 2rem 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #cde0d4;
        }
        .modal-header h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e3a2f;
            margin: 0;
        }
        .close-modal {
            font-size: 2rem;
            cursor: pointer;
            color: #1e3a2f;
            transition: 0.2s;
            line-height: 1;
        }
        .close-modal:hover {
            color: #dc2626;
            transform: scale(1.1);
        }
        .modal-body {
            padding: 1.8rem;
        }
        .loading {
            text-align: center;
            padding: 3rem;
            font-size: 1.1rem;
            color: #2b7840;
        }
        /* Tarjeta de adopción dentro del modal */
        .tarjeta-adopcion {
            background: #fefdf8;
            border-radius: 1.2rem;
            padding: 1.2rem;
            margin-bottom: 1.2rem;
            border-left: 5px solid #2b7840;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: 0.2s;
        }
        .tarjeta-adopcion:hover {
            transform: translateX(4px);
            background: #f9faf7;
        }
        .tarjeta-adopcion strong {
            font-size: 1.1rem;
            color: #1e3a2f;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .estado-adopcion {
            display: inline-block;
            background: #dcfce7;
            color: #15803d;
            padding: 0.2rem 0.8rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 800;
            margin-left: 0.8rem;
        }
        .badge-activa {
            background: #dcfce7;
            color: #15803d;
        }
        .badge-cancelada {
            background: #fee2e2;
            color: #b91c1c;
        }
        .grid-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.8rem;
            margin: 0.8rem 0;
            background: #f1f5ef;
            padding: 0.8rem;
            border-radius: 1rem;
        }
        .info-item {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .info-item .label {
            font-weight: 800;
            color: #2b5e3b;
            font-size: 0.75rem;
            text-transform: uppercase;
        }
        .info-item .value {
            font-size: 0.9rem;
            color: #1f2937;
            font-weight: 500;
        }
        .problema-item {
            background: #fff5f0;
            border-left: 3px solid #e07c3c;
            border-radius: 0.8rem;
            padding: 0.6rem 1rem;
            margin-top: 0.8rem;
            font-size: 0.85rem;
        }
        .problema-item strong {
            color: #c2410c;
            font-size: 0.8rem;
        }
        .pt-badge.sin-problemas {
            background: #e6f4ea;
            color: #2e7d32;
        }
        hr {
            margin: 1rem 0;
            border-color: #e2ecd9;
        }
        .empty-mensaje {
            text-align: center;
            padding: 2rem;
            color: #6f8f7a;
        }
        /* Paginación más amigable */
        .pt-pagination {
            margin-top: 1.5rem;
            display: flex;
            justify-content: flex-end;
        }
        .pt-pagination nav {
            display: inline-flex;
            gap: 0.3rem;
        }
        .pt-pagination .page-link {
            padding: 0.5rem 0.9rem;
            border-radius: 0.7rem;
            background: #fff;
            border: 1px solid #e2ecd9;
            color: #374151;
            font-weight: 600;
        }
        .pt-pagination .active .page-link {
            background: #2b7840;
            border-color: #2b7840;
            color: white;
        }
        @media (max-width: 768px) {
            .modal-resumen .modal-content {
                width: 95%;
                max-height: 90vh;
            }
            .modal-header h3 {
                font-size: 1.3rem;
            }
            .grid-info {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
            .pt-card .pt-card-body form {
                flex-direction: column;
                align-items: stretch;
            }
            .pt-table, .pt-table thead, .pt-table tbody, .pt-table tr, .pt-table td, .pt-table th {
                display: block;
            }
            .pt-table thead {
                display: none;
            }
            .pt-table tr {
                margin-bottom: 1rem;
                border: 1px solid #e2ecd9;
                border-radius: 1rem;
                padding: 0.75rem;
            }
            .pt-table td {
                border: none;
                padding: 0.4rem 0;
                display: flex;
                gap: 0.75rem;
                align-items: flex-start;
            }
            .pt-table td::before {
                content: attr(data-label);
                font-weight: 800;
                color: #2b7840;
                width: 110px;
                flex-shrink: 0;
            }
            .pt-table td:last-child::before {
                content: "Acciones";
            }
            .pt-pagination {
                justify-content: center;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container">

            <!-- Buscador (más espaciado) -->
            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Filtrar usuarios</h3>
                </div>
                <div class="pt-card-body">
                    <form method="GET" action="{{ route('admin.usuarios.index') }}">
                        <div style="flex: 2; min-width: 200px;">
                            <label for="search">Nombre o correo electrónico</label>
                            <input type="text" id="search" name="search" value="{{ $search }}" class="pt-form-control" placeholder="Ej: Ana, ana@ejemplo.com">
                        </div>
                        <div style="display: flex; gap: 0.8rem; align-items: flex-end;">
                            <button type="submit" class="pt-btn pt-btn-green"> Buscar</button>
                            @if($search)
                                <a href="{{ route('admin.usuarios.index') }}" class="pt-btn pt-btn-light">✖ Limpiar</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lista de usuarios (tabla mejorada con data-label) -->
            <div class="pt-card">
                <div class="pt-card-header">
                    <div>
                        <h3 class="pt-card-title">Usuarios registrados</h3>
                        <p class="pt-card-subtitle">Haz clic en "Ver resumen" para ver detalles de cada usuario</p>
                    </div>
                    <span class="pt-badge green">{{ $usuarios->total() }} total</span>
                </div>
                <div class="pt-card-body">
                    <div class="pt-table-wrapper">
                        <table class="pt-table">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Adopciones</th>
                                    <th>Cuidados</th>
                                    <th>Problemas activos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($usuarios as $usuario)
                                    <tr>
                                        <td data-label="Usuario">
                                            <strong>{{ $usuario->name }}</strong>
                                            <br><span class="pt-muted">ID: {{ $usuario->id }}</span>
                                        </td>
                                        <td data-label="Email">{{ $usuario->email }}</td>
                                        <td data-label="Adopciones">{{ $usuario->total_adopciones }}</td>
                                        <td data-label="Cuidados">{{ $usuario->total_cuidados }}</td>
                                        <td data-label="Problemas activos">
                                            @if($usuario->problemas_activos > 0)
                                                <span class="pt-badge" style="background:#fee2e2; color:#b91c1c;">{{ $usuario->problemas_activos }}</span>
                                            @else
                                                <span class="pt-muted">—</span>
                                            @endif
                                        </td>
                                        <td data-label="Acciones">
                                            <button class="pt-small-btn green ver-resumen" data-id="{{ $usuario->id }}" data-name="{{ $usuario->name }}">
                                                  Resumen
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="pt-empty center">No hay usuarios registrados.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="pt-pagination">
                        {{ $usuarios->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal de resumen mejorado -->
    <div id="modalResumen" class="modal-resumen">
        <div class="modal-content">
            <div class="modal-header">
                <h3>📋 Resumen completo del usuario</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body" id="modalBodyResumen">
                <div class="loading">
                    <div class="pt-welcome-spinner" style="margin: 0 auto 1rem;"></div>
                    Cargando información...
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.ver-resumen').forEach(btn => {
            btn.addEventListener('click', async function() {
                const userId = this.dataset.id;
                const userName = this.dataset.name;
                const modal = document.getElementById('modalResumen');
                const modalBody = document.getElementById('modalBodyResumen');
                modalBody.innerHTML = '<div class="loading"><div class="pt-welcome-spinner" style="margin: 0 auto 1rem;"></div>Cargando adopciones de ' + userName + '...</div>';
                modal.style.display = 'flex';

                try {
                    const response = await fetch(`/admin/usuarios/${userId}/resumen`);
                    const data = await response.json();
                    if (response.ok) {
                        let html = `
                            <div style="margin-bottom: 1.5rem;">
                                <h4 style="font-size: 1.3rem; font-weight: 800; color: #1e3a2f;">${data.usuario}</h4>
                                <p class="pt-muted" style="margin-top: 0.2rem;">📧 ${data.email}</p>
                            </div>
                            <hr>
                        `;
                        if (data.adopciones.length === 0) {
                            html += '<div class="empty-mensaje"><p> Este usuario aún no ha adoptado ninguna planta.</p></div>';
                        } else {
                            data.adopciones.forEach(adop => {
                                const estadoClase = adop.estado_adopcion === 'activa' ? 'badge-activa' : 'badge-cancelada';
                                const estadoTexto = adop.estado_adopcion === 'activa' ? ' Activa' : ' Cancelada';
                                const fechaAdop = new Date(adop.fecha_adopcion.split('/').reverse().join('-')).toLocaleDateString('es-ES');
                                html += `
                                    <div class="tarjeta-adopcion">
                                        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
                                            <strong> ${adop.planta_nombre}</strong>
                                            <span class="estado-adopcion ${estadoClase}">${estadoTexto}</span>
                                        </div>
                                        <div class="grid-info">
                                            <div class="info-item">
                                                <span class="label"> Adoptada:</span>
                                                <span class="value">${adop.fecha_adopcion}</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="label"> Cuidados registrados:</span>
                                                <span class="value">${adop.total_cuidados}</span>
                                            </div>
                                            ${adop.ultimo_cuidado ? `
                                            <div class="info-item">
                                                <span class="label"> Último cuidado:</span>
                                                <span class="value">${new Date(adop.ultimo_cuidado.fecha).toLocaleDateString('es-ES')}</span>
                                            </div>
                                            ` : ''}
                                        </div>
                                        ${adop.problemas_activos.length ? `
                                            <div class="problema-item">
                                                <strong> Problemas activos (${adop.problemas_activos.length})</strong>
                                                <ul style="margin: 0.5rem 0 0 1.2rem;">
                                                    ${adop.problemas_activos.map(p => `<li>${p.problema?.nombre || 'Sin nombre'} — Gravedad: <strong>${p.gravedad}</strong> (${p.estado})</li>`).join('')}
                                                </ul>
                                            </div>
                                        ` : '<div style="margin-top: 0.8rem;"><span class="pt-badge sin-problemas"> Sin problemas activos</span></div>'}
                                    </div>
                                `;
                            });
                        }
                        modalBody.innerHTML = html;
                    } else {
                        modalBody.innerHTML = '<div class="pt-alert-error" style="padding: 1rem;">❌ Error al cargar los datos. Intenta de nuevo.</div>';
                    }
                } catch (error) {
                    modalBody.innerHTML = '<div class="pt-alert-error" style="padding: 1rem;">❌ Error de conexión. Verifica tu internet.</div>';
                }
            });
        });

        // Cerrar modal
        const modal = document.getElementById('modalResumen');
        document.querySelector('.close-modal').onclick = () => modal.style.display = 'none';
        window.onclick = (event) => { if (event.target === modal) modal.style.display = 'none'; };
    </script>
</x-app-layout>