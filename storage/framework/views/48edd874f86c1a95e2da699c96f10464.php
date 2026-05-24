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
                <p class="pt-header-label">Administración</p>
                <h2 class="pt-header-title">Gestión de Cuidados</h2>
                <p class="pt-header-subtitle">Agrega, edita o elimina cuidados registrados en el sistema</p>
            </div>

            <div class="pt-header-actions">
                <a href="<?php echo e(route('cuidados.create')); ?>" class="pt-btn pt-btn-green">
                    Registrar cuidado
                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
       * {
    box-sizing: border-box;
}

.pt-page {
    padding: 2.5rem 0 3.5rem;
    background: #f6f8f5;
    min-height: calc(100vh - 80px);
}

.pt-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* =========================
   HEADER DE LA VISTA
========================= */

.pt-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.pt-header-label {
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #16a34a;
    margin: 0 0 0.25rem;
}

.pt-header-title {
    font-size: 1.5rem;
    font-weight: 900;
    color: #111827;
    line-height: 1.2;
    margin: 0;
}

.pt-header-subtitle {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 0.25rem 0 0;
}

.pt-header-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

/* =========================
   BOTONES
========================= */

.pt-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.6rem 1rem;
    border-radius: 0.9rem;
    font-size: 0.875rem;
    font-weight: 800;
    text-decoration: none;
    transition: 0.2s ease;
    border: none;
    cursor: pointer;
    font-family: inherit;
}

.pt-btn-green {
    background: #16a34a;
    color: #ffffff;
}

.pt-btn-green:hover {
    background: #15803d;
    transform: translateY(-1px);
}

.pt-btn-light {
    background: #ffffff;
    color: #374151;
    border: 1px solid #e5e7eb;
}

.pt-btn-light:hover {
    background: #f9fafb;
}

.pt-btn-red {
    background: #dc2626;
    color: #ffffff;
}

.pt-btn-red:hover {
    background: #b91c1c;
}

/* =========================
   CARD PRINCIPAL
========================= */

.pt-card {
    background: #ffffff;
    border: 1px solid #f3f4f6;
    border-radius: 1.25rem;
    padding: 1.75rem;
    box-shadow: 0 8px 24px rgba(0, 32, 0, 0.08);
}

.pt-card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.pt-card-title {
    font-size: 1.1rem;
    font-weight: 900;
    color: #111827;
    margin: 0;
}

.pt-card-subtitle {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 0.25rem 0 0;
}

.pt-card-body {
    padding: 0;
}

/* =========================
   ALERTAS
========================= */

.pt-alert-success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #86efac;
    padding: 1rem 1.2rem;
    border-radius: 1rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
}

.pt-alert-error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
    padding: 1rem 1.2rem;
    border-radius: 1rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
}

/* =========================
   TABLA
========================= */

.pt-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.pt-table {
    width: 100%;
    border-collapse: collapse;
}

.pt-table th,
.pt-table td {
    padding: 0.9rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: middle;
    font-size: 0.875rem;
}

.pt-table th {
    background: #e2f0e6;
    color: #1e3a2f;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    font-weight: 900;
}

.pt-table td {
    color: #374151;
}

.pt-table td strong {
    color: #1f2937;
    font-weight: 900;
}

.pt-table tbody tr {
    transition: 0.2s ease;
}

.pt-table tbody tr:hover {
    background: #f8fbf8;
}

/* =========================
   SPAN / TEXTOS
========================= */

.pt-muted {
    font-size: 0.8rem;
    color: #6b7280;
}

.pt-table span,
.pt-card span,
.pt-detail-item span {
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.5;
}

.pt-description-text {
    color: #4b5563;
    font-size: 0.875rem;
    line-height: 1.6;
}

.pt-text-small {
    font-size: 0.8rem;
    color: #6b7280;
}

.pt-text-green {
    color: #15803d;
    font-weight: 800;
}

.pt-text-red {
    color: #dc2626;
    font-weight: 800;
}

.pt-text-yellow {
    color: #ca8a04;
    font-weight: 800;
}

/* =========================
   BADGES / ETIQUETAS
========================= */

.pt-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.3rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 800;
    line-height: 1;
    white-space: nowrap;
    position: static !important;
    top: auto !important;
    right: auto !important;
    min-width: auto !important;
    height: auto !important;
}

.pt-badge-success {
    background: #dcfce7;
    color: #166534;
}

.pt-badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.pt-badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

.pt-badge-info {
    background: #dbeafe;
    color: #1d4ed8;
}

.pt-badge-gray {
    background: #f3f4f6;
    color: #374151;
}

/* =========================
   ACCIONES DE TABLA
========================= */

.pt-table-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
    flex-wrap: wrap;
}

.pt-table-actions form {
    margin: 0;
}

.pt-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.45rem 0.85rem;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 800;
    text-decoration: none;
    transition: 0.2s ease;
    border: none;
    cursor: pointer;
    font-family: inherit;
}

.pt-action-btn.view {
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #bfdbfe;
}

.pt-action-btn.view:hover {
    background: #2563eb;
    color: #ffffff;
}

.pt-action-btn.edit {
    background: #fefce8;
    color: #ca8a04;
    border: 1px solid #fde68a;
}

.pt-action-btn.edit:hover {
    background: #ca8a04;
    color: #ffffff;
}

.pt-action-btn.delete {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.pt-action-btn.delete:hover {
    background: #dc2626;
    color: #ffffff;
}

/* =========================
   EMPTY STATE
========================= */

.pt-empty {
    background: #f9fafb;
    border: 1px solid #f3f4f6;
    border-radius: 1rem;
    padding: 2rem 1rem;
    color: #6b7280;
    font-size: 0.875rem;
    text-align: center;
}

.pt-empty-icon {
    font-size: 2rem;
    margin-bottom: 0.75rem;
}

.pt-empty-title {
    color: #4b5563;
    font-weight: 900;
    margin: 0 0 0.3rem;
}

/* =========================
   NAV / ELEMENTOS HEREDADOS
========================= */

.pt-navbar {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 50;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
}

.pt-nav-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1rem;
}

.pt-nav-inner {
    min-height: 64px;
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
    color: #1f2937;
    font-size: 1.25rem;
    font-weight: 900;
}

.pt-logo-icon {
    width: 34px;
    height: 34px;
    border-radius: 0.9rem;
    background: linear-gradient(135deg, #16a34a, #047857);
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
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.6rem 0.85rem;
    border-radius: 0.75rem;
    color: #374151;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 700;
    border: none;
    background: transparent;
    cursor: pointer;
    font-family: inherit;
    transition: 0.2s ease;
}

.pt-nav-link:hover,
.pt-nav-link.active {
    background: #f0fdf4;
    color: #15803d;
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
    box-shadow: 0 16px 32px rgba(0,0,0,0.12);
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
    color: #374151;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    background: transparent;
    border: none;
    text-align: left;
    cursor: pointer;
    font-family: inherit;
}

.pt-dropdown-menu a:hover,
.pt-user-dropdown a:hover,
.pt-user-dropdown button:hover {
    background: #f0fdf4;
    color: #15803d;
}

.pt-dropdown-menu hr {
    border: none;
    border-top: 1px solid #e5e7eb;
    margin: 0.35rem 0;
}

.pt-nav-notification {
    padding-right: 1.3rem;
}

.pt-nav-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #ef4444;
    color: #ffffff;
    border-radius: 999px;
    font-size: 0.68rem;
    font-weight: 900;
    padding: 0.12rem 0.42rem;
    margin-left: 0.3rem;
    line-height: 1;
    position: static !important;
    min-width: auto;
    height: auto;
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
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    cursor: pointer;
    font-family: inherit;
}

.pt-user-btn:hover {
    background: #f3f4f6;
}

.pt-avatar {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    background: linear-gradient(135deg, #16a34a, #047857);
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
    color: #1f2937;
    font-size: 0.875rem;
    font-weight: 800;
}

.pt-user-text span {
    display: block;
    color: #6b7280;
    font-size: 0.75rem;
    line-height: 1.2;
}

.pt-user-arrow {
    color: #6b7280;
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
    font-weight: 800;
    color: #111827;
}

.pt-user-info span {
    display: block;
    color: #6b7280;
    font-size: 0.75rem;
    overflow: hidden;
    text-overflow: ellipsis;
}

.pt-user-dropdown button {
    color: #dc2626;
}

.pt-mobile-btn {
    display: none;
    border: none;
    background: #f3f4f6;
    color: #374151;
    width: 40px;
    height: 40px;
    border-radius: 0.75rem;
    font-size: 1.4rem;
    cursor: pointer;
    font-family: inherit;
}

.pt-mobile-menu {
    display: none;
    background: #ffffff;
    border-top: 1px solid #e5e7eb;
    padding: 0.75rem 1rem;
}

.pt-mobile-menu a,
.pt-mobile-menu button {
    display: block;
    width: 100%;
    padding: 0.75rem;
    border-radius: 0.75rem;
    color: #374151;
    text-decoration: none;
    font-weight: 700;
    border: none;
    background: transparent;
    text-align: left;
    font-family: inherit;
}

.pt-mobile-menu a:hover,
.pt-mobile-menu a.active,
.pt-mobile-menu button:hover {
    background: #f0fdf4;
    color: #15803d;
}

.pt-mobile-user {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 0.75rem;
    border-top: 1px solid #e5e7eb;
    margin-top: 0.5rem;
}

.pt-mobile-user p {
    margin: 0;
    font-weight: 800;
    color: #111827;
}

.pt-mobile-user span {
    font-size: 0.8rem;
    color: #6b7280;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 768px) {
    .pt-page {
        padding: 2rem 0;
    }

    .pt-container {
        padding: 0 1rem;
    }

    .pt-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .pt-header-actions {
        width: 100%;
    }

    .pt-btn {
        width: 100%;
    }

    .pt-card {
        padding: 1.25rem;
    }

    .pt-desktop-menu,
    .pt-user-menu {
        display: none;
    }

    .pt-mobile-btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pt-mobile-menu {
        display: block;
    }

    .pt-table,
    .pt-table thead,
    .pt-table tbody,
    .pt-table tr,
    .pt-table td,
    .pt-table th {
        display: block;
    }

    .pt-table thead {
        display: none;
    }

    .pt-table tr {
        margin-bottom: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 0.75rem;
        background: #ffffff;
    }

    .pt-table td {
        border: none;
        padding: 0.45rem 0;
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
    }

    .pt-table td::before {
        content: attr(data-label);
        font-weight: 900;
        color: #166534;
        width: 95px;
        flex-shrink: 0;
    }

    .pt-table-actions {
        flex-direction: column;
        align-items: stretch;
        width: 100%;
    }

    .pt-table-actions .pt-action-btn,
    .pt-table-actions form,
    .pt-table-actions button {
        width: 100%;
    }
}
    </style>

    <div class="pt-page">
        <div class="pt-container">

            <?php if(session('success')): ?>
                <div class="pt-alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="pt-card">
            

                <div class="pt-card-body">
                    <?php if(count($tableCuidadosRows) > 0): ?>
                        <div class="pt-table-wrapper">
                            <table class="pt-table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                               <tbody>
    <?php $__currentLoopData = $cuidados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuidado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td data-label="Nombre">
                <strong><?php echo e($cuidado->nombre); ?></strong>
            </td>

            <td data-label="Descripción">
                <?php echo e(Str::limit($cuidado->descripcion, 80)); ?>

            </td>

            <td data-label="Acciones" class="pt-table-actions">
                <a href="<?php echo e(route('cuidados.edit', $cuidado)); ?>" class="pt-action-btn edit">
                    Editar
                </a>

                <form action="<?php echo e(route('cuidados.destroy', $cuidado)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="pt-action-btn delete" onclick="return confirm('¿Eliminar este cuidado?')">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="pt-empty">
                            <div class="pt-empty-icon"></div>
                            <p class="pt-empty-title">No hay cuidados registrados</p>
                            <p class="pt-muted">
                                Haz clic en “Registrar cuidado” para agregar el primero.
                            </p>
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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/cuidados/index.blade.php ENDPATH**/ ?>