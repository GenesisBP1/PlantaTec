<section class="pt-section-form">
    <div class="pt-form-header">
        <div class="pt-form-icon">👤</div>
        <div>
            <h2 class="pt-card-title">Información del perfil</h2>
            <p class="pt-muted">Actualiza tu nombre y correo electrónico.</p>
        </div>
    </div>

    <form method="post" action="<?php echo e(route('profile.update')); ?>" class="pt-form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('patch'); ?>

        <div class="pt-form-group full">
            <label for="name" class="pt-label">Nombre completo</label>
            <input id="name" name="name" type="text" class="pt-input" value="<?php echo e(old('name', $user->name)); ?>" required autofocus autocomplete="name">
            <?php $__errorArgs = ['name'];
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
            <label for="email" class="pt-label">Correo electrónico</label>
            <input id="email" name="email" type="email" class="pt-input" value="<?php echo e(old('email', $user->email)); ?>" required autocomplete="username">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="pt-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                <div class="pt-alert-warning mt-3">
                    <p>Tu correo electrónico no está verificado.</p>
                    <button form="send-verification" class="pt-link green">Reenviar verificación</button>
                </div>
                <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>" class="hidden">
                    <?php echo csrf_field(); ?>
                </form>
            <?php endif; ?>
        </div>

        <div class="pt-form-actions">
            <button type="submit" class="pt-btn pt-btn-green">Guardar cambios</button>
            <?php if(session('status') === 'profile-updated'): ?>
                <span class="pt-success-message">✓ Perfil actualizado</span>
            <?php endif; ?>
        </div>
    </form>
</section>

<style>
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
    .pt-alert-warning {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
        border-radius: 1rem;
        padding: 0.8rem 1rem;
        font-size: 0.85rem;
    }
    .pt-link.green {
        color: #2b7840;
        text-decoration: none;
        font-weight: 700;
        background: none;
        border: none;
        cursor: pointer;
    }
    .pt-link.green:hover {
        text-decoration: underline;
    }
    .hidden {
        display: none;
    }
    @media (max-width: 768px) {
        .pt-section-form {
            padding: 1.2rem;
        }
        .pt-form-header {
            flex-direction: column;
            text-align: center;
        }
    }
</style><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>