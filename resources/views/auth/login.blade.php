<x-guest-layout>

    {{-- Encabezado --}}
    <div class="mb-8">
        <h1 class="font-display text-3xl text-gray-900">Bienvenido de vuelta</h1>
        <p class="text-sm text-gray-500 mt-1">Ingresa a tu cuenta para cuidar tus plantas</p>
    </div>

    {{-- Estado de sesión (ej. "enlace de recuperación enviado") --}}
    @if (session('status'))
        <div class="mb-6 flex items-center gap-2 text-sm text-green-700 bg-green-50 border border-green-200 rounded-xl px-4 py-3">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                Correo electrónico
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="tu@correo.com"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2
                           {{ $errors->get('email') ? 'border-red-400 bg-red-50 focus:border-red-400 focus:ring-red-400/20 text-red-900' : 'border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-green-500/20 text-gray-900' }}"
                />
            </div>
            @error('email')
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Password --}}
        <div x-data="{ show: false }">
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="text-sm font-medium text-gray-700">
                    Contraseña
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-xs text-green-600 hover:text-green-700 font-medium hover:underline transition">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <input
                    id="password"
                    :type="show ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="block w-full pl-10 pr-12 py-3 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2
                           {{ $errors->get('password') ? 'border-red-400 bg-red-50 focus:border-red-400 focus:ring-red-400/20' : 'border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-green-500/20 text-gray-900' }}"
                />
                {{-- Toggle mostrar contraseña --}}
                <button type="button"
                        @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition">
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Recuérdame --}}
        <div class="flex items-center gap-2.5">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500 cursor-pointer"
            >
            <label for="remember_me" class="text-sm text-gray-600 cursor-pointer select-none">
                Mantenerme conectado
            </label>
        </div>

        {{-- Botón submit --}}
        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700
                   active:bg-green-800 text-white font-semibold text-sm py-3 rounded-xl
                   transition duration-150 focus:outline-none focus:ring-2 focus:ring-green-500
                   focus:ring-offset-2 shadow-sm shadow-green-200 mt-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Iniciar sesión
        </button>

        {{-- Enlace a registro --}}
        <p class="text-center text-sm text-gray-500 pt-1">
            ¿Aún no tienes cuenta?
            <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold hover:underline transition">
                Regístrate gratis
            </a>
        </p>

    </form>
</x-guest-layout>