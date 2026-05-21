<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de adopción
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;600;700;800&display=swap');

        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --verde-muy-claro: #f4fbf2;
            --gris-verde: #6f8f7a;
            --blanco: #ffffff;
            --sombra-elevada: 0 20px 35px rgba(0, 0, 0, 0.12);
            --border-radius-card: 28px;
            --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .detalle-container {
            max-width: 1200px;
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
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(115deg, var(--verde-claro), #eef5ea);
            padding: 1.2rem 2rem;
            border-bottom: 1px solid rgba(75, 130, 90, 0.2);
        }

        .card-header h3 {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--verde-profundo);
            margin: 0;
            letter-spacing: -0.3px;
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
            border-left: 3px solid var(--verde-medio);
        }

        .info-item strong {
            color: var(--verde-medio);
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-item span {
            font-weight: 600;
            font-size: 1rem;
            color: var(--verde-profundo);
        }

        .detalle-flex {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: flex-start;
        }

        .detalle-imagen {
            flex: 0 0 240px;
            background: var(--verde-claro);
            border-radius: 1.5rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .detalle-imagen img {
            width: 100%;
            max-height: 220px;
            object-fit: contain;
            border-radius: 1rem;
        }

        .detalle-info {
            flex: 1;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
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
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
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
            vertical-align: top;
        }

        .tabla-cuidados th {
            background: var(--verde-claro);
            font-weight: 700;
            color: var(--verde-profundo);
            font-size: 0.85rem;
            text-transform: uppercase;
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

        .btn-diagnostico {
            display: inline-block;
            background: #16a34a;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-diagnostico:hover {
            background: #15803d;
            transform: translateY(-1px);
        }

        .btn-registrar {
            background: var(--verde-medio);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            display: inline-block;
        }

        .btn-registrar:hover {
            background: #1e5a32;
        }

        @media (max-width: 768px) {
            .card-body { padding: 1.2rem; }
            .card-header h3 { font-size: 1.3rem; }
            .detalle-imagen { flex-basis: 100%; text-align: center; }

            .tabla-cuidados,
            .tabla-cuidados thead,
            .tabla-cuidados tbody,
            .tabla-cuidados tr,
            .tabla-cuidados td,
            .tabla-cuidados th {
                display: block;
            }

            .tabla-cuidados tr {
                margin-bottom: 1rem;
                border: 1px solid #e2ecd9;
                border-radius: 20px;
                padding: 0.5rem;
            }

            .tabla-cuidados td {
                border: none;
                padding: 0.3rem 0.5rem;
            }

            .tabla-cuidados th {
                display: none;
            }
        }
    </style>

    <div class="py-8">
        <div class="detalle-container">

            {{-- Tarjeta de información de la planta y adopción con imagen --}}
            <div class="card">
                <div class="card-header">
                    <h3>{{ $adopcion->planta->nombre }}</h3>
                </div>

                <div class="card-body">
                    <div class="detalle-flex">
                        <div class="detalle-imagen">
                            @php
                                $imagenUrl = 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&fit=crop';
                                if ($adopcion->planta->imagen) {
                                    if (filter_var($adopcion->planta->imagen, FILTER_VALIDATE_URL)) {
                                        $imagenUrl = $adopcion->planta->imagen;
                                    } elseif (file_exists(public_path('storage/' . $adopcion->planta->imagen))) {
                                        $imagenUrl = asset('storage/' . $adopcion->planta->imagen);
                                    }
                                }
                            @endphp
                            <img src="{{ $imagenUrl }}" alt="{{ $adopcion->planta->nombre }}">
                        </div>

                        <div class="detalle-info">
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

                            <p class="text-gray-700 leading-relaxed">
                                <strong class="text-gray-900">Descripción:</strong>
                                {{ $adopcion->planta->descripcion ?? 'Sin descripción.' }}
                            </p>

                            <div class="btn-group">
                                <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id]) }}" class="btn-primary">
                                    Registrar cuidado general
                                </a>
                                <a href="{{ route('reporte-problemas.create', ['adopcion_id' => $adopcion->id]) }}" class="btn-primary btn-danger">
                                    Reportar problema
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Plan de cuidados (CORREGIDO) --}}
            <div class="card">
                <div class="card-header">
                    <h3>Plan de cuidados</h3>
                </div>

                <div class="card-body">
                    @php
                        $cuidadosAsignados = $adopcion->planta->plantaCuidados;
                    @endphp

                    @if($cuidadosAsignados->count())
                        <table class="tabla-cuidados">
                            <thead>
                                <tr>
                                    <th>Cuidado</th>
                                    <th>Frecuencia</th>
                                    <th>Próxima fecha sugerida</th>
                                    <th>Registrar</th>
                                </tr>
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
                                        <td>
                                            <strong>{{ $pc->cuidado->nombre }}</strong>
                                            @if($pc->instrucciones_esp)
                                                <br><small class="text-gray-500">{{ Str::limit($pc->instrucciones_esp, 80) }}</small>
                                            @endif
                                        </td>
                                        <td>Cada {{ $pc->frecuencia }} días</td>
                                        <td>{{ $proximaFecha->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id, 'cuidado_id' => $pc->id]) }}"
                                               class="btn-registrar">
                                                Registrar
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

            {{-- Historial de cuidados --}}
            <div class="card">
                <div class="card-header">
                    <h3>Historial de cuidados</h3>
                </div>

                <div class="card-body">
                    @forelse($adopcion->registrosCuidados as $registro)
                        <div class="border-b border-gray-100 py-4 flex flex-wrap gap-4 items-start">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">
                                    {{ $registro->plantaCuidado->cuidado->nombre }}
                                    <span class="text-xs text-gray-500 font-normal ml-2">
                                        {{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y H:i') }}
                                    </span>
                                </p>
                                <p class="text-gray-600 text-sm mt-1">
                                    {{ $registro->descripcion ?? 'Sin descripción' }}
                                </p>
                                @if($registro->estado_observado)
                                    <p class="text-xs text-gray-500 mt-1">
                                        Estado observado: {{ $registro->estado_observado }}
                                    </p>
                                @endif
                            </div>
                            @if($registro->imagen)
                                <div>
                                    <img src="{{ asset('storage/' . $registro->imagen) }}"
                                         class="w-20 h-20 object-cover rounded-xl shadow-sm border"
                                         alt="Evidencia de cuidado">
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">Aún no se han registrado cuidados.</p>
                    @endforelse
                </div>
            </div>

            {{-- Problemas reportados --}}
            <div class="card">
                <div class="card-header">
                    <h3>Problemas reportados</h3>
                </div>

                <div class="card-body">
                    @forelse($adopcion->reportesProblemas as $reporte)
                        <div class="border-b border-gray-100 py-4">
                            <div class="flex flex-wrap justify-between items-start gap-2">
                                <div>
                                    <strong class="text-gray-800">{{ $reporte->problema->nombre }}</strong>
                                    <span class="badge-estado
                                        @if($reporte->estado === 'activo') badge-activo
                                        @elseif($reporte->estado === 'en_revision') badge-revision
                                        @else badge-resuelto @endif ml-2">
                                        {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500">Gravedad: {{ ucfirst($reporte->gravedad) }}</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">{{ $reporte->descripcion ?? 'Sin descripción' }}</p>
                            <div class="mt-3">
                                <a href="{{ route('reporte-problemas.show', $reporte) }}" class="text-green-700 text-sm font-medium hover:underline">
                                    Ver diagnóstico
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No hay problemas reportados.</p>
                    @endforelse
                </div>
            </div>

            {{-- Tratamientos --}}
            <div class="card">
                <div class="card-header">
                    <h3>Tratamientos aplicados</h3>
                </div>

                <div class="card-body">
                    <p class="text-gray-500 mb-6">
                        Tratamientos registrados derivados de los problemas reportados.
                    </p>

                    @php
                        $tratamientosReporte = $adopcion->reportesProblemas
                            ->flatMap(function ($reporte) {
                                return $reporte->tratamientosReportes->map(function ($tratamientoReporte) use ($reporte) {
                                    $tratamientoReporte->reporte_original = $reporte;
                                    return $tratamientoReporte;
                                });
                            });
                    @endphp

                    @if($tratamientosReporte->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="tabla-cuidados">
                                <thead>
                                    <tr>
                                        <th>Problema</th>
                                        <th>Tratamiento</th>
                                        <th>Frecuencia</th>
                                        <th>Fecha registro</th>
                                        <th>Estado</th>
                                        <th>Evidencia</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tratamientosReporte as $tratamientoReporte)
                                        @php
                                            $estadoTratamiento = strtolower($tratamientoReporte->estado ?? 'pendiente');
                                            $fechaRegistro = $tratamientoReporte->updated_at ?? $tratamientoReporte->created_at;
                                        @endphp
                                        <tr>
                                            <td>
                                                <strong class="text-gray-800">
                                                    {{ $tratamientoReporte->reporte_original->problema->nombre ?? 'Problema no disponible' }}
                                                </strong>
                                                <br>
                                                <span class="text-xs text-gray-500">
                                                    Gravedad: {{ ucfirst($tratamientoReporte->reporte_original->gravedad ?? 'Sin gravedad') }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong>{{ $tratamientoReporte->tratamiento->descripcion ?? 'Tratamiento sin descripción' }}</strong>
                                                @if($tratamientoReporte->descripcion)
                                                    <br>
                                                    <span class="text-xs text-blue-700">
                                                        Último registro: {{ $tratamientoReporte->descripcion }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                Cada {{ $tratamientoReporte->frecuencia_dias ?? 1 }} días
                                            </td>
                                            <td>
                                                @if($fechaRegistro)
                                                    {{ \Carbon\Carbon::parse($fechaRegistro)->format('d/m/Y') }}
                                                @else
                                                    Sin fecha
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge-estado
                                                    @if($estadoTratamiento === 'pendiente') badge-revision
                                                    @elseif($estadoTratamiento === 'evidenciado') badge-resuelto
                                                    @elseif($estadoTratamiento === 'resuelto') badge-resuelto
                                                    @else badge-revision @endif">
                                                    {{ ucfirst($tratamientoReporte->estado ?? 'pendiente') }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($tratamientoReporte->imagen)
                                                    <img src="{{ asset('storage/' . $tratamientoReporte->imagen) }}"
                                                         alt="Evidencia del tratamiento"
                                                         class="w-16 h-16 object-cover rounded-lg border shadow-sm">
                                                @else
                                                    <span class="text-gray-400">Sin imagen</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('reporte-problemas.show', $tratamientoReporte->reporte_original->id) }}"
                                                   class="btn-diagnostico">
                                                    Ver diagnóstico
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-xl p-6 text-center text-gray-500">
                            No hay tratamientos asignados todavía.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>