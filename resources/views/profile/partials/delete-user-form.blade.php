<section class="pt-section-form">
    <header class="pt-form-header">
        <h2 class="pt-card-title">Eliminar cuenta</h2>
        <p class="pt-muted">Una vez eliminada, no podrás recuperar tus datos.</p>
    </header>

    <button type="button" class="pt-btn pt-btn-red" id="openDeleteModal">
        Eliminar cuenta
    </button>

    <!-- Modal de confirmación -->
    <div id="deleteModal" class="pt-modal" style="display: none;">
        <div class="pt-modal-content">
            <div class="pt-modal-header">
                <h4>¿Eliminar cuenta?</h4>
                <span class="pt-close-modal" id="closeModalBtn">&times;</span>
            </div>
            <div class="pt-modal-body">
                <form method="post" action="{{ route('profile.destroy') }}" class="pt-form">
                    @csrf
                    @method('delete')

                    <p class="pt-muted">Esta acción es irreversible. Ingresa tu contraseña para confirmar.</p>

                    <div class="pt-form-group full mt-4">
                        <label for="delete_password" class="pt-label">Contraseña</label>
                        <input id="delete_password" name="password" type="password" class="pt-input" placeholder="Contraseña" required>
                        @error('password', 'userDeletion')
                            <p class="pt-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-form-actions mt-4">
                        <button type="button" class="pt-btn pt-btn-dark" id="cancelDeleteBtn">Cancelar</button>
                        <button type="submit" class="pt-btn pt-btn-red">Eliminar cuenta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .pt-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.65);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        .pt-modal-content {
            background: white;
            width: 90%;
            max-width: 550px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 35px rgba(0,0,0,0.12);
        }
        .pt-modal-header {
            background: #e2f0e6;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pt-close-modal {
            font-size: 1.8rem;
            cursor: pointer;
            color: #2b7840;
        }
        .pt-modal-body {
            padding: 1.5rem;
        }
    </style>

    <script>
        const openBtn = document.getElementById('openDeleteModal');
        const modal = document.getElementById('deleteModal');
        const closeSpan = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelDeleteBtn');

        openBtn.onclick = () => modal.style.display = 'flex';
        closeSpan.onclick = () => modal.style.display = 'none';
        cancelBtn.onclick = () => modal.style.display = 'none';
        window.onclick = (event) => {
            if (event.target === modal) modal.style.display = 'none';
        };
    </script>
</section>