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
            Diagnóstico y tratamiento sugerido
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <?php if(session('success')): ?>
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wide">
                            Reporte de problema
                        </p>

                        <h3 class="text-3xl font-bold text-slate-900 mt-1">
                            <?php echo e($reporteProblema->adopcion->planta->nombre ?? 'Planta no disponible'); ?>

                        </h3>

                        <p class="text-slate-500 mt-1">
                            <?php echo e($reporteProblema->adopcion->planta->especie ?? 'Sin especie registrada'); ?>

                        </p>
                    </div>

                    <?php
                        $estado = strtolower($reporteProblema->estado ?? 'pendiente');
                        $gravedad = strtolower($reporteProblema->gravedad ?? 'leve');
                    ?>

                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex rounded-full px-3 py-1 text-sm font-bold
                            <?php echo e($estado === 'resuelto' ? 'bg-green-100 text-green-700' : ''); ?>

                            <?php echo e($estado === 'pendiente' ? 'bg-blue-100 text-blue-700' : ''); ?>

                            <?php echo e($estado === 'en_revision' ? 'bg-yellow-100 text-yellow-700' : ''); ?>">
                            <?php echo e(ucfirst(str_replace('_', ' ', $reporteProblema->estado ?? 'pendiente'))); ?>

                        </span>

                        <span class="inline-flex rounded-full px-3 py-1 text-sm font-bold
                            <?php echo e($gravedad === 'grave' ? 'bg-red-100 text-red-700' : ''); ?>

                            <?php echo e($gravedad === 'media' || $gravedad === 'moderada' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                            <?php echo e($gravedad === 'leve' ? 'bg-green-100 text-green-700' : ''); ?>">
                            <?php echo e(ucfirst($reporteProblema->gravedad ?? 'Leve')); ?>

                        </span>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2 mt-6">
                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Problema</p>
                        <p class="font-bold text-slate-800">
                            <?php echo e($reporteProblema->problema->nombre ?? 'Problema no disponible'); ?>

                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Fecha de reporte</p>
                        <p class="font-bold text-slate-800">
                            <?php echo e($reporteProblema->created_at ? $reporteProblema->created_at->format('d/m/Y') : 'Sin fecha'); ?>

                        </p>
                    </div>

                    <div class="md:col-span-2 rounded-xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Descripción del problema</p>
                        <p class="font-medium text-slate-800 mt-1">
                            <?php echo e($reporteProblema->descripcion ?? 'Sin descripción'); ?>

                        </p>
                    </div>
                </div>

                <?php if($reporteProblema->imagen): ?>
                    <div class="mt-6">
                        <p class="font-semibold text-slate-700 mb-2">Evidencia del problema</p>
                        <img src="<?php echo e(asset('storage/' . $reporteProblema->imagen)); ?>"
                             alt="Problema reportado"
                             class="w-72 h-72 object-cover rounded-2xl shadow border border-slate-200">
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden mb-6">
                <div class="bg-green-50 px-6 py-5 border-b border-green-100">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wide">
                                Seguimiento del problema
                            </p>

                            <h4 class="text-2xl font-bold text-slate-900 mt-1">
                                Tratamientos asignados
                            </h4>

                            <p class="text-sm text-slate-500 mt-2">
                                Aquí puedes revisar qué tratamiento corresponde, cada cuántos días debe realizarse y cuándo toca la próxima evidencia.
                            </p>
                        </div>

                        <?php if(auth()->user()->rol !== 'admin' && $reporteProblema->tratamientosReportes->count() > 0): ?>
                            <?php
                                $primerTratamiento = $reporteProblema->tratamientosReportes->first();
                            ?>

                            <button type="button"
                                    onclick="document.getElementById('form-tratamiento-general').classList.toggle('hidden')"
                                    class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 whitespace-nowrap">
                                Subir evidencia
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if(auth()->user()->rol !== 'admin' && $reporteProblema->tratamientosReportes->count() > 0): ?>
                    <?php
                        $primerTratamiento = $reporteProblema->tratamientosReportes->first();
                    ?>

                    <div id="form-tratamiento-general" class="hidden bg-white border-b border-slate-200 px-6 py-5">
                        <form method="POST"
                              action="<?php echo e(route('tratamientos-reportes.evidencia', $primerTratamiento->id)); ?>"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                                        Imagen de evidencia
                                    </label>
                                    <input type="file"
                                           name="imagen"
                                           accept="image/*"
                                           class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                                        Descripción del tratamiento realizado
                                    </label>
                                    <textarea name="descripcion"
                                              rows="3"
                                              class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
                                              placeholder="Describe qué tratamiento realizaste..."><?php echo e(old('descripcion')); ?></textarea>
                                </div>
                            </div>

                            <button type="submit"
                                    class="mt-4 inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-2.5 font-semibold text-white transition hover:bg-emerald-700">
                                Guardar evidencia
                            </button>
                        </form>
                    </div>
                <?php endif; ?>

                <?php if($reporteProblema->tratamientosReportes->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-left">
                                    <th class="px-5 py-4 text-sm font-bold text-slate-700">Tratamiento</th>
                                    <th class="px-5 py-4 text-sm font-bold text-slate-700">Indicaciones</th>
                                    <th class="px-5 py-4 text-sm font-bold text-slate-700">Frecuencia</th>
                                    <th class="px-5 py-4 text-sm font-bold text-slate-700">Próxima evidencia</th>
                                    <th class="px-5 py-4 text-sm font-bold text-slate-700">Estado</th>
                                    <th class="px-5 py-4 text-sm font-bold text-slate-700">Evidencia</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $reporteProblema->tratamientosReportes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tratamientoReporte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $estadoTratamiento = strtolower($tratamientoReporte->estado ?? 'pendiente');
                                        $fechaProxima = $tratamientoReporte->fecha_proxima;
                                        $yaToca = $fechaProxima && now()->toDateString() >= $fechaProxima;
                                    ?>

                                    <tr class="border-t border-slate-100 hover:bg-slate-50">
                                        <td class="px-5 py-4 align-top">
                                            <p class="font-bold text-slate-900">
                                                <?php echo e($tratamientoReporte->tratamiento->descripcion ?? 'Tratamiento sin descripción'); ?>

                                            </p>

                                            <?php if($tratamientoReporte->descripcion): ?>
                                                <p class="text-sm text-blue-700 mt-2">
                                                    <strong>Último registro:</strong>
                                                    <?php echo e($tratamientoReporte->descripcion); ?>

                                                </p>
                                            <?php endif; ?>
                                        </td>

                                        <td class="px-5 py-4 align-top text-slate-600">
                                            <?php echo e($tratamientoReporte->tratamiento->indicaciones ?? 'Sin indicaciones'); ?>

                                        </td>

                                        <td class="px-5 py-4 align-top">
                                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">
                                                Cada <?php echo e($tratamientoReporte->frecuencia_dias ?? 1); ?> días
                                            </span>
                                        </td>

                                        <td class="px-5 py-4 align-top">
                                            <?php if($fechaProxima): ?>
                                                <p class="font-semibold text-slate-800">
                                                    <?php echo e(\Carbon\Carbon::parse($fechaProxima)->format('d/m/Y')); ?>

                                                </p>

                                                <?php if($yaToca): ?>
                                                    <span class="inline-flex mt-2 rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                                        Ya toca
                                                    </span>
                                                <?php else: ?>
                                                    <span class="inline-flex mt-2 rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">
                                                        Próximamente
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-slate-500">No definida</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="px-5 py-4 align-top">
                                            <span class="inline-flex rounded-full px-3 py-1 text-sm font-bold
                                                <?php echo e($estadoTratamiento === 'pendiente' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                                                <?php echo e($estadoTratamiento === 'evidenciado' ? 'bg-blue-100 text-blue-700' : ''); ?>

                                                <?php echo e($estadoTratamiento === 'resuelto' ? 'bg-green-100 text-green-700' : ''); ?>">
                                                <?php echo e(ucfirst($tratamientoReporte->estado ?? 'pendiente')); ?>

                                            </span>
                                        </td>

                                        <td class="px-5 py-4 align-top">
                                            <?php if($tratamientoReporte->imagen): ?>
                                                <img src="<?php echo e(asset('storage/' . $tratamientoReporte->imagen)); ?>"
                                                     alt="Evidencia del tratamiento"
                                                     class="w-24 h-24 object-cover rounded-xl border border-slate-200 shadow-sm">
                                            <?php else: ?>
                                                <span class="text-slate-500">Sin imagen</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="p-8 text-center text-slate-500">
                        No hay tratamientos asignados para este problema.
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="flex gap-3">
                <a href="<?php if(auth()->user()->rol === 'admin'): ?><?php echo e(route('reporte-problemas.index')); ?><?php else: ?><?php echo e(route('adopciones.index')); ?><?php endif; ?>"
                   class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                    ← Volver
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