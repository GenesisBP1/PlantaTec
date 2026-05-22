<section class="pt-section-form">
    <header class="pt-form-header">
        <h2 class="pt-card-title">Información del perfil</h2>
        <p class="pt-muted">Actualiza tu nombre y correo electrónico.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="pt-form">
        @csrf
        @method('patch')

        <div class="pt-form-group full">
            <label for="name" class="pt-label">Nombre</label>
            <input id="name" name="name" type="text" class="pt-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <p class="pt-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-form-group full">
            <label for="email" class="pt-label">Correo electrónico</label>
            <input id="email" name="email" type="email" class="pt-input" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="pt-error">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="pt-alert-warning mt-3">
                    <p>Tu correo no está verificado.</p>
                    <button form="send-verification" class="pt-link green">Reenviar verificación</button>
                </div>
                <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="hidden">
                    @csrf
                </form>
            @endif
        </div>

        <div class="pt-form-actions">
            <button type="submit" class="pt-btn pt-btn-green">Guardar cambios</button>
            @if (session('status') === 'profile-updated')
                <p class="pt-success-message">Guardado.</p>
            @endif
        </div>
    </form>
</section>

<style>
    .pt-section-form { margin-bottom: 1.5rem; }
    .pt-form-header { margin-bottom: 1.5rem; }
    .pt-input { width: 100%; padding: 0.75rem 1rem; border-radius: 1rem; border: 1px solid #cde0d4; background: #ffffff; font-family: inherit; font-size: 0.95rem; outline: none; transition: 0.2s; }
    .pt-input:focus { border-color: #2b7840; box-shadow: 0 0 0 3px rgba(43,120,64,0.1); }
    .pt-error { color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem; }
    .pt-success-message { color: #16a34a; font-size: 0.875rem; margin-left: 1rem; }
    .pt-alert-warning { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; border-radius: 1rem; padding: 1rem; }
    .pt-link.green { color: #16a34a; text-decoration: none; font-weight: 600; }
    .pt-link.green:hover { text-decoration: underline; }
    .hidden { display: none; }
</style>