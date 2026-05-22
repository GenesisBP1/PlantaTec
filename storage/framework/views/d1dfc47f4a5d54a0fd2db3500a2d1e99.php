<?php if (isset($component)) { $__componentOriginal1f678895c2a12b0f4f8cf09d654bc82d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f678895c2a12b0f4f8cf09d654bc82d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-table','data' => ['title' => 'Gestión de Plantas','subtitle' => 'Panel de Administración','createRoute' => route('plantas.create'),'createLabel' => 'Registrar Planta','columns' => ['Nombre', 'Especie', 'Zona', 'Estado'],'rows' => $tablePlantasRows,'actions' => $tablePlantasActions,'emptyMessage' => 'No hay plantas registradas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Gestión de Plantas','subtitle' => 'Panel de Administración','createRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('plantas.create')),'createLabel' => 'Registrar Planta','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Nombre', 'Especie', 'Zona', 'Estado']),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tablePlantasRows),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tablePlantasActions),'emptyMessage' => 'No hay plantas registradas']); ?>
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
<?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/plantas/index.blade.php ENDPATH**/ ?>