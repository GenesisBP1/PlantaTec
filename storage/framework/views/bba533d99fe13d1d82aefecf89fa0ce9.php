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
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Reporte de problemas</p>
                <h2 class="pt-header-title">Reportar problema</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo reporte</p>
                    <h3 class="pt-form-title"><?php echo e($adopcion->planta->nombre); ?></h3>
                    <p class="pt-form-subtitle">
                        Reporta un problema detectado en esta planta adoptada.
                    </p>
                </div>

                <?php if($errors->any()): ?>
                    <div class="pt-alert-error">
                        <p><strong>Revisa los campos del formulario:</strong></p>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('reporte-problemas.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="id_adopcion" value="<?php echo e($adopcion->id); ?>">
                    <input type="hidden" name="id_problema" id="id_problema" required>

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Problema detectado</label>

                            <button type="button" class="pt-btn pt-btn-outline" id="btnAbrirModal">
                                Seleccionar tipo de problema
                            </button>

                            <div id="problemaSeleccionado" class="pt-selected-item"></div>
                        </div>

                        <div class="pt-form-group full">
                            <label>Gravedad</label>
                            <select name="gravedad" required>
                                <option value="leve">Leve</option>
                                <option value="media">Media</option>
                                <option value="grave">Grave</option>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción adicional</label>
                            <textarea
                                name="descripcion"
                                rows="5"
                                placeholder="Describe lo que observas en la planta..."
                            ><?php echo e(old('descripcion')); ?></textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Imagen (opcional)</label>
                            <input type="file" name="imagen" accept="image/*">
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="<?php echo e(route('adopciones.show', $adopcion)); ?>" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>

                        <button type="submit" class="pt-btn pt-btn-green">
                            Reportar problema
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- MODAL -->
    <div id="modalProblemas" class="pt-modal">
        <div class="pt-modal-content">
            <div class="pt-modal-header">
                <h4>Selecciona un problema</h4>
                <span class="pt-close-modal">&times;</span>
            </div>

            <div class="pt-modal-body">
                <div class="pt-problemas-grid">
                    <?php $__currentLoopData = $problemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="pt-problema-card"
                             data-id="<?php echo e($problema->id); ?>"
                             data-nombre="<?php echo e($problema->nombre); ?>">
                            
                            <img src="<?php echo e($problema->imagen ?? 'https://via.placeholder.com/300x160?text=Sin+imagen'); ?>"
                                 alt="<?php echo e($problema->nombre); ?>">

                            <div class="pt-problema-card-body">
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
        const btnAbrir = document.getElementById('btnAbrirModal');
        const modal = document.getElementById('modalProblemas');
        const closeModal = document.querySelector('.pt-close-modal');
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

        document.querySelectorAll('.pt-problema-card').forEach(card => {
            card.addEventListener('click', () => {
                const id = card.dataset.id;
                const nombre = card.dataset.nombre;

                idProblemaInput.value = id;
                problemaSeleccionadoDiv.innerHTML =
                    `<strong>Problema seleccionado:</strong> ${nombre}`;

                modal.style.display = 'none';
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/reporte_problemas/create.blade.php ENDPATH**/ ?>