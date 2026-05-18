<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- Definición del store de Toast (Alpine) --}}
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('toast', {
                    visible: false,
                    message: '',
                    type: 'info',
                    timeout: null,

                    show(message, type = 'info', duration = 4000) {
                        this.message = message;
                        this.type = type;
                        this.visible = true;

                        if (this.timeout) clearTimeout(this.timeout);
                        this.timeout = setTimeout(() => {
                            this.hide();
                        }, duration);
                    },

                    hide() {
                        this.visible = false;
                        if (this.timeout) clearTimeout(this.timeout);
                    }
                });
            });
        </script>

        {{-- Componente Toast visual --}}
        <div
            x-data
            x-show="$store.toast.visible"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed bottom-5 right-5 z-50 max-w-sm w-full"
            style="display:none"
        >
            <div
                class="flex items-start gap-3 p-4 rounded-2xl shadow-xl text-sm font-medium"
                :class="{
                    'bg-green-600 text-white': $store.toast.type === 'success',
                    'bg-red-600 text-white': $store.toast.type === 'error',
                    'bg-amber-500 text-white': $store.toast.type === 'warning',
                    'bg-blue-600 text-white': $store.toast.type === 'info',
                }"
            >
                {{-- Ícono dinámico --}}
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path x-show="$store.toast.type === 'success'"
                          stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    <path x-show="$store.toast.type === 'error'"
                          stroke-linecap="round" stroke-linejoin="round"
                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    <path x-show="$store.toast.type === 'warning'"
                          stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>

                <span x-text="$store.toast.message" class="flex-1"></span>

                <button @click="$store.toast.hide()" class="opacity-75 hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Leaflet JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    </body>
</html>