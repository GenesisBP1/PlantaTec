<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de adopción
        </h2>
    </x-slot>

    <style>
        /* ============================================
           Estilos para la vista detalle (coherentes con el catálogo)
           ============================================ */
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;600;700;800&display=swap');

        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --verde-muy-claro: #f4fbf2;
            --gris-verde: #6f8f7a;
            --blanco: #ffffff;
            --sombra-suave: 0 12px 28px rgba(0, 32, 0, 0.08);
            --sombra-elevada: 0 20px 35px rgba(0, 0, 0, 0.12);
            --border-radius-card: 28px;
            --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .detalle-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 1rem;
        }

        .card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            box-shadow: var(--sombra-elevada);
            overflow: hidden;
            margin-bottom: 2rem;
            border: 1px solid rgba(100, 140, 110, 0.2);
        }

        .card-header {
            background: linear-gradient(115deg, var(--verde-claro), #eef5ea);
            padding: 1.2rem 2rem;
            border-bottom: 1px solid rgba(75, 130, 90, 0.2);
        }

        .card-header h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--verde-profundo);
            margin: 0;
        }

        .card-body {
            padding: 2rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-item {
            background: var(--verde-muy-claro);
            padding: 0.8rem 1rem;
            border-radius: 20px;
        }

        .info-item strong {
            color: var(--verde-medio);
            display: block;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .info-item span {
            font-weight: 600;
            font-size: 1rem;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .btn-primary {
            background: linear-gradient(105deg, var(--verde-medio), #3e8a5a);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 60px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: scale(0.97);
            box-shadow: 0 8px 18px rgba(43, 120, 64, 0.3);
        }

        .btn-danger {
            background: linear-gradient(105deg, #dc2626, #b91c1c);
        }

        .tabla-cuidados {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-cuidados th,
        .tabla-cuidados td {
            padding: 0.8rem;
            text-align: left;
            border-bottom: 1px solid #e2ecd9;
        }

        .tabla-cuidados th {
            background: var(--verde-claro);
            font-weight: 700;
            color: var(--verde-profundo);
        }

        .badge-estado {
            display: inline-block;
            padding: 0.2rem 0.8rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-activo { background: #fee2e2; color: #b91c1c; }
        .badge-revision { background: #fef3c7; color: #b45309; }
        .badge-resuelto { background: #dcfce7; color: #15803d; }

        @media (max-width: 768px) {
            .card-body { padding: 1.2rem; }
            .tabla-cuidados, .tabla-cuidados thead, .tabla-cuidados tbody, .tabla-cuidados tr, .tabla-cuidados td, .tabla-cuidados th {
                display: block;
            }
            .tabla-cuidados tr { margin-bottom: 1rem; border: 1px solid #e2ecd9; border-radius: 20px; padding: 0.5rem; }
            .tabla-cuidados td { border: none; padding: 0.3rem 0.5rem; }
            .tabla-cuidados th { display: none; }
        }
    </style>

    <div class="py-8">
        <div class="detalle-container">

            {{-- Tarjeta de información de la planta y adopción --}}
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-leaf"></i> {{ $adopcion->planta->nombre }}</h3>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <strong>Especie</strong>
                            <span>{{ $adopcion->planta->especie }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Estado adopción</strong>
                            <span>{{ ucfirst($adopcion->estado_adopcion) }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Ubicación</strong>
                            <span>{{ $adopcion->ubicacion->nombre_lugar ?? 'No registrada' }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Fecha adopción</strong>
                            <span>{{ \Carbon\Carbon::parse($adopcion->fecha_adopcion)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <p><strong>Descripción:</strong> {{ $adopcion->planta->descripcion ?? 'Sin descripción.' }}</p>

                    <div class="btn-group">
                        <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id]) }}" class="btn-primary">
                            <i class="fas fa-camera"></i> Registrar cuidado general
                        </a>
                        <a href="{{ route('reporte-problemas.create', ['adopcion_id' => $adopcion->id]) }}" class="btn-primary btn-danger">
                            <i class="fas fa-exclamation-triangle"></i> Reportar problema
                        </a>
                    </div>
                </div>
            </div>

            {{-- 📅 Plan de cuidados (itinerario) --}}
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-calendar-alt"></i> 📋 Plan de cuidados</h3>
                </div>
                <div class="card-body">
                    @php
                        $cuidadosAsignados = $adopcion->planta->plantaCuidados;
                    @endphp

                    @if($cuidadosAsignados->count())
                        <table class="tabla-cuidados">
                            <thead>
                                <tr><th>Cuidado</th><th>Frecuencia</th><th>Próxima fecha sugerida</th><th>Registrar</th></tr>
                            </thead>
                            <tbody>
                                @foreach($cuidadosAsignados as $pc)
                                    @php
                                        $ultimoRegistro = $adopcion->registrosCuidados()
                                            ->where('id_planta_cuidado', $pc->id)
                                            ->latest()
                                            ->first();

                                        if ($ultimoRegistro) {
                                            $proximaFecha = \Carbon\Carbon::parse($ultimoRegistro->fecha)->addDays($pc->frecuencia);
                                        } else {
                                            $proximaFecha = \Carbon\Carbon::parse($adopcion->fecha_adopcion)->addDays($pc->frecuencia);
                                        }
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $pc->cuidado->nombre }}</strong><br><small class="text-gray-500">{{ $pc->instrucciones_esp ?? 'Sin instrucciones adicionales' }}</small></td>
                                        <td>Cada {{ $pc->frecuencia }} días</td>
                                        <td>{{ $proximaFecha->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id, 'cuidado_id' => $pc->id]) }}" 
                                               class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                                <i class="fas fa-check-circle"></i> Registrar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">No hay cuidados asignados a esta planta.</p>
                    @endif
                </div>
            </div>

            {{-- 📜 Historial de cuidados realizados --}}
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-history"></i> Historial de cuidados</h3>
                </div>
                <div class="card-body">
                    @forelse($adopcion->registrosCuidados as $registro)
                        <div class="border-b border-gray-100 py-3 flex flex-wrap gap-3 items-start">
                            <div class="flex-1">
                                {{-- CORRECIÓN 1: parse() para evitar error si fecha es string --}}
                                <p>
                                    <strong>{{ $registro->plantaCuidado->cuidado->nombre }}</strong>
                                    – {{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y H:i') }}
                                </p>
                                <p class="text-gray-600 text-sm">{{ $registro->descripcion ?? 'Sin descripción' }}</p>
                                @if($registro->estado_observado)
                                    <p class="text-xs text-gray-500">Estado observado: {{ $registro->estado_observado }}</p>
                                @endif
                            </div>
                            @if($registro->imagen)
                                {{-- CORRECCIÓN 2: asset en lugar de Storage::url --}}
                                <div>
                                    <img src="{{ asset('storage/' . $registro->imagen) }}"
                                         class="w-24 h-24 object-cover rounded-lg shadow"
                                         alt="Imagen del cuidado">
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">Aún no se han registrado cuidados.</p>
                    @endforelse
                </div>
            </div>

            {{-- ⚠️ Problemas reportados --}}
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-bug"></i> Problemas reportados</h3>
                </div>
                <div class="card-body">
                    @forelse($adopcion->reportesProblemas as $reporte)
                        <div class="border-b border-gray-100 py-3">
                            <p>
                                <strong>{{ $reporte->problema->nombre }}</strong>
                                <span class="badge-estado
                                    @if($reporte->estado === 'activo') badge-activo
                                    @elseif($reporte->estado === 'en_revision') badge-revision
                                    @else badge-resuelto @endif">
                                    {{ ucfirst($reporte->estado) }}
                                </span>
                            </p>
                            <p>Gravedad: {{ ucfirst($reporte->gravedad) }}</p>
                            <p>{{ $reporte->descripcion ?? 'Sin descripción' }}</p>
                            <div class="mt-2">
                                <a href="{{ route('reporte-problemas.show', $reporte) }}" class="text-blue-600 text-sm hover:underline">Ver diagnóstico</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No hay problemas reportados.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @endpush
</x-app-layout>