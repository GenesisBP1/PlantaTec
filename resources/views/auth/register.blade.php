<x-guest-layout>

    {{-- Encabezado --}}
    <div class="mb-8">
        <h1 class="font-display text-3xl text-gray-900">Crea tu cuenta</h1>
        <p class="text-sm text-gray-500 mt-1">Únete y empieza a cuidar tu jardín digital</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Nombre --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
                Nombre completo
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Tu nombre"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2
                           {{ $errors->get('name') ? 'border-red-400 bg-red-50 focus:border-red-400 focus:ring-red-400/20 text-red-900' : 'border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-green-500/20 text-gray-900' }}"
                />
            </div>
            @error('name')
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

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

        {{-- Contraseña + confirmación en grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- Password --}}
            <div x-data="{ show: false }">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Contraseña
                </label>
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
                        autocomplete="new-password"
                        placeholder="Mín. 8 caracteres"
                        class="block w-full pl-10 pr-10 py-3 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2
                               {{ $errors->get('password') ? 'border-red-400 bg-red-50 focus:border-red-400 focus:ring-red-400/20' : 'border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-green-500/20 text-gray-900' }}"
                    />
                    <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                        <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
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

            {{-- Confirmar contraseña --}}
            <div x-data="{ show: false }">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Confirmar
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </span>
                    <input
                        id="password_confirmation"
                        :type="show ? 'text' : 'password'"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Repite la contraseña"
                        class="block w-full pl-10 pr-10 py-3 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2
                               {{ $errors->get('password_confirmation') ? 'border-red-400 bg-red-50 focus:border-red-400 focus:ring-red-400/20' : 'border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-green-500/20 text-gray-900' }}"
                    />
                    <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                        <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

        </div>

        {{-- Términos / aviso --}}
        <p class="text-xs text-gray-400 leading-relaxed">
            Al registrarte aceptas nuestros
            <a href="#" class="text-green-600 hover:underline">Términos de uso</a>
            y nuestra
            <a href="#" class="text-green-600 hover:underline">Política de privacidad</a>.
        </p>

        {{-- Botón submit --}}
        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700
                   active:bg-green-800 text-white font-semibold text-sm py-3 rounded-xl
                   transition duration-150 focus:outline-none focus:ring-2 focus:ring-green-500
                   focus:ring-offset-2 shadow-sm shadow-green-200"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
            </svg>
            Crear mi cuenta
        </button>

        {{-- Enlace a login --}}
        <p class="text-center text-sm text-gray-500 pt-1">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-semibold hover:underline transition">
                Inicia sesión
            </a>
        </p>

    </form>
</x-guest-layout>