<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Notificaciones</p>
                <h2 class="pt-header-title">Mis notificaciones</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">

            @if(session('success'))
                <div class="pt-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="pt-notifications-list">
                @forelse($notificaciones as $notificacion)
                    @php
                        $tipo = $notificacion->tipo ?? 'general';
                        $tipoClase = 'general';

                        if ($tipo === 'tratamiento_atraso') {
                            $tipoClase = 'danger';
                        } elseif ($tipo === 'atraso') {
                            $tipoClase = 'warning';
                        } elseif ($tipo === 'hoy') {
                            $tipoClase = 'today';
                        } elseif ($tipo === 'proximo') {
                            $tipoClase = 'info';
                        }

                        preg_match('/para tu planta ([^.]+)/', $notificacion->mensaje, $matches);
                        $nombrePlanta = $matches[1] ?? null;
                        $adopcion = null;

                        if ($nombrePlanta) {
                            $adopcion = \App\Models\Adopcion::where('id_usuario', auth()->id())
                                ->whereHas('planta', function($q) use ($nombrePlanta) {
                                    $q->where('nombre', 'like', $nombrePlanta);
                                })
                                ->first();
                        }
                    @endphp

                    <div class="pt-notification-card {{ $tipoClase }}">
                        <div class="pt-notification-content">
                            <div class="pt-notification-main">
                                <div class="pt-notification-top">
                                    <h3>{{ $notificacion->titulo }}</h3>

                                    <span class="pt-notification-badge {{ $tipoClase }}">
                                        {{ ucfirst(str_replace('_', ' ', $tipo)) }}
                                    </span>
                                </div>

                                <p class="pt-notification-message">
                                    {{ $notificacion->mensaje }}
                                </p>

                                <p class="pt-notification-time">
                                    {{ $notificacion->fecha_envio->diffForHumans() }}
                                </p>
                            </div>

                            <div class="pt-notification-actions">
                                @if(!$notificacion->leida)
                                    <form action="{{ route('notificaciones.update', $notificacion) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="pt-small-btn green">
                                            Marcar leída
                                        </button>
                                    </form>
                                @endif

                                @if($adopcion)
                                    <a href="{{ route('adopciones.show', $adopcion) }}"
                                       class="pt-small-btn blue">
                                        Ver planta
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="pt-empty-state">
                        <div class="pt-empty-icon">🔔</div>
                        <h3>No tienes notificaciones</h3>
                        <p>Aquí aparecerán recordatorios y avisos importantes.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>