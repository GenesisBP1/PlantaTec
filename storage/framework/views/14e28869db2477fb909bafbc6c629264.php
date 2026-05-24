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
                <p class="pt-header-label">Problemas</p>
                <h2 class="pt-header-title">Gestión de problemas</h2>
                <p class="pt-header-subtitle">Panel de administración</p>
            </div>
            <div class="pt-header-actions">
                <a href="<?php echo e(route('problemas.create')); ?>" class="pt-btn pt-btn-green">+ Registrar problema</a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        /* ========== ESTILOS ESPECÍFICOS PARA LA TABLA DE PROBLEMAS ========== */
        /* (El layout base ya trae reset, navbar, colores, etc.) */
        .pt-admin-card {
            background: #ffffff;
            border-radius: 1.25rem;
            border: 1px solid #f3f4f6;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            padding: 1rem 0;
        }
        .pt-admin-table-wrapper {
            overflow-x: auto;
        }
        .pt-admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .pt-admin-table th,
        .pt-admin-table td {
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }
        .pt-admin-table th {
            background: #f9fafb;
            font-weight: 800;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #4b5563;
        }
        .pt-admin-table tbody tr:hover {
            background: #faf9f6;
        }
        .pt-table-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            align-items: center;
        }
        .pt-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.4rem 0.8rem;
            border-radius: 999px;
            font-size: 0.75rem;
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
            color: white;
        }
        .pt-action-btn.edit {
            background: #fefce8;
            color: #ca8a04;
            border: 1px solid #fde68a;
        }
        .pt-action-btn.edit:hover {
            background: #ca8a04;
            color: white;
        }
        .pt-action-btn.delete {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .pt-action-btn.delete:hover {
            background: #dc2626;
            color: white;
        }
        .pt-empty.center {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
        }
        @media (max-width: 768px) {
            .pt-admin-table th,
            .pt-admin-table td {
                padding: 0.75rem 1rem;
            }
            .pt-table-actions {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container">
            <div class="pt-admin-card">
                <div class="pt-admin-table-wrapper">
                    <table class="pt-admin-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $problemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($problema->nombre); ?></td>
                                    <td><?php echo e(Str::limit($problema->descripcion, 80)); ?></td>
                                    <td class="pt-table-actions">
                                        <a href="<?php echo e(route('problemas.show', $problema)); ?>" class="pt-action-btn view">Ver</a>
                                        <a href="<?php echo e(route('problemas.edit', $problema)); ?>" class="pt-action-btn edit">Editar</a>
                                        <form action="<?php echo e(route('problemas.destroy', $problema)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="pt-action-btn delete" onclick="return confirm('¿Eliminar este problema?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="pt-empty center">No hay problemas registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="pt-pagination">
                    <?php echo e($problemas->links()); ?>

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
<?php endif; ?><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/problemas/index.blade.php ENDPATH**/ ?>