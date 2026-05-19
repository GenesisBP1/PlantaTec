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
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
            🌿 Catálogo de Plantas
        </h2>
     <?php $__env->endSlot(); ?>

    <style>
        /* ===== Estilos para el catálogo (adaptados del diseño de referencia) ===== */
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap');

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
            --border-radius-card: 28px;
            --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .catalogo-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 1rem 2rem;
        }

        .catalogo-header p {
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

        .filtros input, .filtros select {
            padding: 0.7rem 1.2rem;
            border-radius: 40px;
            border: 1px solid #cde0d4;
            background: white;
            outline: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
            font-family: 'Inter', sans-serif;
        }

        .filtros input:focus, .filtros select:focus {
            border-color: var(--verde-medio);
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
        }

        /* Grid 3 columnas */
        .grid-plantas {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin: 2rem 0 3rem;
        }

        /* Tarjetas */
        .card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            overflow: hidden;
            box-shadow: var(--sombra-suave);
            transition: var(--transition);
            border: 1px solid rgba(100, 140, 110, 0.2);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--sombra-elevada);
            border-color: rgba(75, 130, 90, 0.4);
        }

        .card img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            transition: var(--transition);
            border-bottom: 2px solid var(--verde-claro);
        }

        .card:hover img {
            transform: scale(1.02);
        }

        .card-body {
            padding: 1.2rem 1.2rem 1.5rem;
        }

        .card-body h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--verde-profundo);
            margin-bottom: 0.3rem;
            letter-spacing: -0.3px;
        }

        .zona {
            font-size: 0.75rem;
            font-weight: 600;
            background: var(--verde-claro);
            display: inline-block;
            padding: 0.3rem 1rem;
            border-radius: 40px;
            margin: 0.6rem 0;
            color: var(--verde-medio);
        }

        .card-body p {
            font-size: 0.9rem;
            color: var(--gris-verde);
            margin-bottom: 1.2rem;
            line-height: 1.4;
        }

        .btn-adoptar {
            background: linear-gradient(105deg, var(--verde-medio), #3e8a5a);
            color: white;
            border: none;
            padding: 0.7rem 1rem;
            border-radius: 60px;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
        }

        .btn-adoptar:hover {
            background: linear-gradient(105deg, #236a3b, #2b7840);
            transform: scale(0.97);
            box-shadow: 0 8px 18px rgba(43, 120, 64, 0.3);
        }

        /* Responsive */
        @media (max-width: 950px) {
            .grid-plantas { grid-template-columns: repeat(2, 1fr); gap: 1.8rem; }
        }
        @media (max-width: 650px) {
            .grid-plantas { grid-template-columns: 1fr; max-width: 400px; margin-left: auto; margin-right: auto; }
            .card img { height: 190px; }
        }
        @media (max-width: 480px) {
            .catalogo-container { padding: 0 1rem; }
            .card img { height: 170px; }
        }

        /* Animación */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card { animation: fadeSlideUp 0.4s cubic-bezier(0.2, 0.9, 0.3, 1) backwards; }
        .card:nth-child(1) { animation-delay: 0.02s; }
        .card:nth-child(2) { animation-delay: 0.05s; }
        .card:nth-child(3) { animation-delay: 0.08s; }
        .card:nth-child(4) { animation-delay: 0.11s; }
        .card:nth-child(5) { animation-delay: 0.14s; }
        .card:nth-child(6) { animation-delay: 0.17s; }
    </style>

    <div class="py-8">
        <div class="catalogo-container">
            <div class="catalogo-header">
                <p>Explora y adopta plantas según tu entorno. 🌱</p>
            </div>

            <!-- Barra de búsqueda y filtros (solo visual) -->
            <div class="filtros">
                <input type="text" placeholder="🔍 Buscar por nombre...">
                <select>
                    <option>Todas las zonas</option>
                    <option>Interior</option>
                    <option>Exterior</option>
                    <option>Clima seco</option>
                    <option>Clima húmedo</option>
                </select>
            </div>

            <!-- Grid de plantas -->
            <div class="grid-plantas">
                <?php $__empty_1 = true; $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="card">
                        <img src="<?php echo e($planta->imagen ?? 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&h=200&fit=crop'); ?>" 
                             alt="<?php echo e($planta->nombre); ?>">
                        <div class="card-body">
                            <h3><?php echo e($planta->nombre); ?></h3>
                            <span class="zona"><?php echo e($planta->tipo_zona ?? 'Zona no especificada'); ?></span>
                            <p><?php echo e(Str::limit($planta->descripcion, 80)); ?></p>
                            <a href="<?php echo e(route('catalogo.plantas.show', $planta)); ?>" class="btn-adoptar">
                                <i class="fas fa-hand-holding-heart"></i> Ver y adoptar
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-3 text-center py-10 text-gray-500">
                        No hay plantas disponibles en el catálogo.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Incluir FontAwesome si no está en el layout -->
    <?php $__env->startPush('scripts'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
<?php endif; ?><?php /**PATH C:\Users\vluis\Herd\PlantaTec\resources\views/catalogo/index.blade.php ENDPATH**/ ?>