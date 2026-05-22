<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Adopciones</p>
                <h2 class="pt-header-title">Detalle de adopción</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-card pt-adoption-detail">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">{{ $adopcion->planta->nombre }}</h3>
                </div>

                <div class="pt-card-body">
                    <div class="pt-adoption-flex">
                        <div class="pt-adoption-image">
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

                        <div class="pt-adoption-info">
                            <div class="pt-info-grid-small">
                                <div class="pt-info-box">
                                    <strong>Especie</strong>
                                    <span>{{ $adopcion->planta->especie }}</span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Estado adopción</strong>
                                    <span>{{ ucfirst($adopcion->estado_adopcion) }}</span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Ubicación</strong>
                                    <span>{{ $adopcion->ubicacion->nombre_lugar ?? 'No registrada' }}</span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Fecha adopción</strong>
                                    <span>{{ \Carbon\Carbon::parse($adopcion->fecha_adopcion)->format('d/m/Y') }}</span>
                                </div>
                            </div>

                            <p class="pt-description">
                                <strong>Descripción:</strong>
                                {{ $adopcion->planta->descripcion ?? 'Sin descripción.' }}
                            </p>

                            <div class="pt-btn-group">
                                <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id]) }}" class="pt-btn pt-btn-green">
                                    Registrar cuidado general
                                </a>

                                <a href="{{ route('reporte-problemas.create', ['adopcion_id' => $adopcion->id]) }}" class="pt-btn pt-btn-red">
                                    Reportar problema
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Plan de cuidados</h3>
                </div>

                <div class="pt-card-body">
                    @php
                        $cuidadosAsignados = $adopcion->planta->plantaCuidados;
                    @endphp

                    @if($cuidadosAsignados->count())
                        <div class="pt-table-wrapper">
                            <table class="pt-table">
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
                                                    <br>
                                                    <small>{{ Str::limit($pc->instrucciones_esp, 80) }}</small>
                                                @endif
                                            </td>
                                            <td>Cada {{ $pc->frecuencia }} días</td>
                                            <td>{{ $proximaFecha->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id, 'cuidado_id' => $pc->id]) }}" class="pt-small-btn green">
                                                    Registrar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="pt-muted">No hay cuidados asignados a esta planta.</p>
                    @endif
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Historial de cuidados</h3>
                </div>

                <div class="pt-card-body">
                    @forelse($adopcion->registrosCuidados as $registro)
                        <div class="pt-history-item">
                            <div class="pt-history-content">
                                <p class="pt-history-title">
                                    {{ $registro->plantaCuidado->cuidado->nombre }}
                                    <span>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y H:i') }}</span>
                                </p>

                                <p class="pt-history-text">
                                    {{ $registro->descripcion ?? 'Sin descripción' }}
                                </p>

                                @if($registro->estado_observado)
                                    <p class="pt-muted">
                                        Estado observado: {{ $registro->estado_observado }}
                                    </p>
                                @endif
                            </div>

                            @if($registro->imagen)
                                <img src="{{ asset('storage/' . $registro->imagen) }}" class="pt-history-image" alt="Evidencia de cuidado">
                            @endif
                        </div>
                    @empty
                        <p class="pt-muted">Aún no se han registrado cuidados.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Problemas reportados</h3>
                </div>

                <div class="pt-card-body">
                    @forelse($adopcion->reportesProblemas as $reporte)
                        <div class="pt-problem-item">
                            <div class="pt-problem-header">
                                <div>
                                    <strong>{{ $reporte->problema->nombre }}</strong>
                                    <span class="pt-status-badge
                                        @if($reporte->estado === 'activo') active
                                        @elseif($reporte->estado === 'en_revision') review
                                        @else solved @endif">
                                        {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                                    </span>
                                </div>

                                <span class="pt-muted">Gravedad: {{ ucfirst($reporte->gravedad) }}</span>
                            </div>

                            <p class="pt-history-text">{{ $reporte->descripcion ?? 'Sin descripción' }}</p>

                            <a href="{{ route('reporte-problemas.show', $reporte) }}" class="pt-link green">
                                Ver diagnóstico
                            </a>
                        </div>
                    @empty
                        <p class="pt-muted">No hay problemas reportados.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Tratamientos aplicados</h3>
                </div>

                <div class="pt-card-body">
                    <p class="pt-muted">
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
                        <div class="pt-table-wrapper">
                            <table class="pt-table">
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
                                                <strong>{{ $tratamientoReporte->reporte_original->problema->nombre ?? 'Problema no disponible' }}</strong>
                                                <br>
                                                <small>Gravedad: {{ ucfirst($tratamientoReporte->reporte_original->gravedad ?? 'Sin gravedad') }}</small>
                                            </td>

                                            <td>
                                                <strong>{{ $tratamientoReporte->tratamiento->descripcion ?? 'Tratamiento sin descripción' }}</strong>
                                                @if($tratamientoReporte->descripcion)
                                                    <br>
                                                    <small>Último registro: {{ $tratamientoReporte->descripcion }}</small>
                                                @endif
                                            </td>

                                            <td>Cada {{ $tratamientoReporte->frecuencia_dias ?? 1 }} días</td>

                                            <td>
                                                @if($fechaRegistro)
                                                    {{ \Carbon\Carbon::parse($fechaRegistro)->format('d/m/Y') }}
                                                @else
                                                    Sin fecha
                                                @endif
                                            </td>

                                            <td>
                                                <span class="pt-status-badge
                                                    @if($estadoTratamiento === 'pendiente') review
                                                    @elseif($estadoTratamiento === 'evidenciado') solved
                                                    @elseif($estadoTratamiento === 'resuelto') solved
                                                    @else review @endif">
                                                    {{ ucfirst($tratamientoReporte->estado ?? 'pendiente') }}
                                                </span>
                                            </td>

                                            <td>
                                                @if($tratamientoReporte->imagen)
                                                    <img src="{{ asset('storage/' . $tratamientoReporte->imagen) }}" class="pt-table-image" alt="Evidencia del tratamiento">
                                                @else
                                                    <span class="pt-muted">Sin imagen</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('reporte-problemas.show', $tratamientoReporte->reporte_original->id) }}" class="pt-small-btn green">
                                                    Ver diagnóstico
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="pt-empty center">
                            No hay tratamientos asignados todavía.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>