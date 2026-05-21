<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reportar problema
        </h2>
     <?php $__env->endSlot(); ?>

    <style>
        /* Estilos coherentes con el catálogo */
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;600;700;800&display=swap');

        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --verde-muy-claro: #f4fbf2;
            --gris-verde: #6f8f7a;
            --blanco: #ffffff;
            --sombra-suave: 0 12px 28px rgba(0, 32, 0, 0.08);
            --sombra-elevada: 0 20px 35px rgba(0, 0, 0, 0.12);
            --border-radius-card: 28px;
            --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 1rem;
        }

        .form-card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            box-shadow: var(--sombra-elevada);
            overflow: hidden;
            border: 1px solid rgba(100, 140, 110, 0.2);
        }

        .form-header {
            background: linear-gradient(115deg, var(--verde-claro), #eef5ea);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(75, 130, 90, 0.2);
        }

        .form-header h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--verde-profundo);
            margin: 0;
        }

        .form-header p {
            color: var(--gris-verde);
            margin-top: 0.25rem;
        }

        .form-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.8rem;
        }

        .form-group label {
            display: block;
            font-weight: 700;
            color: var(--verde-profundo);
            margin-bottom: 0.6rem;
            font-size: 1rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.9rem 1.2rem;
            border-radius: 20px;
            border: 1.5px solid #cde0d4;
            background: var(--blanco);
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--verde-medio);
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.15);
        }

        .btn-primary {
            background: linear-gradient(105deg, var(--verde-medio), #3e8a5a);
            color: white;
            border: none;
            padding: 0.9rem 2rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary:hover {
            transform: scale(0.97);
            box-shadow: 0 12px 22px rgba(43, 120, 64, 0.25);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #2d4a3b;
            padding: 0.9rem 1.8rem;
            border-radius: 60px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            display: inline-block;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        /* Botón para abrir modal */
        .btn-problema {
            background: var(--verde-claro);
            border: 2px dashed var(--verde-medio);
            color: var(--verde-profundo);
            padding: 0.9rem 1.2rem;
            border-radius: 20px;
            width: 100%;
            text-align: left;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-problema:hover {
            background: var(--verde-muy-claro);
            border-color: var(--verde-suave);
        }

        .problema-seleccionado {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: var(--verde-medio);
            font-weight: 600;
        }

        /* Modal de selección de problemas */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(6px);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--blanco);
            margin: auto;
            border-radius: 36px;
            width: 90%;
            max-width: 900px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: var(--sombra-elevada);
            animation: fadeSlideUp 0.3s ease;
        }

        .modal-header {
            background: var(--verde-claro);
            padding: 1.2rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(75, 130, 90, 0.2);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .modal-header h4 {
            margin: 0;
            font-weight: 800;
            color: var(--verde-profundo);
        }

        .close-modal {
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            color: var(--verde-medio);
            line-height: 1;
        }

        .modal-body {
            padding: 1.8rem;
        }

        .grid-problemas {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .problema-card {
            background: var(--blanco);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--sombra-suave);
            transition: var(--transition);
            border: 1px solid rgba(100, 140, 110, 0.2);
            cursor: pointer;
        }

        .problema-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--sombra-elevada);
            border-color: var(--verde-medio);
        }

        .problema-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-bottom: 2px solid var(--verde-claro);
        }

        .problema-card-body {
            padding: 1rem;
        }

        .problema-card-body h5 {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--verde-profundo);
            margin-bottom: 0.25rem;
        }

        .problema-card-body p {
            font-size: 0.8rem;
            color: var(--gris-verde);
            margin: 0;
        }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="py-8">
        <div class="form-container">
            <div class="form-card">
                <div class="form-header">
                    <h3><i class="fas fa-exclamation-triangle"></i> Reportar problema</h3>
                    <p>Planta: <strong><?php echo e($adopcion->planta->nombre); ?></strong></p>
                </div>

                <div class="form-body">
                    <form action="<?php echo e(route('reporte-problemas.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id_adopcion" value="<?php echo e($adopcion->id); ?>">
                        <input type="hidden" name="id_problema" id="id_problema" required>

                        <div class="form-group">
                            <label>🔍 Problema detectado</label>
                            <button type="button" class="btn-problema" id="btnAbrirModal">
                                <i class="fas fa-images"></i>Seleccion el tipo de Problema
                            </button>
                            <div id="problemaSeleccionado" class="problema-seleccionado"></div>
                        </div>

                        <div class="form-group">
                            <label for="gravedad">⚠️ Gravedad</label>
                            <select name="gravedad" id="gravedad" required>
                                <option value="leve">Leve</option>
                                <option value="media">Media</option>
                                <option value="grave">Grave</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">📝 Descripción adicional</label>
                            <textarea name="descripcion" id="descripcion" rows="5" placeholder="Describe lo que observas en la planta..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="imagen">🖼️ Imagen (opcional)</label>
                            <input type="file" name="imagen" id="imagen" accept="image/*">
                        </div>

                        <div class="flex gap-4 mt-6">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-paper-plane"></i> Reportar problema
                            </button>
                            <a href="<?php echo e(route('adopciones.show', $adopcion)); ?>" class="btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para seleccionar problema con imágenes -->
    <div id="modalProblemas" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-leaf"></i> Selecciona un problema</h4>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <div class="grid-problemas">
                    <?php $__currentLoopData = $problemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="problema-card" data-id="<?php echo e($problema->id); ?>" data-nombre="<?php echo e($problema->nombre); ?>" data-imagen="<?php echo e($problema->imagen); ?>">
                            <img src="<?php echo e($problema->imagen ?? 'https://via.placeholder.com/300x160?text=Sin+imagen'); ?>" alt="<?php echo e($problema->nombre); ?>">
                            <div class="problema-card-body">
                                <h5><?php echo e($problema->nombre); ?></h5>
                                <p><?php echo e(Str::limit($problema->descripcion, 60)); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Abrir modal
        const btnAbrir = document.getElementById('btnAbrirModal');
        const modal = document.getElementById('modalProblemas');
        const closeModal = document.querySelector('.close-modal');
        const idProblemaInput = document.getElementById('id_problema');
        const problemaSeleccionadoDiv = document.getElementById('problemaSeleccionado');

        btnAbrir.onclick = () => {
            modal.style.display = 'flex';
        }

        closeModal.onclick = () => {
            modal.style.display = 'none';
        }

        window.onclick = (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        // Seleccionar problema al hacer clic en una tarjeta
        const cards = document.querySelectorAll('.problema-card');
        cards.forEach(card => {
            card.addEventListener('click', () => {
                const id = card.getAttribute('data-id');
                const nombre = card.getAttribute('data-nombre');
                idProblemaInput.value = id;
                problemaSeleccionadoDiv.innerHTML = `<i class="fas fa-check-circle"></i> Problema seleccionado: <strong>${nombre}</strong>`;
                modal.style.display = 'none';
            });
        });
    </script>

    <?php $__env->startPush('scripts'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/reporte_problemas/create.blade.php ENDPATH**/ ?>