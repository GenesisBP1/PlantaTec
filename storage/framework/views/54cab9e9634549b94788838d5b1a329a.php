<?php if (isset($component)) { $__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-table','data' => ['title' => 'Gestión de Problemas','subtitle' => 'Panel de Administración','createRoute' => route('problemas.create'),'createLabel' => 'Registrar Problema','columns' => ['Nombre', 'Descripción'],'rows' => $tableProblemasRows,'actions' => $tableProblemasActions,'emptyMessage' => 'No hay problemas registrados']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Gestión de Problemas','subtitle' => 'Panel de Administración','createRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('problemas.create')),'createLabel' => 'Registrar Problema','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Nombre', 'Descripción']),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableProblemasRows),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableProblemasActions),'emptyMessage' => 'No hay problemas registrados']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d)): ?>
<?php $attributes = $__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d; ?>
<?php unset($__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d)): ?>
<?php $component = $__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d; ?>
<?php unset($__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d); ?>
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/problemas/index.blade.php ENDPATH**/ ?>