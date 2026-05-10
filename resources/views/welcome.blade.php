<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Tu huella verde</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green-50:  #f0fdf4;
            --green-100: #dcfce7;
            --green-200: #bbf7d0;
            --green-400: #4ade80;
            --green-500: #22c55e;
            --green-600: #16a34a;
            --green-700: #15803d;
            --green-800: #166534;
            --green-900: #14532d;
            --gray-50:  #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-400: #9ca3af;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        /* Modo oscuro - variables */
        @media (prefers-color-scheme: dark) {
            :root {
                --gray-50: #1f2937;
                --gray-100: #374151;
                --gray-200: #4b5563;
                --gray-600: #9ca3af;
                --gray-700: #d1d5db;
                --gray-800: #f3f4f6;
                --gray-900: #ffffff;
            }
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #fafaf9;
            color: var(--gray-800);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .font-display { font-family: 'DM Serif Display', serif; }

        /* Modo oscuro para body */
        @media (prefers-color-scheme: dark) {
            body { background: #111827; }
        }

        /* ── NAV ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 50;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2rem; height: 64px;
            background: rgba(250,250,249,.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,.06);
        }

        @media (prefers-color-scheme: dark) {
            nav { background: rgba(17,24,39,.95); border-bottom-color: rgba(255,255,255,.1); }
        }

        .nav-logo {
            display: flex; align-items: center; gap: 8px;
            font-weight: 600; font-size: 1.125rem;
            color: var(--green-800); text-decoration: none;
        }

        .nav-links { display: flex; align-items: center; gap: 8px; }

        .btn-ghost-nav {
            padding: 6px 16px; border-radius: 10px;
            font-size: .875rem; font-weight: 500;
            color: var(--gray-700); text-decoration: none;
            transition: background .15s;
        }
        .btn-ghost-nav:hover { background: var(--gray-100); }

        .btn-primary-nav {
            padding: 7px 18px; border-radius: 10px;
            font-size: .875rem; font-weight: 600;
            background: var(--green-600); color: #fff;
            text-decoration: none; transition: background .15s;
            box-shadow: 0 1px 3px rgba(22,163,74,.25);
        }
        .btn-primary-nav:hover { background: var(--green-700); }

        /* ── HERO ── */
        .hero {
            padding-top: 120px;
            padding-bottom: 80px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: radial-gradient(ellipse 70% 60% at 80% 30%, rgba(187,247,208,.4) 0%, transparent 65%),
                        radial-gradient(ellipse 50% 40% at 10% 80%, rgba(220,252,231,.3) 0%, transparent 55%),
                        #fafaf9;
            overflow: hidden;
        }

        @media (prefers-color-scheme: dark) {
            .hero { background: radial-gradient(ellipse 70% 60% at 80% 30%, rgba(34,197,94,.15) 0%, transparent 65%),
                        radial-gradient(ellipse 50% 40% at 10% 80%, rgba(34,197,94,.1) 0%, transparent 55%),
                        #111827; }
        }

        .hero-deco {
            position: absolute; pointer-events: none;
            border-radius: 9999px;
            background: linear-gradient(135deg, rgba(134,239,172,.2), rgba(74,222,128,.1));
        }
        .hero-deco-1 { width: 500px; height: 500px; top: -100px; right: -100px; border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%; }
        .hero-deco-2 { width: 300px; height: 300px; bottom: -50px; left: -80px; border-radius: 40% 60% 30% 70% / 60% 40% 60% 40%; }
        .hero-inner {
            max-width: 1100px; width: 100%;
            padding: 0 2rem;
            display: grid; grid-template-columns: 1fr 1fr;
            align-items: center; gap: 5rem;
            position: relative; z-index: 2;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--green-100); color: var(--green-700);
            font-size: .75rem; font-weight: 600;
            padding: 4px 12px; border-radius: 9999px;
            letter-spacing: .05em; text-transform: uppercase;
            margin-bottom: 1.25rem;
            border: 1px solid var(--green-200);
        }
        .hero-badge-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--green-500);
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .5; transform: scale(.8); }
        }
        .hero-title {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2.5rem, 5vw, 3.75rem);
            line-height: 1.1;
            color: var(--gray-900);
            margin-bottom: 1.25rem;
        }
        .hero-title em { font-style: italic; color: var(--green-700); }
        .hero-desc {
            font-size: 1.0625rem; line-height: 1.7;
            color: var(--gray-600); margin-bottom: 2rem;
            max-width: 42ch;
        }
        .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }
        .btn-hero-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 28px; border-radius: 14px;
            font-weight: 600; font-size: .9375rem;
            background: var(--green-600); color: #fff;
            text-decoration: none; transition: all .2s;
            box-shadow: 0 4px 14px rgba(22,163,74,.3);
        }
        .btn-hero-primary:hover { background: var(--green-700); transform: translateY(-1px); }

        /* Botón secundario - MODO CLARO */
        .btn-hero-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 28px; border-radius: 14px;
            font-weight: 600; font-size: .9375rem;
            background: #ffffff;
            color: #374151;
            text-decoration: none; transition: all .2s;
            border: 1.5px solid #e5e7eb;
        }

        .btn-hero-secondary:hover { 
            border-color: #d1d5db; 
            transform: translateY(-1px); 
            background: #f9fafb;
        }

        /* Botón secundario - MODO OSCURO */
        @media (prefers-color-scheme: dark) { 
            .btn-hero-secondary { 
                background: #1f2937;
                color: #ffffff;
                border-color: #4b5563;
            }
            .btn-hero-secondary:hover { 
                background: #374151;
                border-color: #6b7280;
            }
        }

        .hero-visual {
            display: flex; justify-content: center; align-items: center;
            position: relative;
        }
        .hero-orb {
            width: 380px; height: 380px;
            border-radius: 50%;
            background: linear-gradient(135deg, #bbf7d0 0%, #86efac 40%, #4ade80 100%);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 30px 80px rgba(22,163,74,.2);
            position: relative;
            animation: float 8s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-12px) rotate(1deg); }
            66% { transform: translateY(-6px) rotate(-1deg); }
        }
        .hero-orb-icon { width: 140px; height: 140px; color: var(--green-700); opacity: .7; }
        .float-card {
            position: absolute;
            background: #fff;
            border-radius: 16px;
            padding: 12px 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,.1);
            font-size: .8125rem; font-weight: 600;
            display: flex; align-items: center; gap: 8px;
            white-space: nowrap;
            border: 1px solid rgba(0,0,0,.05);
        }
        @media (prefers-color-scheme: dark) {
            .float-card { background: #1f2937; color: #ffffff; border-color: #374151; }
        }
        .float-card-1 { top: 5%; left: -8%; animation: float2 7s ease-in-out infinite; }
        .float-card-2 { bottom: 10%; right: -10%; animation: float2 9s ease-in-out infinite reverse; }
        .float-card-3 { top: 45%; right: -15%; animation: float2 6s ease-in-out infinite 1s; }
        @keyframes float2 {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        /* ── FEATURES ── */
        .features {
            padding: 100px 2rem;
            background: #fff;
        }
        @media (prefers-color-scheme: dark) { .features { background: #1f2937; } }

        .section-label {
            text-align: center;
            font-size: .75rem; font-weight: 700;
            letter-spacing: .1em; text-transform: uppercase;
            color: var(--green-600); margin-bottom: .75rem;
        }
        .section-title {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(1.875rem, 4vw, 2.75rem);
            color: var(--gray-900); text-align: center;
            line-height: 1.2; margin-bottom: 1rem;
        }
        .section-desc {
            text-align: center; max-width: 52ch; margin: 0 auto 4rem;
            color: var(--gray-600); font-size: 1.0625rem; line-height: 1.7;
        }
        .features-grid {
            max-width: 1100px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;
        }
        .feature-card {
            padding: 2rem; border-radius: 20px;
            border: 1.5px solid var(--gray-100);
            transition: all .2s;
            position: relative; overflow: hidden;
            background: white;
        }
        @media (prefers-color-scheme: dark) { .feature-card { background: #374151; border-color: #4b5563; } }
        .feature-card:hover { border-color: var(--green-200); transform: translateY(-3px); box-shadow: 0 12px 40px rgba(22,163,74,.08); }
        .feature-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem;
        }
        .feature-name {
            font-weight: 700; font-size: 1rem;
            color: var(--gray-900); margin-bottom: .5rem;
        }
        .feature-text {
            font-size: .9375rem; line-height: 1.65;
            color: var(--gray-600);
        }

        /* ── STATS ── */
        .stats {
            padding: 80px 2rem;
            background: linear-gradient(160deg, var(--green-900) 0%, var(--green-700) 100%);
            position: relative; overflow: hidden;
        }
        .stats-grid {
            max-width: 900px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 2rem; text-align: center; position: relative; z-index: 1;
        }
        .stat-number {
            font-family: 'DM Serif Display', serif;
            font-size: 3rem; color: #fff;
            line-height: 1; margin-bottom: .5rem;
        }
        .stat-label {
            font-size: .875rem; font-weight: 500;
            color: rgba(255,255,255,.65); text-transform: uppercase;
            letter-spacing: .05em;
        }

        /* ── PLANTAS DESTACADAS (3 CARDS) ── */
        .featured-plants {
            padding: 100px 2rem;
            background: #fefcf8;
        }
        @media (prefers-color-scheme: dark) { 
            .featured-plants { background: #111827; } 
        }

        .plants-grid {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        /* Card - MODO CLARO */
        .plant-card {
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        /* Card - MODO OSCURO */
        @media (prefers-color-scheme: dark) { 
            .plant-card { 
                background: #1f2937;
                border-color: #374151;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }
        }

        .plant-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.12);
        }

        .plant-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .plant-card-body {
            padding: 1.25rem;
        }

        /* Título - MODO CLARO */
        .plant-card-body h3 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            color: #111827;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        /* Título - MODO OSCURO */
        @media (prefers-color-scheme: dark) { 
            .plant-card-body h3 { 
                color: #ffffff;
            }
        }

        /* Badge - MODO CLARO */
        .zona-badge {
            display: inline-block;
            background: #16a34a;
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 40px;
            margin-bottom: 0.75rem;
        }

        /* Badge - MODO OSCURO */
        @media (prefers-color-scheme: dark) { 
            .zona-badge { 
                background: #059669;
                color: #ffffff;
            }
        }

        /* Descripción - MODO CLARO */
        .plant-card-body p {
            color: #374151;
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        /* Descripción - MODO OSCURO */
        @media (prefers-color-scheme: dark) { 
            .plant-card-body p { 
                color: #cbd5e1;
            }
        }

        /* Botón outline - MODO CLARO */
        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background: transparent;
            border: 1.5px solid #16a34a;
            color: #16a34a;
            padding: 10px 16px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            background: #16a34a;
            color: white;
            transform: translateY(-2px);
        }

        /* Botón outline - MODO OSCURO */
        @media (prefers-color-scheme: dark) { 
            .btn-outline { 
                border-color: #4ade80;
                color: #4ade80;
            }
            .btn-outline:hover { 
                background: #4ade80;
                color: #111827;
            }
        }

        .loading-spinner {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
        }

        .spinner {
            width: 48px;
            height: 48px;
            border: 3px solid #dcfce7;
            border-top-color: #16a34a;
            border-radius: 50%;
            margin: 0 auto 1rem;
            animation: spin 0.8s linear infinite;
        }

        @media (prefers-color-scheme: dark) {
            .spinner {
                border-color: #374151;
                border-top-color: #4ade80;
            }
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .error-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 2rem;
            color: #b91c1c;
            background: #fee2e2;
            border-radius: 16px;
        }

        @media (prefers-color-scheme: dark) {
            .error-message {
                color: #fca5a5;
                background: #7f1d1d;
            }
        }

        /* ── CTA ── */
        .cta-section {
            padding: 100px 2rem; text-align: center;
            background: #75f3a35e;
            position: relative; overflow: hidden;
        }
        @media (prefers-color-scheme: dark) { .cta-section { background: #064e3b; } }
        .cta-title {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            color: var(--gray-900); margin-bottom: 1rem;
            position: relative; z-index: 1;
        }
        .cta-text {
            font-size: 1.0625rem; color: var(--gray-600);
            margin-bottom: 2rem; position: relative; z-index: 1;
        }
        @media (prefers-color-scheme: dark) {
            .cta-text { color: #d1d5db; }
        }

        /* ── FOOTER ── */
        footer {
            padding: 2rem; text-align: center;
            font-size: .875rem; color: var(--gray-400);
            background: #fff;
            border-top: 1px solid var(--gray-100);
        }
        @media (prefers-color-scheme: dark) { 
            footer { 
                background: #1f2937; 
                border-top-color: #374151;
                color: #9ca3af;
            } 
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .plants-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
            .features-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .hero-inner { grid-template-columns: 1fr; gap: 3rem; text-align: center; }
            .hero-actions { justify-content: center; }
            .hero-visual { display: none; }
            .features-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: 1fr; gap: 2.5rem; }
        }

        @media (max-width: 600px) {
            .plants-grid { grid-template-columns: 1fr; gap: 1.5rem; }
            .featured-plants { padding: 60px 1rem; }
            nav { padding: 0 1rem; }
            .nav-links { gap: 4px; }
            .btn-ghost-nav, .btn-primary-nav { padding: 4px 12px; font-size: 0.75rem; }
        }
    </style>
</head>
<body>

    {{-- ══ NAV ══ --}}
    <nav>
        <a href="/" class="nav-logo">
            <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
                <path d="M16 4C16 4 6 10 6 19C6 24.52 10.48 29 16 29C21.52 29 26 24.52 26 19C26 10 16 4 16 4Z" fill="#16a34a"/>
                <path d="M16 29V16M16 16C16 16 11 20 8 24" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
            PlantaTec
        </a>
        <div class="nav-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary-nav">Ir al panel</a>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost-nav">Iniciar sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary-nav">Registrarse</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    {{-- ══ HERO ══ --}}
    <section class="hero">
        <div class="hero-deco hero-deco-1"></div>
        <div class="hero-deco hero-deco-2"></div>
        <div class="hero-inner">
            <div>
                <div class="hero-badge">
                    <div class="hero-badge-dot"></div>
                    Plataforma de adopción vegetal
                </div>
                <h1 class="hero-title">
                    Cuida tu jardín<br>con <em>inteligencia</em><br>natural
                </h1>
                <p class="hero-desc">
                    Adopta plantas, recibe recomendaciones personalizadas según tu entorno y lleva un registro inteligente de cada cuidado. Tu huella verde, organizada.
                </p>
                <div class="hero-actions">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-hero-primary">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                            Comenzar gratis
                        </a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn-hero-secondary">
                            Ver catálogo
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-orb">
                    <svg class="hero-orb-icon" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3C8 3 4 7 4 12c0 3.31 1.79 6.21 4.46 7.77M12 3c4 0 8 4 8 9 0 3.31-1.79 6.21-4.46 7.77M12 3v18M7.76 19.77C9.15 17.4 10 14.8 10 12M16.24 19.77C14.85 17.4 14 14.8 14 12"/>
                    </svg>
                </div>
                <div class="float-card float-card-1">🌱 <span>Nueva adopción</span></div>
                <div class="float-card float-card-2">💧 Riego recomendado hoy</div>
                <div class="float-card float-card-3">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    3 cuidados al día
                </div>
            </div>
        </div>
    </section>

    {{-- ══ FEATURES ══ --}}
    <section class="features">
        <p class="section-label">¿Qué ofrece PlantaTec?</p>
        <h2 class="section-title">Todo lo que tu jardín necesita</h2>
        <p class="section-desc">Una plataforma completa para adoptar plantas, registrar cuidados y recibir alertas inteligentes basadas en tu entorno.</p>
        <div class="features-grid">
            @php
            $features = [
                ['icon' => 'M4 6h16M4 10h16M4 14h16M4 18h16', 'color' => '#16a34a', 'name' => 'Catálogo de plantas', 'text' => 'Explora cientos de especies con fichas detalladas.'],
                ['icon' => 'M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z', 'color' => '#be185d', 'name' => 'Adopciones', 'text' => 'Adopta plantas y llévalas a casa.'],
                ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'color' => '#1d4ed8', 'name' => 'Registro de cuidados', 'text' => 'Anota cada riego, poda o fertilización.'],
                ['icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'color' => '#a16207', 'name' => 'Recomendaciones IA', 'text' => 'Recomendaciones personalizadas según la especie.'],
                ['icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'color' => '#b91c1c', 'name' => 'Notificaciones', 'text' => 'Recibe alertas cuando una planta necesita atención.'],
                ['icon' => 'M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'color' => '#0369a1', 'name' => 'Gestión por ubicación', 'text' => 'Organiza tus plantas por ubicación.'],
            ];
            @endphp
            @foreach($features as $f)
            <div class="feature-card">
                <div class="feature-icon" style="background:{{ $f['color'] }}20">
                    <svg width="24" height="24" fill="none" stroke="{{ $f['color'] }}" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}"/>
                    </svg>
                </div>
                <p class="feature-name">{{ $f['name'] }}</p>
                <p class="feature-text">{{ $f['text'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ══ STATS ══ --}}
    <section class="stats">
        <div class="stats-grid">
            <div><p class="stat-number">+500</p><p class="stat-label">Especies disponibles</p></div>
            <div><p class="stat-number">100%</p><p class="stat-label">Recomendaciones automáticas</p></div>
            <div><p class="stat-number">∞</p><p class="stat-label">Cuidados registrados</p></div>
        </div>
    </section>

    {{-- ══ PLANTAS DESTACADAS (3 CARDS RESPONSIVAS) ══ --}}
    <section class="featured-plants">
        <p class="section-label">Inspírate</p>
        <h2 class="section-title">Plantas destacadas para adoptar</h2>
        <p class="section-desc">Descubre algunas de nuestras especies más queridas. Todas listas para dar vida a tu hogar.</p>

        <div class="plants-grid" id="plantas-destacadas">
            <div class="loading-spinner">
                <div class="spinner"></div>
                <p>Cargando plantas destacadas...</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('catalogo.plantas') }}" class="btn-outline" style="width: auto; padding: 12px 32px;">
                Ver todo el catálogo
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </section>

    {{-- ══ CTA ══ --}}
    <section class="cta-section">
        <h2 class="cta-title">¿Listo para empezar tu<br><em style="font-family:'DM Serif Display',serif;color:#16a34a">huella verde</em>?</h2>
        <p class="cta-text">Únete gratis. Sin tarjeta de crédito. Sin complicaciones.</p>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-hero-primary">Crear cuenta gratis</a>
            @endif
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="btn-hero-secondary">Ya tengo cuenta</a>
            @endif
        </div>
    </section>

    {{-- ══ FOOTER ══ --}}
    <footer>
        &copy; {{ date('Y') }} PlantaTec &nbsp;·&nbsp; Hecho con 🌿 &nbsp;·&nbsp; Todos los derechos reservados
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/plantas-destacadas')
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('plantas-destacadas');
                    
                    if (!data || data.length === 0) {
                        container.innerHTML = '<div class="error-message">🌿 No hay plantas disponibles por el momento.</div>';
                        return;
                    }

                    const cardsHtml = data.map(planta => `
                        <div class="plant-card">
                            <img src="${planta.imagen || 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=400&auto=format'}" 
                                 alt="${planta.nombre}">
                            <div class="plant-card-body">
                                <h3>${planta.nombre}</h3>
                                <span class="zona-badge">${planta.tipo_zona || 'Interior'}</span>
                                <p>${planta.descripcion || 'Una hermosa planta para tu hogar.'}</p>
                                <a href="{{ route('catalogo.plantas') }}" class="btn-outline">
                                    Adoptar
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    `).join('');

                    container.innerHTML = cardsHtml;
                })
                .catch(error => {
                    console.error('Error:', error);
                    const container = document.getElementById('plantas-destacadas');
                    container.innerHTML = '<div class="error-message">⚠️ Error al cargar las plantas. Por favor, intenta más tarde.</div>';
                });
        });
    </script>
</body>
</html>