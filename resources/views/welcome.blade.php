<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Tu huella verde</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/plantatec.css') }}">
</head>

<body class="pt-welcome-body">

    <nav class="pt-welcome-nav">
        <a href="/" class="pt-welcome-logo">
            <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
                <path d="M16 4C16 4 6 10 6 19C6 24.52 10.48 29 16 29C21.52 29 26 24.52 26 19C26 10 16 4 16 4Z" fill="#16a34a"/>
                <path d="M16 29V16M16 16C16 16 11 20 8 24" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
            PlantaTec
        </a>

        <div class="pt-welcome-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="pt-welcome-nav-btn">Ir al panel</a>
                @else
                    <a href="{{ route('login') }}" class="pt-welcome-nav-link">Iniciar sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="pt-welcome-nav-btn">Registrarse</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <section class="pt-welcome-hero">
        <div class="pt-welcome-hero-inner">
            <div>
                <div class="pt-welcome-badge">
                    <span class="pt-welcome-badge-dot"></span>
                    Plataforma de adopción vegetal
                </div>

                <h1 class="pt-welcome-title">
                    Cuida tu jardín<br>con <em>inteligencia</em><br>natural
                </h1>

                <p class="pt-welcome-description">
                    Adopta plantas, recibe recomendaciones personalizadas según tu entorno y lleva un registro inteligente de cada cuidado. Tu huella verde, organizada.
                </p>

                <div class="pt-welcome-actions">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="pt-welcome-main-btn">
                            Comenzar gratis
                        </a>
                    @endif

                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="pt-welcome-secondary-btn">
                            Ver catálogo →
                        </a>
                    @endif
                </div>
            </div>

            <div class="pt-welcome-visual">
                <div class="pt-welcome-orb">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3C8 3 4 7 4 12c0 3.31 1.79 6.21 4.46 7.77M12 3c4 0 8 4 8 9 0 3.31-1.79 6.21-4.46 7.77M12 3v18M7.76 19.77C9.15 17.4 10 14.8 10 12M16.24 19.77C14.85 17.4 14 14.8 14 12"/>
                    </svg>
                </div>

                <div class="pt-welcome-float-card pt-float-1">🌱 Nueva adopción</div>
                <div class="pt-welcome-float-card pt-float-2">💧 Riego recomendado hoy</div>
                <div class="pt-welcome-float-card pt-float-3">✅ 3 cuidados al día</div>
            </div>
        </div>
    </section>

    <section class="pt-welcome-section white">
        <p class="pt-welcome-section-label">¿Qué ofrece PlantaTec?</p>
        <h2 class="pt-welcome-section-title">Todo lo que tu jardín necesita</h2>
        <p class="pt-welcome-section-description">
            Una plataforma completa para adoptar plantas, registrar cuidados y recibir alertas inteligentes basadas en tu entorno.
        </p>

        <div class="pt-welcome-features-grid">
            @php
                $features = [
                    ['icon' => '🌿', 'name' => 'Catálogo de plantas', 'text' => 'Explora especies con fichas detalladas.'],
                    ['icon' => '💚', 'name' => 'Adopciones', 'text' => 'Adopta plantas y llévalas a casa.'],
                    ['icon' => '📝', 'name' => 'Registro de cuidados', 'text' => 'Anota cada riego, poda o fertilización.'],
                    ['icon' => '💡', 'name' => 'Recomendaciones', 'text' => 'Recibe sugerencias según la especie.'],
                    ['icon' => '🔔', 'name' => 'Notificaciones', 'text' => 'Recibe alertas cuando una planta necesita atención.'],
                    ['icon' => '📍', 'name' => 'Gestión por ubicación', 'text' => 'Organiza tus plantas por ubicación.'],
                ];
            @endphp

            @foreach($features as $feature)
                <div class="pt-welcome-feature-card">
                    <div class="pt-welcome-feature-icon">
                        {{ $feature['icon'] }}
                    </div>
                    <h3>{{ $feature['name'] }}</h3>
                    <p>{{ $feature['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="pt-welcome-stats">
        <div class="pt-welcome-stats-grid">
            <div>
                <p class="pt-welcome-stat-number">+500</p>
                <p class="pt-welcome-stat-label">Especies disponibles</p>
            </div>

            <div>
                <p class="pt-welcome-stat-number">100%</p>
                <p class="pt-welcome-stat-label">Recomendaciones automáticas</p>
            </div>

            <div>
                <p class="pt-welcome-stat-number">∞</p>
                <p class="pt-welcome-stat-label">Cuidados registrados</p>
            </div>
        </div>
    </section>

    <section class="pt-welcome-section soft">
        <p class="pt-welcome-section-label">Inspírate</p>
        <h2 class="pt-welcome-section-title">Plantas destacadas para adoptar</h2>
        <p class="pt-welcome-section-description">
            Descubre algunas de nuestras especies más queridas. Todas listas para dar vida a tu hogar.
        </p>

        <div class="pt-welcome-plants-grid" id="plantas-destacadas">
            <div class="pt-welcome-loading">
                <div class="pt-welcome-spinner"></div>
                <p>Cargando plantas destacadas...</p>
            </div>
        </div>

        <div class="pt-welcome-center">
            <a href="{{ route('catalogo.plantas') }}" class="pt-welcome-outline-btn">
                Ver todo el catálogo →
            </a>
        </div>
    </section>

    <section class="pt-welcome-cta">
        <h2>
            ¿Listo para empezar tu<br><em>huella verde</em>?
        </h2>

        <p>Únete gratis. Sin tarjeta de crédito. Sin complicaciones.</p>

        <div class="pt-welcome-cta-actions">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="pt-welcome-main-btn">
                    Crear cuenta gratis
                </a>
            @endif

            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="pt-welcome-secondary-btn">
                    Ya tengo cuenta
                </a>
            @endif
        </div>
    </section>

    <footer class="pt-welcome-footer">
        &copy; {{ date('Y') }} PlantaTec · Hecho con 🌿 · Todos los derechos reservados
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/plantas-destacadas')
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('plantas-destacadas');

                    if (!data || data.length === 0) {
                        container.innerHTML = '<div class="pt-welcome-error">🌿 No hay plantas disponibles por el momento.</div>';
                        return;
                    }

                    container.innerHTML = data.map(planta => `
                        <div class="pt-welcome-plant-card">
                            <img src="${planta.imagen || 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=400&auto=format'}" alt="${planta.nombre}">
                            <div class="pt-welcome-plant-body">
                                <h3>${planta.nombre}</h3>
                                <span>${planta.tipo_zona || 'Interior'}</span>
                                <p>${planta.descripcion || 'Una hermosa planta para tu hogar.'}</p>
                                <a href="{{ route('catalogo.plantas') }}" class="pt-welcome-outline-btn">Adoptar →</a>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(() => {
                    document.getElementById('plantas-destacadas').innerHTML =
                        '<div class="pt-welcome-error">⚠️ Error al cargar las plantas.</div>';
                });
        });
    </script>
</body>
</html>