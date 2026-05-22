<x-guest-layout>
    <div class="pt-auth-header">
        <h1>Crea tu cuenta</h1>
        <p>Únete y empieza a cuidar tu jardín digital</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="pt-auth-form">
        @csrf

        <div class="pt-form-group full">
            <label>Nombre completo</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Tu nombre">
            @error('name')
                <small class="pt-error-text">{{ $message }}</small>
            @enderror
        </div>

        <div class="pt-form-group full">
            <label>Correo electrónico</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                placeholder="tu@correo.com">
            @error('email')
                <small class="pt-error-text">{{ $message }}</small>
            @enderror
        </div>

        <div class="pt-auth-password-grid">

            <div class="pt-form-group" x-data="{ show: false }">
                <label>Contraseña</label>

                <input
                    id="password"
                    :type="show ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Mín. 8 caracteres">

                <button type="button" @click="show = !show" class="pt-password-toggle">
                    Mostrar/Ocultar
                </button>

                @error('password')
                    <small class="pt-error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="pt-form-group" x-data="{ show: false }">
                <label>Confirmar contraseña</label>

                <input
                    id="password_confirmation"
                    :type="show ? 'text' : 'password'"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Repite la contraseña">

                <button type="button" @click="show = !show" class="pt-password-toggle">
                    Mostrar/Ocultar
                </button>
            </div>

        </div>

        <p class="pt-auth-terms">
            Al registrarte aceptas nuestros
            <a href="#">Términos de uso</a>
            y nuestra
            <a href="#">Política de privacidad</a>.
        </p>

        <button type="submit" class="pt-btn pt-btn-green pt-auth-submit">
            Crear mi cuenta
        </button>

        <p class="pt-auth-footer">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}">Inicia sesión</a>
        </p>
    </form>
</x-guest-layout>