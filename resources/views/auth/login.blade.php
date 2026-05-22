<x-guest-layout>
    <div class="pt-auth-header">
        <h1>Bienvenido de vuelta</h1>
        <p>Ingresa a tu cuenta para cuidar tus plantas</p>
    </div>

    @if (session('status'))
        <div class="pt-alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="pt-auth-form">
        @csrf

        <div class="pt-form-group full">
            <label>Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="tu@correo.com">
            @error('email')
                <small class="pt-error-text">{{ $message }}</small>
            @enderror
        </div>

        <div class="pt-form-group full" x-data="{ show: false }">
            <label>Contraseña</label>
            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" placeholder="••••••••">

            <button type="button" @click="show = !show" class="pt-password-toggle">
                Mostrar/Ocultar
            </button>

            @error('password')
                <small class="pt-error-text">{{ $message }}</small>
            @enderror

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="pt-auth-link">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <label class="pt-checkbox-row">
            <input id="remember_me" type="checkbox" name="remember">
            <span>Mantenerme conectado</span>
        </label>

        <button type="submit" class="pt-btn pt-btn-green pt-auth-submit">
            Iniciar sesión
        </button>

        <p class="pt-auth-footer">
            ¿Aún no tienes cuenta?
            <a href="{{ route('register') }}">Regístrate gratis</a>
        </p>
    </form>
</x-guest-layout>