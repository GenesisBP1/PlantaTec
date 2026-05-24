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
                <p class="pt-header-label">Zonas públicas</p>
                <h2 class="pt-header-title"><?php echo e($zona->nombre_lugar); ?></h2>
                <p class="pt-header-subtitle">Detalle de la zona recomendada</p>
            </div>
            <div class="pt-header-actions">
                <a href="<?php echo e(route('recomendaciones-zona.index')); ?>" class="pt-btn pt-btn-light">Volver</a>
                <a href="<?php echo e(route('recomendaciones-zona.edit', $zona)); ?>" class="pt-btn pt-btn-green">Editar</a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>
    <style>
    /* =========================
   ACOMODAR CONTENIDO GENERAL
========================= */

.pt-page {
    background: #f6f3fb;
    min-height: calc(100vh - 80px);
    padding: 3.5rem 1rem 4rem;
}

.pt-container {
    max-width: 1180px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* Contenedor especial para formularios */
.pt-form-container {
    max-width: 920px;
    margin: 0 auto;
}

/* =========================
   CARD PRINCIPAL
========================= */

.pt-form-card,
.pt-admin-card {
    background: #ffffff;
    border: 1px solid #dbe7df;
    border-radius: 1.5rem;
    box-shadow: 0 16px 38px rgba(0, 0, 0, 0.08);
    padding: 2rem;
    margin-top: 0;
}

/* Separación interna del encabezado del formulario */
.pt-form-intro {
    margin-bottom: 1.75rem;
}

.pt-form-title {
    font-size: 2rem;
    font-weight: 900;
    color: #1e3a2f;
    margin: 0 0 0.4rem;
    line-height: 1.15;
}

.pt-form-subtitle {
    color: #6b7280;
    font-size: 0.95rem;
    margin: 0;
    line-height: 1.5;
}

/* =========================
   GRID DEL FORMULARIO
========================= */

.pt-form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1.25rem;
}

.pt-form-group {
    display: flex;
    flex-direction: column;
    gap: 0.55rem;
}

.pt-form-group.full {
    grid-column: 1 / -1;
}

.pt-form-group label {
    font-size: 0.88rem;
    font-weight: 900;
    color: #374151;
}

/* Inputs más limpios */
.pt-form-group input,
.pt-form-group select,
.pt-form-group textarea {
    width: 100%;
    border: 1px solid #dbe7df;
    border-radius: 1rem;
    background: #ffffff;
    color: #111827;
    padding: 0.85rem 1rem;
    font-size: 0.95rem;
    font-family: inherit;
    outline: none;
    transition: 0.2s ease;
}

.pt-form-group input:focus,
.pt-form-group select:focus,
.pt-form-group textarea:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.15);
}

.pt-form-group textarea {
    min-height: 105px;
    resize: vertical;
}

/* Campo pequeño con texto al lado, como frecuencia + días */
.pt-input-inline {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pt-input-inline input {
    max-width: 120px;
}

.pt-input-inline span {
    color: #6b7280;
    font-weight: 800;
    position: static !important;
    width: auto !important;
    height: auto !important;
}

/* =========================
   BOTONES ABAJO
========================= */

.pt-form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 0.8rem;
    margin-top: 2rem;
}

.pt-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.25rem;
    border-radius: 0.9rem;
    font-size: 0.875rem;
    font-weight: 900;
    text-decoration: none;
    border: none;
    cursor: pointer;
    font-family: inherit;
    transition: 0.2s ease;
}

.pt-btn-green,
.pt-btn-yellow {
    background: #16a34a;
    color: #ffffff;
}

.pt-btn-green:hover,
.pt-btn-yellow:hover {
    background: #15803d;
    transform: translateY(-1px);
}

.pt-btn-dark {
    background: #475569;
    color: #ffffff;
}

.pt-btn-dark:hover {
    background: #334155;
    transform: translateY(-1px);
}

/* =========================
   HEADER SUPERIOR DE LA VISTA
========================= */

.pt-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.pt-header-label {
    font-size: 0.75rem;
    font-weight: 900;
    color: #16a34a;
    text-transform: uppercase;
    letter-spacing: 0.16em;
    margin: 0 0 0.35rem;
}

.pt-header-title {
    font-size: 1.5rem;
    font-weight: 900;
    color: #111827;
    margin: 0;
    line-height: 1.2;
}

.pt-header-subtitle {
    color: #6b7280;
    font-size: 0.875rem;
    margin-top: 0.4rem;
}

/* =========================
   ALERTAS
========================= */

.pt-alert-error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
    padding: 1rem 1.2rem;
    border-radius: 1rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
}

.pt-alert-error ul {
    margin: 0.5rem 0 0;
    padding-left: 1.2rem;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 768px) {
    .pt-page {
        padding: 2rem 1rem;
    }

    .pt-container,
    .pt-form-container {
        padding: 0;
        max-width: 100%;
    }

    .pt-form-card,
    .pt-admin-card {
        padding: 1.25rem;
        border-radius: 1.25rem;
    }

    .pt-form-title {
        font-size: 1.6rem;
    }

    .pt-form-grid {
        grid-template-columns: 1fr;
    }

    .pt-form-group.full {
        grid-column: auto;
    }

    .pt-form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .pt-btn {
        width: 100%;
    }

    .pt-input-inline {
        flex-direction: column;
        align-items: flex-start;
    }

    .pt-input-inline input {
        max-width: 100%;
    }
}
</style>
    <div class="pt-page">
        <div class="pt-container">
            <div class="pt-card">
                <div class="pt-card-body">
                    <div class="pt-info-grid-small">
                        <div class="pt-info-box">
                            <strong>Nombre del lugar</strong>
                            <span><?php echo e($zona->nombre_lugar); ?></span>
                        </div>
                        <div class="pt-info-box">
                            <strong>Tipo de zona</strong>
                            <span><?php echo e($zona->tipo_zona ?? 'No especificado'); ?></span>
                        </div>
                        <div class="pt-info-box">
                            <strong>Latitud</strong>
                            <span><?php echo e($zona->latitud ?? '—'); ?></span>
                        </div>
                        <div class="pt-info-box">
                            <strong>Longitud</strong>
                            <span><?php echo e($zona->longitud ?? '—'); ?></span>
                        </div>
                    </div>
                    <?php if($zona->descripcion): ?>
                        <div class="pt-description">
                            <strong>Descripción:</strong>
                            <p><?php echo e($zona->descripcion); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if($zona->indicaciones): ?>
                        <div class="pt-description">
                            <strong>Indicaciones:</strong>
                            <p><?php echo e($zona->indicaciones); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/recomendaciones-zona/show.blade.php ENDPATH**/ ?>