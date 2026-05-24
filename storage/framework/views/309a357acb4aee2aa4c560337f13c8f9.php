<?php $__empty_1 = true; $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="pt-catalog-card">
        <img src="<?php echo e($planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&h=200&fit=crop'); ?>" 
             alt="<?php echo e($planta->nombre); ?>">

        <div class="pt-catalog-card-body">
            <h3><?php echo e($planta->nombre); ?></h3>

            <span class="pt-catalog-zone">
                <?php echo e($planta->tipo_zona ?? 'Zona no especificada'); ?>

            </span>

            <p><?php echo e(Str::limit($planta->descripcion, 80)); ?></p>

            <a href="<?php echo e(route('catalogo.plantas.show', $planta)); ?>" class="pt-adopt-btn">
                Ver y adoptar
            </a>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="pt-empty center pt-catalog-empty">
        No hay plantas disponibles.
    </div>
<?php endif; ?><?php /**PATH C:\Users\1\Herd\plantatec\resources\views/catalogo/partials/plantas_grid.blade.php ENDPATH**/ ?>