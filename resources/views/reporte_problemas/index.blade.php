<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-bold tracking-[0.25em] text-green-600 uppercase">
                Panel de administración
            </p>
            <h2 class="font-bold text-3xl text-gray-900 leading-tight mt-1">
                Reportes de problemas
            </h2>
            <p class="text-gray-500 mt-2">
                Consulta los problemas reportados por los usuarios y revisa su diagnóstico.
            </p>
        </div>
    </x-slot>

    <style>
        .reportes-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
        }

        .stat-card span {
            display: block;
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }

        .stat-card strong {
            font-size: 2rem;
            color: #143d2d;
        }

        .reportes-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .reportes-card-header {
            background: linear-gradient(135deg, #ecfdf5, #f7fee7);
            padding: 1.7rem 2rem;
            border-bottom: 1px solid #dbeafe;
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .reportes-card-header h3 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #143d2d;
            margin: 0;
        }

        .reportes-card-header p {
            color: #64748b;
            margin-top: 0.3rem;
        }

        .search-box {
            border: 1px solid #d1d5db;
            border-radius: 999px;
            padding: 0.7rem 1rem;
            min-width: 260px;
            outline: none;
        }

        .search-box:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
        }

        .reportes-table {
            width: 100%;
            border-collapse: collapse;
        }

        .reportes-table thead {
            background: #f0fdf4;
        }

        .reportes-table th {
            text-align: left;
            padding: 1.2rem 1.5rem;
            color: #1f2937;
            font-weight: 800;
            font-size: 0.95rem;
        }

        .reportes-table td {
            padding: 1.2rem 1.5rem;
            color: #334155;
            border-top: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .reportes-table tbody tr {
            transition: all 0.2s ease;
        }

        .reportes-table tbody tr:hover {
            background: #f8fafc;
        }

        .usuario-info,
        .planta-info,
        .problema-info {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .usuario-info strong,
        .planta-info strong,
        .problema-info strong {
            color: #111827;
            font-weight: 800;
        }

        .usuario-info span,
        .planta-info span,
        .problema-info span {
            color: #64748b;
            font-size: 0.85rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            font-weight: 800;
            font-size: 0.8rem;
        }

        .badge-leve {
            background: #dcfce7;
            color: #166534;
        }

        .badge-moderada {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-grave {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-revision {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-resuelto {
            background: #dcfce7;
            color: #166534;
        }

        .badge-pendiente {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .btn-ver {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #16a34a;
            color: white;
            padding: 0.65rem 1rem;
            border-radius: 999px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-ver:hover {
            background: #15803d;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(22, 163, 74, 0.25);
        }

        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #64748b;
        }

        @media (max-width: 900px) {
            .reportes-container {
                padding: 1rem;
            }

            .reportes-table,
            .reportes-table thead,
            .reportes-table tbody,
            .reportes-table th,
            .reportes-table td,
            .reportes-table tr {
                display: block;
            }

            .reportes-table thead {
                display: none;
            }

            .reportes-table tr {
                margin: 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 18px;
                overflow: hidden;
                background: white;
            }

            .reportes-table td {
                display: flex;
                justify-content: space-between;
                gap: 1rem;
                border-top: 1px solid #f1f5f9;
            }

            .reportes-table td::before {
                content: attr(data-label);
                font-weight: 800;
                color: #143d2d;
            }

            .search-box {
                width: 100%;
                min-width: 100%;
            }
        }
    </style>

    <div class="reportes-container">
        @php
            $totalReportes = $reportes->count();
            $totalResueltos = $reportes->where('estado', 'resuelto')->count();
            $totalRevision = $reportes->where('estado', 'en_revision')->count();
            $totalPendientes = $reportes->where('estado', 'pendiente')->count();
        @endphp

        <div class="stats-grid">
            <div class="stat-card">
                <span>Total de reportes</span>
                <strong>{{ $totalReportes }}</strong>
            </div>

            <div class="stat-card">
                <span>En revisión</span>
                <strong>{{ $totalRevision }}</strong>
            </div>

            <div class="stat-card">
                <span>Pendientes</span>
                <strong>{{ $totalPendientes }}</strong>
            </div>

            <div class="stat-card">
                <span>Resueltos</span>
                <strong>{{ $totalResueltos }}</strong>
            </div>
        </div>

        <div class="reportes-card">
            <div class="reportes-card-header">
                <div>
                    <h3>Problemas reportados</h3>
                    <p>Lista de reportes enviados por los usuarios.</p>
                </div>

                <input type="text" id="buscarReporte" class="search-box" placeholder="Buscar reporte...">
            </div>

            <div class="overflow-x-auto">
                <table class="reportes-table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Planta</th>
                            <th>Problema</th>
                            <th>Gravedad</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody id="tablaReportes">
                        @forelse($reportes as $reporte)
                            @php
                                $gravedad = strtolower($reporte->gravedad ?? 'leve');
                                $estado = strtolower($reporte->estado ?? 'pendiente');
                            @endphp

                            <tr>
                                <td data-label="Usuario">
                                    <div class="usuario-info">
                                        <strong>{{ $reporte->adopcion->usuario->name ?? 'Usuario no disponible' }}</strong>
                                        <span>{{ $reporte->adopcion->usuario->email ?? 'Sin correo' }}</span>
                                    </div>
                                </td>

                                <td data-label="Planta">
                                    <div class="planta-info">
                                        <strong>{{ $reporte->adopcion->planta->nombre ?? 'Planta no disponible' }}</strong>
                                        <span>{{ $reporte->adopcion->planta->especie ?? 'Sin especie' }}</span>
                                    </div>
                                </td>

                                <td data-label="Problema">
                                    <div class="problema-info">
                                        <strong>{{ $reporte->problema->nombre ?? 'Problema no disponible' }}</strong>
                                        <span>{{ Str::limit($reporte->descripcion ?? 'Sin descripción', 45) }}</span>
                                    </div>
                                </td>

                                <td data-label="Gravedad">
                                    <span class="badge 
                                        {{ $gravedad === 'grave' ? 'badge-grave' : '' }}
                                        {{ $gravedad === 'moderada' ? 'badge-moderada' : '' }}
                                        {{ $gravedad === 'leve' ? 'badge-leve' : '' }}">
                                        {{ ucfirst($reporte->gravedad ?? 'Leve') }}
                                    </span>
                                </td>

                                <td data-label="Estado">
                                    <span class="badge 
                                        {{ $estado === 'resuelto' ? 'badge-resuelto' : '' }}
                                        {{ $estado === 'en_revision' ? 'badge-revision' : '' }}
                                        {{ $estado === 'pendiente' ? 'badge-pendiente' : '' }}">
                                        {{ ucfirst(str_replace('_', ' ', $reporte->estado ?? 'pendiente')) }}
                                    </span>
                                </td>

                                <td data-label="Fecha">
                                    {{ $reporte->created_at ? $reporte->created_at->format('d/m/Y') : 'Sin fecha' }}
                                </td>

                                <td data-label="Acciones">
                                    <a href="{{ route('reporte-problemas.show', $reporte->id) }}" class="btn-ver">
                                        👁 Ver
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        No hay reportes de problemas registrados.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const buscarReporte = document.getElementById('buscarReporte');
        const filasReportes = document.querySelectorAll('#tablaReportes tr');

        if (buscarReporte) {
            buscarReporte.addEventListener('keyup', function () {
                const texto = this.value.toLowerCase();

                filasReportes.forEach(function (fila) {
                    const contenido = fila.textContent.toLowerCase();
                    fila.style.display = contenido.includes(texto) ? '' : 'none';
                });
            });
        }
    </script>
</x-app-layout>