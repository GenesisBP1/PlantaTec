<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Mis adopciones</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Alpine.js para el dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ========== ESTILOS GLOBALES PLANTA TEC (barra de navegación) ========== */
        body { margin: 0; font-family: 'DM Sans', 'Figtree', sans-serif; background: #f6f8f5; color: #1f2937; }
        .pt-app { min-height: 100vh; }
        .pt-navbar { background: #ffffff; border-bottom: 1px solid #e5e7eb; position: sticky; top: 0; z-index: 50; box-shadow: 0 2px 12px rgba(0,0,0,0.04); }
        .pt-nav-container { max-width: 1280px; margin: 0 auto; padding: 0 1rem; }
        .pt-nav-inner { height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .pt-nav-left { display: flex; align-items: center; gap: 2rem; }
        .pt-logo { display: flex; align-items: center; gap: 0.6rem; text-decoration: none; color: #1f2937; font-size: 1.25rem; font-weight: 900; }
        .pt-logo-icon { width: 34px; height: 34px; border-radius: 0.9rem; background: linear-gradient(135deg, #16a34a, #047857); color: #ffffff; display: flex; align-items: center; justify-content: center; }
        .pt-desktop-menu { display: flex; align-items: center; gap: 0.25rem; }
        .pt-nav-link { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: #374151; text-decoration: none; font-size: 0.9rem; font-weight: 700; background: transparent; border: none; cursor: pointer; }
        .pt-nav-link:hover, .pt-nav-link.active { background: #f0fdf4; color: #15803d; }
        .pt-dropdown { position: relative; }
        .pt-dropdown-menu, .pt-user-dropdown { position: absolute; top: 115%; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 1rem; box-shadow: 0 16px 32px rgba(0,0,0,0.12); overflow: hidden; z-index: 100; min-width: 220px; }
        .pt-dropdown-menu a, .pt-user-dropdown a, .pt-user-dropdown button { display: block; width: 100%; padding: 0.75rem 1rem; color: #374151; text-decoration: none; font-size: 0.875rem; font-weight: 600; text-align: left; background: transparent; border: none; cursor: pointer; }
        .pt-dropdown-menu a:hover, .pt-user-dropdown a:hover, .pt-user-dropdown button:hover { background: #f0fdf4; color: #15803d; }
        .pt-dropdown-menu hr { margin: 0.35rem 0; border-top: 1px solid #e5e7eb; }
        .pt-nav-notification { padding-right: 1.3rem; }
        .pt-nav-badge { background: #ef4444; color: #ffffff; border-radius: 999px; font-size: 0.68rem; padding: 0.1rem 0.4rem; margin-left: 0.3rem; }
        .pt-user-menu { position: relative; }
        .pt-user-btn { display: flex; align-items: center; gap: 0.65rem; padding: 0.45rem 0.7rem; border-radius: 0.9rem; background: #f9fafb; border: 1px solid #e5e7eb; cursor: pointer; }
        .pt-user-btn:hover { background: #f3f4f6; }
        .pt-avatar { width: 34px; height: 34px; border-radius: 999px; background: linear-gradient(135deg, #16a34a, #047857); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 900; }
        .pt-user-text p { margin: 0; font-weight: 800; color: #1f2937; font-size: 0.875rem; }
        .pt-user-text span { font-size: 0.75rem; color: #6b7280; }
        .pt-user-arrow { color: #6b7280; }
        .pt-user-dropdown { right: 0; }
        .pt-user-info { padding: 1rem; border-bottom: 1px solid #e5e7eb; }
        .pt-user-info p { margin: 0; font-weight: 800; }
        .pt-user-info span { display: block; font-size: 0.75rem; color: #6b7280; }
        .pt-mobile-btn { display: none; background: #f3f4f6; border: none; width: 40px; height: 40px; border-radius: 0.75rem; font-size: 1.4rem; cursor: pointer; }
        .pt-mobile-menu { display: none; background: #ffffff; border-top: 1px solid #e5e7eb; padding: 0.75rem 1rem; }
        .pt-mobile-menu a, .pt-mobile-menu button { display: block; width: 100%; padding: 0.75rem; border-radius: 0.75rem; color: #374151; text-decoration: none; font-weight: 700; background: transparent; border: none; text-align: left; cursor: pointer; }
        .pt-mobile-menu a:hover, .pt-mobile-menu button:hover { background: #f0fdf4; color: #15803d; }
        .pt-mobile-user { display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0.75rem; border-top: 1px solid #e5e7eb; margin-top: 0.5rem; }
        @media (max-width: 768px) { .pt-desktop-menu, .pt-user-menu { display: none; } .pt-mobile-btn { display: flex; align-items: center; justify-content: center; } .pt-mobile-menu { display: block; } }
        * { box-sizing: border-box; }
        p, h1, h2, h3, h4 { margin-top: 0; }

        /* ========== ESTILOS PROPIOS DE LA PÁGINA (Mis adopciones) ========== */
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
            --border-radius-card: 36px;
            --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .adopciones-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 1rem 2rem;
        }

        .titulo-principal {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(125deg, #1c593f, var(--verde-medio));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .descripcion-pagina {
            font-size: 1.15rem;
            color: var(--gris-verde);
            margin-bottom: 2rem;
            border-left: 5px solid var(--verde-suave);
            padding-left: 1.2rem;
        }

        .plantas-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            margin: 2rem 0 3rem;
        }

        .planta-card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            padding: 1.8rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2rem;
            box-shadow: var(--sombra-suave);
            transition: var(--transition);
            border: 1px solid rgba(100, 140, 110, 0.2);
            position: relative;
        }

        .planta-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--sombra-elevada);
        }

        .planta-img {
            width: 180px;
            height: 180px;
            border-radius: 32px;
            object-fit: cover;
            box-shadow: 0 12px 22px rgba(0, 0, 0, 0.12);
            border: 3px solid white;
            outline: 1px solid #cde0d4;
            flex-shrink: 0;
            cursor: pointer;
            transition: var(--transition);
        }

        .planta-img:hover {
            transform: scale(1.02);
        }

        .sin-imagen {
            width: 180px;
            height: 180px;
            border-radius: 32px;
            background: var(--verde-muy-claro);
            color: var(--verde-profundo);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-weight: 800;
            border: 2px dashed var(--verde-suave);
            padding: 1rem;
        }

        .info-planta {
            flex: 2;
            min-width: 250px;
        }

        .info-planta h3 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .info-planta h3 a {
            text-decoration: none;
            color: var(--verde-profundo);
            transition: color 0.2s;
        }

        .info-planta h3 a:hover {
            color: var(--verde-medio);
            text-decoration: underline;
        }

        .especie {
            color: var(--verde-medio);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .cuidados-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin: 1rem 0;
        }

        .cuidado-badge {
            background: var(--verde-claro);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--verde-profundo);
        }

        .ultima-evidencia {
            margin-top: 1rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8faf6;
            padding: 0.5rem 1rem;
            border-radius: 60px;
            width: fit-content;
        }

        .ultima-evidencia img {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            object-fit: cover;
        }

        .acciones {
            text-align: center;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .btn-evidencia,
        .btn-problema,
        .btn-detalle {
            background: var(--blanco);
            border: 1.5px solid var(--verde-medio);
            color: var(--verde-medio);
            padding: 0.7rem 1.2rem;
            border-radius: 60px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
        }

        .btn-evidencia:hover,
        .btn-detalle:hover {
            background: var(--verde-medio);
            color: white;
        }

        .btn-problema {
            border-color: #dc2626;
            color: #dc2626;
        }

        .btn-problema:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--blanco);
            margin: auto;
            border-radius: 36px;
            width: 90%;
            max-width: 550px;
            box-shadow: var(--sombra-elevada);
            animation: fadeSlideUp 0.3s ease;
        }

        .modal-header {
            background: var(--verde-claro);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 36px 36px 0 0;
        }

        .modal-header h4 {
            margin: 0;
            font-weight: 800;
            color: var(--verde-profundo);
        }

        .close-modal {
            font-size: 1.8rem;
            cursor: pointer;
            color: var(--verde-medio);
        }

        .modal-body {
            padding: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.7rem;
            border-radius: 20px;
            border: 1px solid #cde0d4;
        }

        .btn-submit {
            background: var(--verde-medio);
            color: white;
            border: none;
            padding: 0.7rem;
            border-radius: 60px;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
        }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 850px) {
            .planta-card {
                flex-direction: column;
                text-align: center;
            }
            .info-planta .cuidados-list {
                justify-content: center;
            }
            .ultima-evidencia {
                margin: 0 auto;
            }
            .acciones {
                width: 100%;
            }
        }

        .bg-white.rounded-2xl.p-10.text-center.text-gray-500 {
            background: var(--blanco);
            border-radius: 1.5rem;
            padding: 2.5rem;
            text-align: center;
            color: var(--gris-verde);
            box-shadow: var(--sombra-suave);
        }
        .bg-white.rounded-2xl.p-10.text-center.text-gray-500 a {
            color: var(--verde-medio);
            text-decoration: none;
            font-weight: 700;
        }
        .bg-white.rounded-2xl.p-10.text-center.text-gray-500 a:hover {
            text-decoration: underline;
        }
        .bg-green-100.text-green-700.p-4.rounded.mb-4 {
            background: #dcfce7;
            color: #166534;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="pt-app">

    <!-- ========== BARRA DE NAVEGACIÓN (con Alpine.js) ========== -->
    <nav x-data="{ open: false }" class="pt-navbar">
        <div class="pt-nav-container">
            <div class="pt-nav-inner">
                <div class="pt-nav-left">
                    <a href="{{ route('dashboard') }}" class="pt-logo">
                        <div class="pt-logo-icon">🌿</div>
                        <span>PlantaTec</span>
                    </a>
                    <div class="pt-desktop-menu">
                        <a href="{{ route('dashboard') }}" class="pt-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                        @if(auth()->user()->rol === 'admin')
                            <div class="pt-dropdown" x-data="{ adminOpen: false }">
                                <button @click="adminOpen = !adminOpen" @click.away="adminOpen = false" class="pt-nav-link pt-dropdown-btn">Administración <span>⌄</span></button>
                                <div x-show="adminOpen" x-transition class="pt-dropdown-menu" style="display:none;">
                                    <a href="{{ route('plantas.index') }}">Plantas</a>
                                    <a href="{{ route('adopciones.index') }}">Adopciones</a>
                                    <a href="{{ route('ubicaciones.index') }}">Ubicaciones</a>
                                    <a href="{{ route('cuidados.index') }}">Cuidados</a>
                                    <a href="{{ route('planta-cuidados.index') }}">Asignar cuidados</a>
                                    <a href="{{ route('recomendaciones-cuidado.index') }}">Recomendaciones de cuidado</a>
                                    <a href="{{ route('recomendaciones-zona.index') }}">Recomendaciones de zona</a>
                                    <a href="{{ route('problemas.index') }}">Problemas</a>
                                    <a href="{{ route('tratamientos.index') }}">Tratamientos</a>
                                    <hr>
                                    <a href="{{ route('reporte-problemas.index') }}">Reportes de problemas</a>
                                    <a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('catalogo.plantas') }}" class="pt-nav-link {{ request()->routeIs('catalogo.plantas') ? 'active' : '' }}">Catálogo</a>
                            <a href="{{ route('adopciones.index') }}" class="pt-nav-link {{ request()->routeIs('adopciones.*') ? 'active' : '' }}">Mis adopciones</a>
                            @php $notificacionesNoLeidas = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count(); @endphp
                            <a href="{{ route('notificaciones.index') }}" class="pt-nav-link pt-nav-notification {{ request()->routeIs('notificaciones.*') ? 'active' : '' }}">
                                Notificaciones
                                @if($notificacionesNoLeidas > 0)
                                    <span class="pt-nav-badge">{{ $notificacionesNoLeidas > 9 ? '9+' : $notificacionesNoLeidas }}</span>
                                @endif
                            </a>
                        @endif
                    </div>
                </div>
                <div class="pt-user-menu" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="pt-user-btn">
                        <div class="pt-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <div class="pt-user-text"><p>{{ Auth::user()->name }}</p><span>{{ Auth::user()->rol === 'admin' ? 'Administrador' : 'Usuario' }}</span></div>
                        <span class="pt-user-arrow">⌄</span>
                    </button>
                    <div x-show="dropdownOpen" x-transition class="pt-user-dropdown" style="display:none;">
                        <div class="pt-user-info"><p>{{ Auth::user()->name }}</p><span>{{ Auth::user()->email }}</span></div>
                        <a href="{{ route('profile.edit') }}">Mi perfil</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Cerrar sesión</button></form>
                    </div>
                </div>
                <button @click="open = !open" class="pt-mobile-btn"><span x-show="!open">☰</span><span x-show="open" style="display:none;">×</span></button>
            </div>
        </div>
        <div x-show="open" x-transition class="pt-mobile-menu" style="display:none;">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            @if(auth()->user()->rol === 'admin')
                <a href="{{ route('plantas.index') }}">Plantas</a>
                <a href="{{ route('adopciones.index') }}">Adopciones</a>
                <a href="{{ route('ubicaciones.index') }}">Ubicaciones</a>
                <a href="{{ route('cuidados.index') }}">Cuidados</a>
                <a href="{{ route('planta-cuidados.index') }}">Asignar cuidados</a>
                <a href="{{ route('recomendaciones-cuidado.index') }}">Recomendaciones de cuidado</a>
                <a href="{{ route('recomendaciones-zona.index') }}">Recomendaciones de zona</a>
                <a href="{{ route('problemas.index') }}">Problemas</a>
                <a href="{{ route('tratamientos.index') }}">Tratamientos</a>
                <a href="{{ route('reporte-problemas.index') }}">Reportes de problemas</a>
                <a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
            @else
                <a href="{{ route('catalogo.plantas') }}">Catálogo</a>
                <a href="{{ route('adopciones.index') }}">Mis adopciones</a>
                <a href="{{ route('notificaciones.index') }}">Notificaciones</a>
            @endif
            <div class="pt-mobile-user">
                <div class="pt-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div><p>{{ Auth::user()->name }}</p><span>{{ Auth::user()->email }}</span></div>
            </div>
            <a href="{{ route('profile.edit') }}">Mi perfil</a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Cerrar sesión</button></form>
        </div>
    </nav>

    <!-- ========== CONTENIDO PRINCIPAL ========== -->
    <div class="py-8">
        <div class="adopciones-container">
            <h1 class="titulo-principal">🌱 Mis plantas adoptadas</h1>

            <p class="descripcion-pagina">
                Registra el cuidado diario y reporta problemas de cada planta.
            </p>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="plantas-list">
                @forelse($adopciones as $adopcion)
                    @php
                        $planta = $adopcion->planta;
                        $cuidadosAsignados = $planta->plantaCuidados ?? collect();
                        $ultimoRegistro = $adopcion->registrosCuidados->sortByDesc('created_at')->first();
                    @endphp

                    <div class="planta-card">
                        <a href="{{ route('adopciones.show', $adopcion) }}">
                            @if($planta->imagen)
                                <img class="planta-img"
                                     src="{{ $planta->imagen }}"
                                     alt="{{ $planta->nombre }}">
                            @else
                                <div class="sin-imagen">
                                    Sin imagen registrada
                                </div>
                            @endif
                        </a>

                        <div class="info-planta">
                            <h3 class="nombre-planta">
                                <a href="{{ route('adopciones.show', $adopcion) }}">
                                    {{ $planta->nombre }}
                                </a>
                            </h3>

                            <div class="especie">
                                {{ $planta->especie ?? 'Sin especie registrada' }}
                            </div>

                            <div class="cuidados-list">
                                @forelse($cuidadosAsignados as $pc)
                                    <span class="cuidado-badge">
                                        {{ $pc->cuidado->nombre ?? 'Cuidado' }} cada {{ $pc->frecuencia }} días
                                    </span>
                                @empty
                                    <span class="cuidado-badge">
                                        Sin cuidados asignados
                                    </span>
                                @endforelse
                            </div>

                            @if($ultimoRegistro)
                                <div class="ultima-evidencia">
                                    @if($ultimoRegistro->imagen)
                                        <img src="{{ asset('storage/' . $ultimoRegistro->imagen) }}" alt="evidencia">
                                    @else
                                        <i class="fas fa-leaf"></i>
                                    @endif

                                    <span>
                                        Última evidencia: {{ $ultimoRegistro->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            @else
                                <div class="ultima-evidencia">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Aún no hay registros de cuidado</span>
                                </div>
                            @endif
                        </div>

                        <div class="acciones">
                            <a href="{{ route('adopciones.show', $adopcion) }}" class="btn-detalle">
                                <i class="fas fa-eye"></i> Ver detalle
                            </a>

                            <button class="btn-evidencia"
                                    data-adopcion-id="{{ $adopcion->id }}"
                                    data-planta-nombre="{{ $planta->nombre }}">
                                <i class="fas fa-camera"></i> Subir evidencia
                            </button>

                            <a href="{{ route('reporte-problemas.create', ['adopcion_id' => $adopcion->id]) }}"
                               class="btn-problema">
                                <i class="fas fa-exclamation-triangle"></i> Reportar problema
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl p-10 text-center text-gray-500">
                        No tienes plantas adoptadas aún.
                        <a href="{{ route('catalogo.plantas') }}" class="text-green-600">
                            ¡Adopta una!
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal para registrar cuidado -->
    <div id="modalCuidado" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Registrar cuidado</h4>
                <span class="close-modal">&times;</span>
            </div>

            <div class="modal-body">
                <form id="formRegistroCuidado" method="POST" enctype="multipart/form-data" action="{{ route('registro-cuidados.store') }}">
                    @csrf
                    <input type="hidden" name="id_adopcion" id="modal_adopcion_id">

                    <div class="form-group">
                        <label>Tipo de cuidado</label>
                        <select name="id_planta_cuidado" id="modal_cuidado_id" required>
                            <option value="">Selecciona un cuidado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="datetime-local"
                               name="fecha"
                               value="{{ now()->format('Y-m-d\TH:i') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Imagen (evidencia)</label>
                        <input type="file" name="imagen" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>Descripción (opcional)</label>
                        <textarea name="descripcion"
                                  rows="3"
                                  placeholder="Describe lo que hiciste..."></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        Guardar registro
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-evidencia').forEach(btn => {
            btn.addEventListener('click', async function () {
                const adopcionId = this.dataset.adopcionId;

                document.getElementById('modal_adopcion_id').value = adopcionId;

                const selectCuidado = document.getElementById('modal_cuidado_id');
                selectCuidado.innerHTML = '<option value="">Cargando...</option>';

                try {
                    const response = await fetch(`/api/plantas-cuidados/${adopcionId}`);
                    const cuidados = await response.json();

                    selectCuidado.innerHTML = '<option value="">Selecciona un cuidado</option>';

                    cuidados.forEach(c => {
                        const option = document.createElement('option');
                        option.value = c.id;
                        option.textContent = `${c.nombre} cada ${c.frecuencia} días`;
                        selectCuidado.appendChild(option);
                    });
                } catch (error) {
                    selectCuidado.innerHTML = '<option value="">Error al cargar cuidados</option>';
                }

                document.getElementById('modalCuidado').style.display = 'flex';
            });
        });

        document.querySelector('.close-modal').onclick = () => {
            document.getElementById('modalCuidado').style.display = 'none';
        };

        window.onclick = (event) => {
            if (event.target === document.getElementById('modalCuidado')) {
                document.getElementById('modalCuidado').style.display = 'none';
            }
        };
    </script>

</body>
</html>