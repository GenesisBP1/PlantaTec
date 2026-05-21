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
            Mis adopciones
        </h2>
     <?php $__env->endSlot(); ?>

    <style>
        /* ============================================
           Estilos renovados para la vista de adopciones
           ============================================ */
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;600;700;800&display=swap');

        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --verde-muy-claro: #f4fbf2;
            --gris-verde: #6f8f7a;
            --blanco: #ffffff;
            --sombra-suave: 0 12px 28px rgba(0, 32, 0, 0.08);
            --sombra-elevada: 0 20px 35px rgba(0, 0, 0, 0.12);
            --border-radius-card: 36px;
            --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .adopciones-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 1rem 2rem;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(125deg, #1c593f, var(--verde-medio));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .descripcion-pagina {
            font-size: 1.15rem;
            color: var(--gris-verde);
            margin-bottom: 2rem;
            border-left: 5px solid var(--verde-suave);
            padding-left: 1.2rem;
        }

        /* Filtros */
        .filtros {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
            padding: 0.8rem 1.5rem;
            border-radius: 60px;
            margin: 1.5rem 0 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            border: 1px solid rgba(75, 130, 90, 0.2);
            box-shadow: var(--sombra-suave);
        }

        .filtros select, .filtros button, .filtros a {
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            border: 1px solid #cde0d4;
            background: white;
            font-weight: 600;
            transition: var(--transition);
        }

        .filtros button, .filtros a {
            cursor: pointer;
            background: var(--verde-medio);
            color: white;
            border: none;
        }

        .filtros a {
            background: #9ca3af;
        }

        /* Tarjetas de plantas */
        .plantas-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            margin: 2rem 0 3rem;
        }

        .planta-card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            padding: 1.8rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2rem;
            box-shadow: var(--sombra-suave);
            transition: var(--transition);
            border: 1px solid rgba(100, 140, 110, 0.2);
            position: relative;
        }

        .planta-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--sombra-elevada);
        }

        .planta-img {
            width: 180px;
            height: 180px;
            border-radius: 32px;
            object-fit: cover;
            box-shadow: 0 12px 22px rgba(0, 0, 0, 0.12);
            border: 3px solid white;
            outline: 1px solid #cde0d4;
            flex-shrink: 0;
            cursor: pointer;
            transition: var(--transition);
        }

        .planta-img:hover {
            transform: scale(1.02);
        }

        .info-planta {
            flex: 2;
        }

        .info-planta h3 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .info-planta h3 a {
            text-decoration: none;
            color: var(--verde-profundo);
            transition: color 0.2s;
        }

        .info-planta h3 a:hover {
            color: var(--verde-medio);
            text-decoration: underline;
        }

        .especie {
            color: var(--verde-medio);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .cuidados-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin: 1rem 0;
        }

        .cuidado-badge {
            background: var(--verde-claro);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--verde-profundo);
        }

        .ultima-evidencia {
            margin-top: 1rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8faf6;
            padding: 0.5rem 1rem;
            border-radius: 60px;
            width: fit-content;
        }

        .ultima-evidencia img {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            object-fit: cover;
        }

        .acciones {
            text-align: center;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .btn-evidencia, .btn-problema {
            background: var(--blanco);
            border: 1.5px solid var(--verde-medio);
            color: var(--verde-medio);
            padding: 0.7rem 1.2rem;
            border-radius: 60px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Inter', sans-serif;
        }

        .btn-evidencia:hover, .btn-problema:hover {
            background: var(--verde-medio);
            color: white;
        }

        .btn-problema {
            border-color: #dc2626;
            color: #dc2626;
        }

        .btn-problema:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: white;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--blanco);
            margin: auto;
            border-radius: 36px;
            width: 90%;
            max-width: 550px;
            box-shadow: var(--sombra-elevada);
            animation: fadeSlideUp 0.3s ease;
        }

        .modal-header {
            background: var(--verde-claro);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 36px 36px 0 0;
        }

        .modal-header h4 {
            margin: 0;
            font-weight: 800;
            color: var(--verde-profundo);
        }

        .close-modal {
            font-size: 1.8rem;
            cursor: pointer;
            color: var(--verde-medio);
        }

        .modal-body {
            padding: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 0.7rem;
            border-radius: 20px;
            border: 1px solid #cde0d4;
        }

        .btn-submit {
            background: var(--verde-medio);
            color: white;
            border: none;
            padding: 0.7rem;
            border-radius: 60px;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
        }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 850px) {
            .planta-card { flex-direction: column; text-align: center; }
            .info-planta .cuidados-list { justify-content: center; }
            .ultima-evidencia { margin: 0 auto; }
            .acciones { width: 100%; }
        }
    </style>

    <div class="py-8">
        <div class="adopciones-container">
            <h1>🌱 Mis plantas adoptadas</h1>
            <p class="descripcion-pagina">Registra el cuidado diario y reporta problemas de cada planta.</p>

            <?php if(session('success')): ?>
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Filtros -->
            <form method="GET" action="<?php echo e(route('adopciones.index')); ?>" class="filtros">
                <select name="estado">
                    <option value="">Todos los estados</option>
                    <option value="activa" <?php echo e(request('estado') == 'activa' ? 'selected' : ''); ?>>Activa</option>
                    <option value="finalizada" <?php echo e(request('estado') == 'finalizada' ? 'selected' : ''); ?>>Finalizada</option>
                    <option value="cancelada" <?php echo e(request('estado') == 'cancelada' ? 'selected' : ''); ?>>Cancelada</option>
                </select>
                <button type="submit">Filtrar</button>
                <a href="<?php echo e(route('adopciones.index')); ?>">Limpiar</a>
            </form>

            <!-- Lista de adopciones -->
            <div class="plantas-list">
                <?php $__empty_1 = true; $__currentLoopData = $adopciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adopcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $planta = $adopcion->planta;
                        $cuidadosAsignados = $planta->plantaCuidados ?? collect();
                        $ultimoRegistro = $adopcion->registrosCuidados()->latest()->first();
                    ?>
                    <div class="planta-card">
                        <a href="<?php echo e(route('adopciones.show', $adopcion)); ?>">
                            <img class="planta-img" src="<?php echo e($planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=200&h=150&fit=crop'); ?>" alt="<?php echo e($planta->nombre); ?>">
                        </a>
                        
                        <div class="info-planta">
                            <h3 class="nombre-planta">
                                <a href="<?php echo e(route('adopciones.show', $adopcion)); ?>"><?php echo e($planta->nombre); ?></a>
                            </h3>
                            <div class="especie"><?php echo e($planta->especie); ?></div>
                            
                            <div class="cuidados-list">
                                <?php $__currentLoopData = $cuidadosAsignados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="cuidado-badge">
                                        <?php echo e($pc->cuidado->nombre); ?> (cada <?php echo e($pc->frecuencia); ?> días)
                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <?php if($ultimoRegistro): ?>
                                <div class="ultima-evidencia">
                                    <?php if($ultimoRegistro->imagen): ?>
                                        <img src="<?php echo e(Storage::url($ultimoRegistro->imagen)); ?>" alt="evidencia">
                                    <?php else: ?>
                                        <i class="fas fa-leaf"></i>
                                    <?php endif; ?>
                                    <span>Última evidencia: <?php echo e($ultimoRegistro->created_at->diffForHumans()); ?></span>
                                </div>
                            <?php else: ?>
                                <div class="ultima-evidencia">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Aún no hay registros de cuidado</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="acciones">
                            <button class="btn-evidencia" data-adopcion-id="<?php echo e($adopcion->id); ?>" data-planta-nombre="<?php echo e($planta->nombre); ?>">
                                <i class="fas fa-camera"></i> Subir evidencia
                            </button>

                            <a href="<?php echo e(route('reporte-problemas.create', ['adopcion_id' => $adopcion->id])); ?>" class="btn-problema">
                                <i class="fas fa-exclamation-triangle"></i> Reportar problema
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="bg-white rounded-2xl p-10 text-center text-gray-500">
                        No tienes plantas adoptadas aún. <a href="<?php echo e(route('catalogo.plantas')); ?>" class="text-green-600">¡Adopta una!</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal para registrar cuidado (igual que antes) -->
    <div id="modalCuidado" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Registrar cuidado</h4>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="formRegistroCuidado" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id_adopcion" id="modal_adopcion_id">
                    <div class="form-group">
                        <label>Tipo de cuidado</label>
                        <select name="id_planta_cuidado" id="modal_cuidado_id" required>
                            <option value="">Selecciona un cuidado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="datetime-local" name="fecha" value="<?php echo e(now()->format('Y-m-d\TH:i')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Imagen (evidencia)</label>
                        <input type="file" name="imagen" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Descripción (opcional)</label>
                        <textarea name="descripcion" rows="3" placeholder="Describe lo que hiciste..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Guardar registro</button>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script>
            document.querySelectorAll('.btn-evidencia').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const adopcionId = this.dataset.adopcionId;
                    document.getElementById('modal_adopcion_id').value = adopcionId;
                    
                    const selectCuidado = document.getElementById('modal_cuidado_id');
                    selectCuidado.innerHTML = '<option value="">Cargando...</option>';
                    
                    try {
                        const response = await fetch(`/api/plantas-cuidados/${adopcionId}`);
                        const cuidados = await response.json();
                        selectCuidado.innerHTML = '<option value="">Selecciona un cuidado</option>';
                        cuidados.forEach(c => {
                            const option = document.createElement('option');
                            option.value = c.id;
                            option.textContent = `${c.nombre} (cada ${c.frecuencia} días)`;
                            selectCuidado.appendChild(option);
                        });
                    } catch (error) {
                        selectCuidado.innerHTML = '<option value="">Error al cargar cuidados</option>';
                    }
                    
                    document.getElementById('formRegistroCuidado').action = "<?php echo e(route('registro-cuidados.store')); ?>";
                    document.getElementById('modalCuidado').style.display = 'flex';
                });
            });
            
            document.querySelector('.close-modal').onclick = () => {
                document.getElementById('modalCuidado').style.display = 'none';
            };
            window.onclick = (event) => {
                if (event.target === document.getElementById('modalCuidado')) {
                    document.getElementById('modalCuidado').style.display = 'none';
                }
            };
        </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\1\Herd\plantatec\resources\views/adopciones/index.blade.php ENDPATH**/ ?>