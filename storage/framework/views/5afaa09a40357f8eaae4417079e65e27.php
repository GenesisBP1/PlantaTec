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
        <div>
            <p class="text-sm font-bold tracking-[0.25em] text-green-600 uppercase">
                Panel de administración
            </p>
            <h2 class="font-bold text-3xl text-gray-900 leading-tight mt-1">
                Adopciones
            </h2>
            <p class="text-gray-500 mt-2">
                Vista general de usuarios, plantas adoptadas, registros de cuidado y problemas resueltos.
            </p>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        .admin-adopciones-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .card-admin {
            background: white;
            border-radius: 28px;
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-admin-header {
            background: linear-gradient(135deg, #ecfdf5, #f7fee7);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #dbeafe;
        }

        .card-admin-header h3 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #143d2d;
            margin: 0;
        }

        .card-admin-header p {
            color: #64748b;
            margin-top: 0.3rem;
        }

        .table-admin {
            width: 100%;
            border-collapse: collapse;
        }

        .table-admin th {
            background: #f0fdf4;
            color: #1f2937;
            text-align: left;
            padding: 1rem 1.2rem;
            font-weight: 800;
        }

        .table-admin td {
            padding: 1rem 1.2rem;
            border-top: 1px solid #f1f5f9;
            color: #334155;
            vertical-align: top;
        }

        .table-admin tr:hover {
            background: #f8fafc;
        }

        .badge {
            display: inline-flex;
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 800;
        }

        .badge-green {
            background: #dcfce7;
            color: #166534;
        }

        .badge-blue {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-yellow {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-red {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-ver {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            background: #16a34a;
            color: white;
            padding: 0.55rem 1rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-ver:hover {
            background: #15803d;
            transform: translateY(-1px);
        }

        .btn-secundario {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            background: #64748b;
            color: white;
            padding: 0.55rem 1rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-secundario:hover {
            background: #475569;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
        }

        .stat-card span {
            display: block;
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }

        .stat-card strong {
            font-size: 2rem;
            color: #143d2d;
        }

        .empty-state {
            padding: 2rem;
            text-align: center;
            color: #64748b;
        }

        @media (max-width: 900px) {
            .admin-adopciones-container {
                padding: 1rem;
            }

            .table-admin,
            .table-admin thead,
            .table-admin tbody,
            .table-admin th,
            .table-admin td,
            .table-admin tr {
                display: block;
            }

            .table-admin thead {
                display: none;
            }

            .table-admin tr {
                margin: 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 18px;
                overflow: hidden;
                background: white;
            }

            .table-admin td {
                display: flex;
                justify-content: space-between;
                gap: 1rem;
            }

            .table-admin td::before {
                content: attr(data-label);
                font-weight: 800;
                color: #143d2d;
            }
        }
    </style>

    <div class="admin-adopciones-container">

        <?php
            $totalUsuarios = $resumenUsuarios->count();
            $totalPlantas = $resumenUsuarios->sum('total_plantas');
            $totalRegistros = $resumenUsuarios->sum('total_registros');
            $totalResueltos = $resumenUsuarios->sum('problemas_resueltos');
        ?>

        <div class="stats-grid">
            <div class="stat-card">
                <span>Usuarios con adopciones</span>
                <strong><?php echo e($totalUsuarios); ?></strong>
            </div>

            <div class="stat-card">
                <span>Plantas adoptadas</span>
                <strong><?php echo e($totalPlantas); ?></strong>
            </div>

            <div class="stat-card">
                <span>Registros de cuidado</span>
                <strong><?php echo e($totalRegistros); ?></strong>
            </div>

            <div class="stat-card">
                <span>Problemas resueltos</span>
                <strong><?php echo e($totalResueltos); ?></strong>
            </div>
        </div>

        
        <div class="card-admin">
            <div class="card-admin-header">
                <h3>Usuarios y adopciones</h3>
                <p>Listado general de usuarios con sus plantas, registros y problemas.</p>
            </div>

            <?php if($resumenUsuarios->count() > 0): ?>
                <div class="overflow-x-auto">
                    <table class="table-admin">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Plantas adoptadas</th>
                                <th>Registros</th>
                                <th>Problemas</th>
                                <th>Resueltos</th>
                                <th>Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $resumenUsuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-label="Usuario">
                                        <strong><?php echo e($usuario['nombre']); ?></strong>
                                    </td>

                                    <td data-label="Correo">
                                        <?php echo e($usuario['email']); ?>

                                    </td>

                                    <td data-label="Plantas adoptadas">
                                        <span class="badge badge-green">
                                            <?php echo e($usuario['total_plantas']); ?>

                                        </span>
                                    </td>

                                    <td data-label="Registros">
                                        <span class="badge badge-blue">
                                            <?php echo e($usuario['total_registros']); ?>

                                        </span>
                                    </td>

                                    <td data-label="Problemas">
                                        <span class="badge badge-yellow">
                                            <?php echo e($usuario['total_problemas']); ?>

                                        </span>
                                    </td>

                                    <td data-label="Resueltos">
                                        <span class="badge badge-green">
                                            <?php echo e($usuario['problemas_resueltos']); ?>

                                        </span>
                                    </td>

                                    <td data-label="Acción">
                                        <a href="<?php echo e(route('adopciones.index', ['usuario_id' => $usuario['usuario_id']])); ?>"
                                           class="btn-ver">
                                            Ver detalle
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    No hay usuarios con adopciones registradas.
                </div>
            <?php endif; ?>
        </div>

        
        <?php if($usuarioSeleccionado): ?>
            <div class="card-admin">
                <div class="card-admin-header">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3>Detalle de <?php echo e($usuarioSeleccionado->name); ?></h3>
                            <p><?php echo e($usuarioSeleccionado->email); ?></p>
                        </div>

                        <a href="<?php echo e(route('adopciones.index')); ?>" class="btn-secundario">
                            Limpiar selección
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <h4 class="text-xl font-bold text-green-900 mb-4">
                        Plantas adoptadas
                    </h4>

                    <?php if($adopcionesUsuarioSeleccionado->count() > 0): ?>
                        <div class="overflow-x-auto mb-8">
                            <table class="table-admin">
                                <thead>
                                    <tr>
                                        <th>Planta</th>
                                        <th>Especie</th>
                                        <th>Ubicación</th>
                                        <th>Fecha de adopción</th>
                                        <th>Cuidados registrados</th>
                                        <th>Problemas resueltos</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $adopcionesUsuarioSeleccionado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adopcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $fechaAdopcion = $adopcion->fecha_adopcion ?? $adopcion->created_at;
                                            $problemasResueltos = $adopcion->reportesProblemas
                                                ->where('estado', 'resuelto')
                                                ->count();
                                        ?>

                                        <tr>
                                            <td data-label="Planta">
                                                <strong><?php echo e($adopcion->planta->nombre ?? 'Planta no disponible'); ?></strong>
                                            </td>

                                            <td data-label="Especie">
                                                <?php echo e($adopcion->planta->especie ?? 'Sin especie'); ?>

                                            </td>

                                            <td data-label="Ubicación">
                                                <?php echo e($adopcion->ubicacion->nombre_lugar ?? 'No registrada'); ?>

                                            </td>

                                            <td data-label="Fecha de adopción">
                                                <?php echo e($fechaAdopcion ? \Carbon\Carbon::parse($fechaAdopcion)->format('d/m/Y') : 'Sin fecha'); ?>

                                            </td>

                                            <td data-label="Cuidados registrados">
                                                <span class="badge badge-blue">
                                                    <?php echo e($adopcion->registrosCuidados->count()); ?>

                                                </span>
                                            </td>

                                            <td data-label="Problemas resueltos">
                                                <span class="badge badge-green">
                                                    <?php echo e($problemasResueltos); ?>

                                                </span>
                                            </td>

                                            <td data-label="Acción">
                                                <a href="<?php echo e(route('adopciones.show', $adopcion)); ?>" class="btn-ver">
                                                    Ver planta
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            Este usuario no tiene plantas adoptadas.
                        </div>
                    <?php endif; ?>

                    <h4 class="text-xl font-bold text-green-900 mb-4">
                        Historial general de cuidados
                    </h4>

                    <?php if($historialCuidados->count() > 0): ?>
                        <div class="overflow-x-auto">
                            <table class="table-admin">
                                <thead>
                                    <tr>
                                        <th>Planta</th>
                                        <th>Cuidado</th>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Estado observado</th>
                                        <th>Evidencia</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $historialCuidados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td data-label="Planta">
                                                <strong><?php echo e($registro->adopcion_original->planta->nombre ?? 'Planta no disponible'); ?></strong>
                                            </td>

                                            <td data-label="Cuidado">
                                                <?php echo e($registro->plantaCuidado->cuidado->nombre ?? 'Cuidado no disponible'); ?>

                                            </td>

                                            <td data-label="Fecha">
                                                <?php echo e($registro->fecha ? \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y H:i') : 'Sin fecha'); ?>

                                            </td>

                                            <td data-label="Descripción">
                                                <?php echo e($registro->descripcion ?? 'Sin descripción'); ?>

                                            </td>

                                            <td data-label="Estado observado">
                                                <?php echo e($registro->estado_observado ?? 'No registrado'); ?>

                                            </td>

                                            <td data-label="Evidencia">
                                                <?php if($registro->imagen): ?>
                                                    <img src="<?php echo e(asset('storage/' . $registro->imagen)); ?>"
                                                         alt="Evidencia"
                                                         class="w-20 h-20 object-cover rounded-xl border shadow-sm">
                                                <?php else: ?>
                                                    <span class="text-gray-500">Sin imagen</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            Este usuario todavía no tiene historial de cuidados.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\danie\Herd\PlantaTec\resources\views/adopciones/index.blade.php ENDPATH**/ ?>