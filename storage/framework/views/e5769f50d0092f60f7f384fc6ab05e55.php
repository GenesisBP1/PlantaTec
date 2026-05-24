<section class="pt-section-form">
    <div class="pt-form-header">
        <div class="pt-form-icon pt-form-icon-danger"></div>
        <div>
            <h2 class="pt-card-title">Eliminar cuenta</h2>
            <p class="pt-muted">Acción irreversible. Se borrarán todos tus datos.</p>
        </div>
    </div>

    <button type="button" class="pt-btn pt-btn-red" id="openDeleteModal">
        Eliminar cuenta
    </button>

    <!-- Modal mejorado -->
    <div id="deleteModal" class="pt-modal">
        <div class="pt-modal-content">
            <div class="pt-modal-header">
                <h4>¿Estás completamente seguro?</h4>
                <span class="pt-close-modal" id="closeModalBtn">&times;</span>
            </div>
            <div class="pt-modal-body">
                <p class="pt-muted">Esta acción eliminará permanentemente tu cuenta, adopciones, registros de cuidados y reportes. No podrás recuperarlos.</p>
                <form method="post" action="<?php echo e(route('profile.destroy')); ?>" class="pt-form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>

                    <div class="pt-form-group full">
                        <label for="delete_password" class="pt-label">Contraseña actual</label>
                        <input id="delete_password" name="password" type="password" class="pt-input" placeholder="Ingresa tu contraseña" required>
                        <?php $__errorArgs = ['password', 'userDeletion'];
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

                    <div class="pt-form-actions pt-modal-actions">
                        <button type="button" class="pt-btn pt-btn-dark" id="cancelDeleteBtn">Cancelar</button>
                        <button type="submit" class="pt-btn pt-btn-red">Sí, eliminar cuenta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    .pt-form-icon-danger {
        background: #fee2e2;
        color: #b91c1c;
    }
    .pt-btn-red {
        background: #dc2626;
        color: white;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 2rem;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.2s;
    }
    .pt-btn-red:hover {
        background: #b91c1c;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(185,28,28,0.25);
    }
    .pt-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(4px);
        z-index: 1050;
        align-items: center;
        justify-content: center;
    }
    .pt-modal-content {
        background: white;
        width: 90%;
        max-width: 500px;
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: 0 25px 40px rgba(0,0,0,0.25);
        animation: fadeInUp 0.25s ease;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .pt-modal-header {
        background: #fef2f2;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #fecaca;
    }
    .pt-modal-header h4 {
        margin: 0;
        color: #b91c1c;
        font-weight: 800;
    }
    .pt-close-modal {
        font-size: 2rem;
        cursor: pointer;
        color: #b91c1c;
        line-height: 1;
    }
    .pt-close-modal:hover {
        transform: scale(1.1);
    }
    .pt-modal-body {
        padding: 1.5rem;
    }
    .pt-modal-actions {
        justify-content: flex-end;
        margin-top: 1.5rem;
    }
    .pt-btn-dark {
        background: #475569;
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 2rem;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
    }
    .pt-btn-dark:hover {
        background: #334155;
    }
    @media (max-width: 768px) {
        .pt-section-form {
            padding: 1.2rem;
        }
        .pt-modal-actions {
            flex-direction: column;
        }
        .pt-btn, .pt-btn-dark, .pt-btn-red {
            width: 100%;
            text-align: center;
        }
    }
</style>

<script>
    const openBtn = document.getElementById('openDeleteModal');
    const modal = document.getElementById('deleteModal');
    const closeSpan = document.getElementById('closeModalBtn');
    const cancelBtn = document.getElementById('cancelDeleteBtn');

    if (openBtn) openBtn.onclick = () => modal.style.display = 'flex';
    if (closeSpan) closeSpan.onclick = () => modal.style.display = 'none';
    if (cancelBtn) cancelBtn.onclick = () => modal.style.display = 'none';
    window.onclick = (event) => {
        if (event.target === modal) modal.style.display = 'none';
    };
</script><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>