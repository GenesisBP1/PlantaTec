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
                <p class="pt-header-label"> Nuevo registro</p>
                <h2 class="pt-header-title">Registrar planta</h2>
                <p class="pt-header-subtitle">Agrega una nueva planta al catálogo del sistema.</p>
            </div>
            <div class="pt-header-actions">
                <a href="<?php echo e(route('plantas.index')); ?>" class="pt-btn pt-btn-light">Volver al listado</a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        /* Estilos específicos del formulario (el layout ya contiene los globales) */
        .pt-form-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .pt-form-card {
            background: #ffffff;
            border-radius: 1.75rem;
            border: 1px solid #dbe7df;
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
            padding: 2rem;
            transition: all 0.2s ease;
        }
        .pt-form-card:hover {
            box-shadow: 0 20px 35px rgba(0, 32, 0, 0.12);
        }
        .pt-form-intro {
            margin-bottom: 1.8rem;
            border-left: 4px solid #2b7840;
            padding-left: 1.2rem;
        }
        .pt-form-title {
            font-size: 1.8rem;
            font-weight: 900;
            color: #1e3a2f;
            margin: 0.4rem 0;
        }
        .pt-form-subtitle {
            color: #6b7280;
            font-size: 0.9rem;
        }
        .pt-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        .pt-form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .pt-form-group.full {
            grid-column: 1 / -1;
        }
        .pt-form-group label {
            font-weight: 800;
            color: #374151;
            font-size: 0.92rem;
        }
        .pt-form-group input,
        .pt-form-group select,
        .pt-form-group textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 1rem;
            border: 1px solid #cde0d4;
            background: #ffffff;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
        }
        .pt-form-group input:focus,
        .pt-form-group select:focus,
        .pt-form-group textarea:focus {
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
        }
        .pt-select-help {
            font-size: 0.7rem;
            color: #6b7280;
            margin-top: 0.2rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .pt-form-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        @media (max-width: 768px) {
            .pt-form-grid {
                grid-template-columns: 1fr;
            }
            .pt-form-card {
                padding: 1.25rem;
            }
            .pt-form-title {
                font-size: 1.6rem;
            }
            .pt-form-actions {
                justify-content: stretch;
            }
            .pt-form-actions .pt-btn {
                flex: 1;
                text-align: center;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container pt-form-container">
            <div class="pt-form-card">
                <form action="<?php echo e(route('plantas.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="pt-form-grid">
                        <div class="pt-form-group">
                            <label>Nombre <span class="pt-badge green" style="font-size:0.7rem;">*</span></label>
                            <input type="text" name="nombre" required>
                        </div>

                        <div class="pt-form-group">
                            <label>Especie <span class="pt-badge green" style="font-size:0.7rem;">*</span></label>
                            <input type="text" name="especie" required>
                        </div>

                        <div class="pt-form-group">
                            <label>Tipo de zona</label>
                            <select name="tipo_zona">
                                <option value="">-- Selecciona una opción --</option>
                                <option value="Pleno sol">Pleno sol</option>
                                <option value="Sol parcial">Sol parcial</option>
                                <option value="Luz brillante indirecta">Luz brillante indirecta</option>
                                <option value="Sombra parcial">Sombra parcial</option>
                            </select>
                            <div class="pt-select-help">
                                <span></span> Recomendación de luz para esta planta
                            </div>
                        </div>

                        <div class="pt-form-group">
                            <label>Imagen (URL o nombre de archivo)</label>
                            <input type="text" name="imagen" placeholder="Ej: https://ejemplo.com/planta.jpg">
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="4" placeholder="Características, cuidados especiales, etc."></textarea>
                        </div>
                    </div>

                    <!-- Campo oculto para estado, siempre 'saludable' -->
                    <input type="hidden" name="estado" value="saludable">

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-green">Guardar planta</button>
                        <a href="<?php echo e(route('plantas.index')); ?>" class="pt-btn pt-btn-dark">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/plantas/create.blade.php ENDPATH**/ ?>