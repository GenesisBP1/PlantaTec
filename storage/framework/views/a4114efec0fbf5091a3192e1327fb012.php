<?php if (isset($component)) { $__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-table','data' => ['title' => 'Asignar Cuidados','subtitle' => 'Panel de Administración','createRoute' => route('planta-cuidados.create'),'createLabel' => 'Asignar Cuidado','columns' => ['Planta', 'Cuidado', 'Frecuencia', 'Instrucciones'],'rows' => $tableAsignacionesRows,'actions' => $tableAsignacionesActions,'emptyMessage' => 'No hay cuidados asignados']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Asignar Cuidados','subtitle' => 'Panel de Administración','createRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('planta-cuidados.create')),'createLabel' => 'Asignar Cuidado','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Planta', 'Cuidado', 'Frecuencia', 'Instrucciones']),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableAsignacionesRows),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableAsignacionesActions),'emptyMessage' => 'No hay cuidados asignados']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d)): ?>
<?php $attributes = $__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d; ?>
<?php unset($__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d)): ?>
<?php $component = $__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d; ?>
<?php unset($__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d); ?>
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/planta_cuidados/index.blade.php ENDPATH**/ ?>