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
                <h2 class="pt-header-title">Editar zona pública</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Edición de registro</p>
                    <h3 class="pt-form-title"><?php echo e($zona->nombre_lugar); ?></h3>
                    <p class="pt-form-subtitle">
                        Actualiza la información de esta zona recomendada.
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

                <form action="<?php echo e(route('recomendaciones-zona.update', $zona)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Nombre del lugar *</label>
                            <input type="text" name="nombre_lugar" value="<?php echo e(old('nombre_lugar', $zona->nombre_lugar)); ?>" required>
                        </div>

                        <div class="pt-form-group full">
                            <label>Tipo de zona</label>
                            <input type="text" name="tipo_zona" value="<?php echo e(old('tipo_zona', $zona->tipo_zona)); ?>">
                        </div>

                        <div class="pt-form-group full">
                            <label>Indicaciones</label>
                            <textarea name="indicaciones" rows="3"><?php echo e(old('indicaciones', $zona->indicaciones)); ?></textarea>
                        </div>

                        <div class="pt-form-group">
                            <label>Latitud</label>
                            <input type="text" name="latitud" value="<?php echo e(old('latitud', $zona->latitud)); ?>">
                        </div>

                        <div class="pt-form-group">
                            <label>Longitud</label>
                            <input type="text" name="longitud" value="<?php echo e(old('longitud', $zona->longitud)); ?>">
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción completa</label>
                            <textarea name="descripcion" rows="4"><?php echo e(old('descripcion', $zona->descripcion)); ?></textarea>
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="<?php echo e(route('recomendaciones-zona.index')); ?>" class="pt-btn pt-btn-dark">Cancelar</a>
                        <button type="submit" class="pt-btn pt-btn-yellow">Actualizar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <style>
        /* ============================================
   PlantaTec - Editar Tratamiento
   Vista con nav blanco, títulos verdes y formulario centrado
============================================ */

:root {
    --pt-green: #16a34a;
    --pt-green-dark: #15803d;
    --pt-green-soft: #f0fdf4;
    --pt-green-border: #d1fae5;
    --pt-bg: #f6f3fb;
    --pt-card: #ffffff;
    --pt-text: #111827;
    --pt-muted: #6b7280;
    --pt-border: #dbe7df;
    --pt-orange: #d97706;
    --pt-dark: #475569;
}

* {
    box-sizing: border-box;
}

/* =========================
   NAV BLANCO
========================= */

.pt-navbar {
    background: #ffffff !important;
    border-bottom: 1px solid #e5e7eb !important;
    position: sticky;
    top: 0;
    z-index: 50;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
}

.pt-nav-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1rem;
}

.pt-nav-inner {
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.pt-nav-left {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.pt-logo {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    text-decoration: none;
    color: #111827 !important;
    font-size: 1.25rem;
    font-weight: 900;
}

.pt-logo-icon {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    background: var(--pt-green-dark);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pt-desktop-menu {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.pt-nav-link {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.6rem 0.85rem;
    border-radius: 0.75rem;
    color: #111827 !important;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 800;
    border: none;
    background: transparent;
    cursor: pointer;
    font-family: inherit;
    transition: 0.2s ease;
}

.pt-nav-link:hover,
.pt-nav-link.active {
    background: var(--pt-green-soft) !important;
    color: var(--pt-green-dark) !important;
}

.pt-dropdown {
    position: relative;
}

.pt-dropdown-menu,
.pt-user-dropdown {
    position: absolute;
    top: 115%;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 1rem;
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.12);
    overflow: hidden;
    z-index: 100;
}

.pt-dropdown-menu {
    left: 0;
    width: 270px;
    padding: 0.4rem;
}

.pt-dropdown-menu a,
.pt-user-dropdown a,
.pt-user-dropdown button {
    display: block;
    width: 100%;
    padding: 0.75rem 1rem;
    color: #374151 !important;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 700;
    background: transparent;
    border: none;
    text-align: left;
    cursor: pointer;
    font-family: inherit;
}

.pt-dropdown-menu a:hover,
.pt-user-dropdown a:hover,
.pt-user-dropdown button:hover {
    background: var(--pt-green-soft) !important;
    color: var(--pt-green-dark) !important;
}

.pt-user-menu {
    position: relative;
}

.pt-user-btn {
    display: flex;
    align-items: center;
    gap: 0.65rem;
    padding: 0.45rem 0.7rem;
    border-radius: 0.9rem;
    background: transparent !important;
    border: none !important;
    cursor: pointer;
    font-family: inherit;
    color: #111827 !important;
}

.pt-user-btn:hover {
    background: #f9fafb !important;
}

.pt-avatar {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    background: #166534;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
}

.pt-user-text {
    text-align: left;
}

.pt-user-text p {
    margin: 0;
    color: #111827 !important;
    font-size: 0.875rem;
    font-weight: 900;
}

.pt-user-text span {
    display: block;
    color: #6b7280 !important;
    font-size: 0.75rem;
    line-height: 1.2;
}

.pt-user-arrow {
    color: #374151 !important;
}

.pt-user-dropdown {
    right: 0;
    width: 230px;
}

.pt-user-info {
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.pt-user-info p {
    margin: 0;
    font-weight: 900;
    color: #111827 !important;
}

.pt-user-info span {
    display: block;
    color: #6b7280 !important;
    font-size: 0.75rem;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* =========================
   HEADER DE LA PÁGINA
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
    color: var(--pt-green);
    text-transform: uppercase;
    letter-spacing: 0.16em;
    margin: 0 0 0.35rem;
}

.pt-header-title {
    font-size: 1.5rem;
    font-weight: 900;
    color: var(--pt-text);
    margin: 0;
    line-height: 1.2;
}

.pt-header-subtitle {
    color: var(--pt-muted);
    font-size: 0.875rem;
    margin-top: 0.4rem;
}

/* =========================
   LAYOUT GENERAL
========================= */

.pt-page {
    background: var(--pt-bg);
    min-height: calc(100vh - 80px);
    padding: 3.5rem 1rem;
}

.pt-container,
.pt-form-container {
    max-width: 920px;
    margin: 0 auto;
}

/* =========================
   CARD DEL FORMULARIO
========================= */

.pt-form-card {
    background: var(--pt-card);
    border: 1px solid var(--pt-border);
    border-radius: 1.5rem;
    box-shadow: 0 16px 38px rgba(0, 0, 0, 0.08);
    padding: 2rem;
}

.pt-form-intro {
    margin-bottom: 1.7rem;
}

.pt-form-intro .pt-header-label {
    margin-bottom: 0.7rem;
}

.pt-form-title {
    font-size: 2rem;
    font-weight: 900;
    color: #1e3a2f;
    margin: 0 0 0.45rem;
    line-height: 1.15;
}

.pt-form-subtitle {
    color: var(--pt-muted);
    font-size: 0.95rem;
    margin: 0;
}

/* =========================
   FORMULARIO
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

.pt-form-group input,
.pt-form-group select,
.pt-form-group textarea {
    width: 100%;
    border: 1px solid var(--pt-border);
    border-radius: 1rem;
    background: #ffffff;
    color: var(--pt-text);
    padding: 0.85rem 1rem;
    font-size: 0.95rem;
    font-family: inherit;
    outline: none;
    transition: 0.2s ease;
}

.pt-form-group input:focus,
.pt-form-group select:focus,
.pt-form-group textarea:focus {
    border-color: var(--pt-green);
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.15);
}

.pt-form-group textarea {
    min-height: 90px;
    resize: vertical;
}

.pt-input-inline {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pt-input-inline input {
    max-width: 110px;
}

.pt-input-inline span {
    color: var(--pt-muted);
    font-weight: 800;
}

/* =========================
   BOTONES
========================= */

.pt-form-actions {
    display: flex;
    justify-content: flex-end;
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
    background: var(--pt-orange);
    color: #ffffff;
}

.pt-btn-green:hover,
.pt-btn-yellow:hover {
    background: #b45309;
    transform: translateY(-1px);
}

.pt-btn-dark {
    background: var(--pt-dark);
    color: #ffffff;
}

.pt-btn-dark:hover {
    background: #334155;
    transform: translateY(-1px);
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
   CORRECCIÓN DE SPAN
========================= */

.pt-navbar span,
.pt-page span,
.pt-form-card span,
.pt-header span,
.pt-user-text span,
.pt-user-info span {
    position: static !important;
    top: auto !important;
    right: auto !important;
    left: auto !important;
    bottom: auto !important;
    width: auto !important;
    height: auto !important;
    min-width: auto !important;
    max-width: none !important;
    line-height: inherit;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 768px) {
    .pt-page {
        padding: 2rem 1rem;
    }

    .pt-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .pt-form-card {
        padding: 1.25rem;
        border-radius: 1.25rem;
    }

    .pt-form-title {
        font-size: 1.6rem;
    }

    .pt-form-grid {
        grid-template-columns: 1fr;
    }

    .pt-form-actions {
        flex-direction: column-reverse;
    }

    .pt-btn {
        width: 100%;
    }

    .pt-input-inline {
        align-items: flex-start;
        flex-direction: column;
    }

    .pt-input-inline input {
        max-width: 100%;
    }

    .pt-desktop-menu,
    .pt-user-menu {
        display: none !important;
    }

    .pt-mobile-btn {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    .pt-mobile-menu {
        display: block;
    }
}
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/recomendaciones-zona/edit.blade.php ENDPATH**/ ?>