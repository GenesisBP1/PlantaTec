<?php if (isset($component)) { $__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-table','data' => ['title' => 'Recomendaciones de Cuidado','subtitle' => 'Panel de Administración','createRoute' => route('recomendaciones-cuidado.create'),'createLabel' => 'Registrar Recomendación','columns' => ['Planta', 'Cuidado', 'Mensaje', 'Prioridad', 'Estado'],'rows' => $tableRecomendacionesRows,'actions' => $tableRecomendacionesActions,'emptyMessage' => 'No hay recomendaciones generadas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Recomendaciones de Cuidado','subtitle' => 'Panel de Administración','createRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('recomendaciones-cuidado.create')),'createLabel' => 'Registrar Recomendación','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Planta', 'Cuidado', 'Mensaje', 'Prioridad', 'Estado']),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableRecomendacionesRows),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableRecomendacionesActions),'emptyMessage' => 'No hay recomendaciones generadas']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d)): ?>
<?php $attributes = $__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d; ?>
<?php unset($__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d)): ?>
<?php $component = $__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d; ?>
<?php unset($__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d); ?>
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/recomendaciones_cuidado/index.blade.php ENDPATH**/ ?>