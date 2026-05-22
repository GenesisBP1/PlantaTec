<section class="pt-section-form">
    <header class="pt-form-header">
        <h2 class="pt-card-title">Actualizar contraseña</h2>
        <p class="pt-muted">Usa una contraseña larga y aleatoria para mayor seguridad.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="pt-form">
        @csrf
        @method('put')

        <div class="pt-form-group full">
            <label for="update_password_current_password" class="pt-label">Contraseña actual</label>
            <input id="update_password_current_password" name="current_password" type="password" class="pt-input" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <p class="pt-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-form-group full">
            <label for="update_password_password" class="pt-label">Nueva contraseña</label>
            <input id="update_password_password" name="password" type="password" class="pt-input" autocomplete="new-password">
            @error('password', 'updatePassword')
                <p class="pt-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-form-group full">
            <label for="update_password_password_confirmation" class="pt-label">Confirmar contraseña</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="pt-input" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <p class="pt-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-form-actions">
            <button type="submit" class="pt-btn pt-btn-green">Guardar</button>
            @if (session('status') === 'password-updated')
                <p class="pt-success-message">Guardado.</p>
            @endif
        </div>
    </form>
</section>