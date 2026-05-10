<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PlantaTec') }}</title>

    {{-- Google Fonts: DM Serif Display + DM Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'DM Serif Display', serif; }

        /* Panel verde animado */
        .panel-bg {
            background:
                radial-gradient(ellipse at 20% 80%, rgba(134,239,172,.35) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 20%, rgba(187,247,208,.25) 0%, transparent 50%),
                linear-gradient(160deg, #14532d 0%, #166534 40%, #15803d 100%);
        }

        /* Círculos decorativos */
        .deco-circle {
            position: absolute;
            border-radius: 9999px;
            background: rgba(255,255,255,.06);
        }

        /* Input override */
        .pt-input {
            @apply block w-full rounded-xl border border-gray-200 bg-gray-50
                   px-4 py-3 text-sm text-gray-900 placeholder-gray-400
                   transition duration-150
                   focus:border-green-500 focus:bg-white focus:ring-2
                   focus:ring-green-500/20 focus:outline-none;
        }

        /* Animación de entrada del formulario */
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(24px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .form-enter { animation: slideInRight .45s cubic-bezier(.22,1,.36,1) both; }

        @keyframes floatLeaf {
            0%, 100% { transform: translateY(0) rotate(-4deg); }
            50%       { transform: translateY(-12px) rotate(2deg); }
        }
        .float-leaf { animation: floatLeaf 6s ease-in-out infinite; }
        .float-leaf-slow { animation: floatLeaf 9s ease-in-out infinite reverse; }
    </style>
</head>
<body class="min-h-screen bg-white">

    <div class="flex min-h-screen">

        {{-- ══════════════════════════════════════
             PANEL IZQUIERDO — Visual botánico
        ══════════════════════════════════════ --}}
        <aside class="panel-bg hidden lg:flex lg:w-[46%] xl:w-[42%] flex-col justify-between relative overflow-hidden p-12 text-white">

            {{-- Círculos decorativos --}}
            <div class="deco-circle w-96 h-96  -top-24  -left-24"></div>
            <div class="deco-circle w-64 h-64  bottom-0  right-0 translate-x-1/3 translate-y-1/3"></div>
            <div class="deco-circle w-32 h-32  top-1/2   right-8"></div>

            {{-- Logo --}}
            <div class="relative z-10">
                <a href="/" class="inline-flex items-center gap-2.5">
                    {{-- Ícono hoja SVG inline --}}
                    <svg class="w-8 h-8" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 4C16 4 6 10 6 19C6 24.52 10.48 29 16 29C21.52 29 26 24.52 26 19C26 10 16 4 16 4Z"
                              fill="white" fill-opacity=".9"/>
                        <path d="M16 29V16M16 16C16 16 11 20 8 24" stroke="#166534" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <span class="text-xl font-semibold tracking-wide">PlantaTec</span>
                </a>
            </div>

            {{-- Ilustración central --}}
            <div class="relative z-10 flex-1 flex flex-col items-center justify-center -mt-8">
                {{-- SVG botánico decorativo --}}
                <div class="relative w-72 h-72 select-none">
                    {{-- Hoja grande --}}
                    <svg class="float-leaf absolute top-4 left-8 w-48 h-48 opacity-30" viewBox="0 0 200 220" fill="none">
                        <path d="M100 10 C60 10 10 60 10 120 C10 170 50 210 100 210 C150 210 190 170 190 120 C190 60 140 10 100 10Z"
                              fill="white"/>
                        <path d="M100 210 L100 80 M100 80 C80 100 60 130 50 160" stroke="#166534" stroke-width="3" stroke-linecap="round" opacity=".6"/>
                    </svg>
                    {{-- Hoja pequeña --}}
                    <svg class="float-leaf-slow absolute bottom-8 right-4 w-28 h-28 opacity-20" viewBox="0 0 200 220" fill="none">
                        <path d="M100 10 C60 10 10 60 10 120 C10 170 50 210 100 210 C150 210 190 170 190 120 C190 60 140 10 100 10Z"
                              fill="white"/>
                    </svg>
                    {{-- Circulo central con ícono --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-36 h-36 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center shadow-2xl">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 3C8 3 4 7 4 12c0 3.31 1.79 6.21 4.46 7.77M12 3c4 0 8 4 8 9 0 3.31-1.79 6.21-4.46 7.77M12 3v18M7.76 19.77C9.15 17.4 10 14.8 10 12M16.24 19.77C14.85 17.4 14 14.8 14 12"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Tagline --}}
                <div class="text-center mt-2">
                    <h2 class="font-display text-3xl xl:text-4xl leading-snug">
                        Tu huella verde<br/>
                        <em>empieza aquí</em>
                    </h2>
                    <p class="mt-3 text-green-100 text-sm leading-relaxed max-w-xs mx-auto">
                        Adopta, cuida y conecta con tus plantas.<br/>
                        Seguimiento inteligente en un solo lugar.
                    </p>
                </div>
            </div>

            {{-- Píe del panel con puntos de confianza --}}
            <div class="relative z-10 grid grid-cols-3 gap-4 text-center">
                @foreach([
                    ['🌱', 'Catálogo', 'de plantas'],
                    ['💧', 'Cuidados', 'personalizados'],
                    ['🔔', 'Alertas', 'inteligentes'],
                ] as [$icon, $title, $sub])
                <div class="bg-white/10 rounded-2xl px-3 py-4 backdrop-blur-sm border border-white/10">
                    <div class="text-2xl mb-1">{{ $icon }}</div>
                    <p class="text-xs font-semibold">{{ $title }}</p>
                    <p class="text-xs text-green-200">{{ $sub }}</p>
                </div>
                @endforeach
            </div>
        </aside>

        {{-- ══════════════════════════════════════
             PANEL DERECHO — Formulario
        ══════════════════════════════════════ --}}
        <main class="flex-1 flex flex-col items-center justify-center px-6 py-12 bg-gray-50">

            {{-- Logo mobile (solo visible sin sidebar) --}}
            <div class="lg:hidden mb-8 flex items-center gap-2 text-green-700">
                <svg class="w-7 h-7" viewBox="0 0 32 32" fill="none">
                    <path d="M16 4C16 4 6 10 6 19C6 24.52 10.48 29 16 29C21.52 29 26 24.52 26 19C26 10 16 4 16 4Z" fill="#16a34a"/>
                    <path d="M16 29V16M16 16C16 16 11 20 8 24" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <span class="text-lg font-semibold tracking-wide">PlantaTec</span>
            </div>

            {{-- Tarjeta formulario --}}
            <div class="form-enter w-full max-w-md">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/60 border border-gray-100 p-8 sm:p-10">
                    {{ $slot }}
                </div>

                {{-- Pie de página --}}
                <p class="text-center text-xs text-gray-400 mt-6">
                    &copy; {{ date('Y') }} PlantaTec · Hecho con 🌿
                </p>
            </div>
        </main>

    </div>
</body>
</html>