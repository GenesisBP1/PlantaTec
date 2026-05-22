<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Gestión de Registros',
    'subtitle' => 'Panel de Administración',
    'createRoute' => null,
    'createLabel' => 'Crear Registro',
    'columns' => [],
    'rows' => [],
    'actions' => [],
    'emptyMessage' => 'No hay registros disponibles',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => 'Gestión de Registros',
    'subtitle' => 'Panel de Administración',
    'createRoute' => null,
    'createLabel' => 'Crear Registro',
    'columns' => [],
    'rows' => [],
    'actions' => [],
    'emptyMessage' => 'No hay registros disponibles',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

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
                <p class="pt-header-label"><?php echo e($subtitle); ?></p>
                <h2 class="pt-header-title"><?php echo e($title); ?></h2>
            </div>

            <?php if($createRoute): ?>
                <div class="pt-header-actions">
                    <a href="<?php echo e($createRoute); ?>" class="pt-btn pt-btn-green">
                        + <?php echo e($createLabel); ?>

                    </a>
                </div>
            <?php endif; ?>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-admin-card">

                <?php if(session('success')): ?>
                    <div class="pt-alert-success">
                        <strong>¡Éxito!</strong>
                        <p><?php echo e(session('success')); ?></p>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="pt-alert-error">
                        <strong>Error</strong>
                        <p><?php echo e(session('error')); ?></p>
                    </div>
                <?php endif; ?>

                <div class="pt-admin-table-wrapper">
                    <table class="pt-admin-table">
                        <thead>
                            <tr>
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th><?php echo e($column); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo $cell; ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <td>
                                        <div class="pt-table-actions">
                                            <?php if(isset($actions[$index]['view'])): ?>
                                                <a href="<?php echo e($actions[$index]['view']); ?>" class="pt-action-btn view">
                                                    Ver
                                                </a>
                                            <?php endif; ?>

                                            <?php if(isset($actions[$index]['edit'])): ?>
                                                <a href="<?php echo e($actions[$index]['edit']); ?>" class="pt-action-btn edit">
                                                    Editar
                                                </a>
                                            <?php endif; ?>

                                            <?php if(isset($actions[$index]['delete'])): ?>
                                                <form method="POST"
                                                      action="<?php echo e($actions[$index]['delete']); ?>"
                                                      onsubmit="return confirm('¿Estás seguro? Esta acción no se puede deshacer.');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>

                                                    <button type="submit" class="pt-action-btn delete">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="<?php echo e(count($columns) + 1); ?>">
                                        <div class="pt-empty-state">
                                            <div class="pt-empty-icon">📭</div>
                                            <p><?php echo e($emptyMessage); ?></p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/components/admin-table.blade.php ENDPATH**/ ?>