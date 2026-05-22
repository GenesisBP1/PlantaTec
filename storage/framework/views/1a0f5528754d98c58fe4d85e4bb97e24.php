<?php if (isset($component)) { $__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-table','data' => ['title' => 'Zonas Públicas Recomendadas','subtitle' => 'Panel de Administración','createRoute' => route('recomendaciones-zona.create'),'createLabel' => 'Nueva Zona','columns' => ['Nombre', 'Tipo', 'Descripción', 'Coordenadas'],'rows' => $tableZonasRows,'actions' => $tableZonasActions,'emptyMessage' => 'No hay zonas registradas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Zonas Públicas Recomendadas','subtitle' => 'Panel de Administración','createRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('recomendaciones-zona.create')),'createLabel' => 'Nueva Zona','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Nombre', 'Tipo', 'Descripción', 'Coordenadas']),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableZonasRows),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableZonasActions),'emptyMessage' => 'No hay zonas registradas']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d)): ?>
<?php $attributes = $__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d; ?>
<?php unset($__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d)): ?>
<?php $component = $__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d; ?>
<?php unset($__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d); ?>
<?php endif; ?>
<?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/recomendaciones-zona/index.blade.php ENDPATH**/ ?>