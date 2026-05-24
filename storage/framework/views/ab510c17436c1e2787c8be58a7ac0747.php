<section class="pt-section-form">
    <div class="pt-form-header">
        <div class="pt-form-icon"></div>
        <div>
            <h2 class="pt-card-title">Cambiar contraseña</h2>
            <p class="pt-muted">Usa una contraseña larga y segura.</p>
        </div>
    </div>

    <form method="post" action="<?php echo e(route('password.update')); ?>" class="pt-form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <div class="pt-form-group full">
            <label for="update_password_current_password" class="pt-label">Contraseña actual</label>
            <input id="update_password_current_password" name="current_password" type="password" class="pt-input" autocomplete="current-password">
            <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="pt-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="pt-form-group full">
            <label for="update_password_password" class="pt-label">Nueva contraseña</label>
            <input id="update_password_password" name="password" type="password" class="pt-input" autocomplete="new-password">
            <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="pt-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="pt-form-group full">
            <label for="update_password_password_confirmation" class="pt-label">Confirmar nueva contraseña</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="pt-input" autocomplete="new-password">
            <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="pt-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="pt-form-actions">
            <button type="submit" class="pt-btn pt-btn-green">Actualizar contraseña</button>
            <?php if(session('status') === 'password-updated'): ?>
                <span class="pt-success-message">✓ Contraseña actualizada</span>
            <?php endif; ?>
        </div>
    </form>
</section>

<style>
    /* Los estilos son los mismos que en el formulario de perfil */
    .pt-section-form {
        padding: 1.8rem;
    }
    .pt-form-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.8rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eef2ee;
    }
    .pt-form-icon {
        width: 48px;
        height: 48px;
        background: #dcfce7;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #2b7840;
    }
    .pt-form-group.full {
        margin-bottom: 1.5rem;
    }
    .pt-label {
        display: block;
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        color: #1f2937;
    }
    .pt-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        border: 1px solid #cde0d4;
        background: #ffffff;
        font-family: inherit;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.2s;
    }
    .pt-input:focus {
        border-color: #2b7840;
        box-shadow: 0 0 0 3px rgba(43,120,64,0.1);
    }
    .pt-error {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.4rem;
    }
    .pt-form-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    .pt-btn-green {
        background: linear-gradient(105deg, #2b7840, #3e8a5a);
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 2rem;
        font-weight: 800;
        color: white;
        cursor: pointer;
        transition: all 0.2s;
    }
    .pt-btn-green:hover {
        background: linear-gradient(105deg, #236a3b, #2b7840);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(43,120,64,0.25);
    }
    .pt-success-message {
        color: #2b7840;
        font-weight: 600;
        font-size: 0.85rem;
        background: #dcfce7;
        padding: 0.3rem 0.9rem;
        border-radius: 2rem;
    }
    @media (max-width: 768px) {
        .pt-section-form {
            padding: 1.2rem;
        }
        .pt-form-header {
            flex-direction: column;
            text-align: center;
        }
        .pt-form-actions {
            flex-direction: column;
            align-items: stretch;
        }
        .pt-success-message {
            text-align: center;
        }
    }
</style><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>