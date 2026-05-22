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
                <p class="pt-header-label">Reportes de problemas</p>
                <h2 class="pt-header-title">Diagnóstico del problema</h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Problema reportado</p>

                    <h3 class="pt-form-title">
                        <?php echo e($reporteProblema->problema->nombre ?? 'Problema no disponible'); ?>

                    </h3>

                    <p class="pt-form-subtitle">
                        Gravedad: <?php echo e(ucfirst($reporteProblema->gravedad ?? 'leve')); ?>

                        ·
                        Estado: <?php echo e(ucfirst(str_replace('_', ' ', $reporteProblema->estado ?? 'pendiente'))); ?>

                    </p>
                </div>

                <div class="pt-detail-grid">
                    <div class="pt-detail-item full">
                        <strong>Descripción</strong>
                        <span>
                            <?php echo e($reporteProblema->descripcion ?? 'Sin descripción adicional.'); ?>

                        </span>
                    </div>

                    <?php if($reporteProblema->imagen): ?>
                        <div class="pt-detail-item full">
                            <strong>Evidencia del problema</strong>

                            <img
                                src="<?php echo e(asset('storage/' . $reporteProblema->imagen)); ?>"
                                class="pt-problem-image"
                                alt="Evidencia del problema"
                            >
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php
                $tratamiento = $reporteProblema->tratamientoSugerido();
            ?>

            <?php if($tratamiento): ?>
                <div class="pt-form-card">
                    <div class="pt-form-intro">
                        <p class="pt-header-label">Tratamiento sugerido</p>

                        <h3 class="pt-form-title">
                            Aplicar tratamiento
                        </h3>

                        <p class="pt-form-subtitle">
                            Registra la aplicación del tratamiento recomendado.
                        </p>
                    </div>

                    <div class="pt-detail-grid">
                        <div class="pt-detail-item full">
                            <strong>Descripción</strong>
                            <span><?php echo e($tratamiento->descripcion); ?></span>
                        </div>

                        <div class="pt-detail-item full">
                            <strong>Indicaciones</strong>
                            <span><?php echo e($tratamiento->indicaciones); ?></span>
                        </div>

                        <div class="pt-detail-item">
                            <strong>Frecuencia</strong>
                            <span>Cada <?php echo e($tratamiento->frecuencia_dias); ?> días</span>
                        </div>
                    </div>

                    <form
                        action="<?php echo e(route('reporte-problemas.aplicar-tratamiento', $reporteProblema)); ?>"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        <?php echo csrf_field(); ?>

                        <input
                            type="hidden"
                            name="id_tratamiento"
                            value="<?php echo e($tratamiento->id); ?>"
                        >

                        <div class="pt-form-grid">

                            <div class="pt-form-group full">
                                <label>Fecha de aplicación</label>

                                <input
                                    type="datetime-local"
                                    name="fecha_aplicacion"
                                    value="<?php echo e(now()->format('Y-m-d\TH:i')); ?>"
                                    required
                                >
                            </div>

                            <div class="pt-form-group full">
                                <label>Imagen (evidencia)</label>

                                <input
                                    type="file"
                                    name="imagen"
                                    accept="image/*"
                                >
                            </div>

                            <div class="pt-form-group full">
                                <label>Observaciones</label>

                                <textarea
                                    name="observaciones"
                                    rows="4"
                                ></textarea>
                            </div>

                        </div>

                        <div class="pt-form-actions">
                            <button
                                type="submit"
                                class="pt-btn pt-btn-green"
                            >
                                Registrar aplicación
                            </button>
                        </div>
                    </form>
                </div>

            <?php else: ?>
                <div class="pt-alert-warning">
                    No hay un tratamiento sugerido para este problema en esta planta.
                </div>
            <?php endif; ?>

            <div class="pt-form-actions">
                <a
                    href="<?php echo e(route('reporte-problemas.index')); ?>"
                    class="pt-btn pt-btn-dark"
                >
                    Volver
                </a>
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/reporte_problemas/show.blade.php ENDPATH**/ ?>