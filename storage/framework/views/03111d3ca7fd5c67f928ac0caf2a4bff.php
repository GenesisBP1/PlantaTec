<nav x-data="{ open: false }" class="pt-navbar">
    <div class="pt-nav-container">
        <div class="pt-nav-inner">

            <div class="pt-nav-left">
                <a href="<?php echo e(route('dashboard')); ?>" class="pt-logo">
                        <div class="pt-logo-icon">
                            <img src="https://images.vexels.com/media/users/3/156912/isolated/preview/469eb48a66810702af34c5e9b0bfb3bf-icono-de-estilo-de-linea-de-amor-de-planta.png" alt="Logo" style="width:20px; height:20px; filter: brightness(0) invert(1);">
                        </div>
                        <span>PlantaTec</span>
                    </a>

                <div class="pt-desktop-menu">
                    <a href="<?php echo e(route('dashboard')); ?>" class="pt-nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                        Dashboard
                    </a>

                    <?php if(auth()->user()->rol === 'admin'): ?>
                        <div class="pt-dropdown" x-data="{ adminOpen: false }">
                            <button @click="adminOpen = !adminOpen" @click.away="adminOpen = false" class="pt-nav-link pt-dropdown-btn">
                                Administración
                                <span>⌄</span>
                            </button>

                            <div x-show="adminOpen" x-transition class="pt-dropdown-menu" style="display:none;">
                                <a href="<?php echo e(route('plantas.index')); ?>">Plantas</a>
                                <a href="<?php echo e(route('admin.usuarios.index')); ?>">Adopciones</a>
                                <a href="<?php echo e(route('ubicaciones.index')); ?>">Ubicaciones</a>
                                <a href="<?php echo e(route('cuidados.index')); ?>">Cuidados</a>
                                <a href="<?php echo e(route('planta-cuidados.index')); ?>">Asignar cuidados</a>
                                <a href="<?php echo e(route('recomendaciones-cuidado.index')); ?>">Recomendaciones de cuidado</a>
                                <a href="<?php echo e(route('recomendaciones-zona.index')); ?>">Recomendaciones de zona</a>
                                <a href="<?php echo e(route('problemas.index')); ?>">Problemas</a>
                                <a href="<?php echo e(route('tratamientos.index')); ?>">Tratamientos</a>
                                <hr>
                                <a href="<?php echo e(route('reporte-problemas.index')); ?>">Reportes de problemas</a>
                                <a href="<?php echo e(route('admin.usuarios.index')); ?>">Usuarios</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e(route('catalogo.plantas')); ?>" class="pt-nav-link <?php echo e(request()->routeIs('catalogo.plantas') ? 'active' : ''); ?>">
                            Catálogo
                        </a>

                        <a href="<?php echo e(route('adopciones.index')); ?>" class="pt-nav-link <?php echo e(request()->routeIs('adopciones.*') ? 'active' : ''); ?>">
                            Mis adopciones
                        </a>

                        <?php
                            $notificacionesNoLeidas = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count();
                        ?>

                        <a href="<?php echo e(route('notificaciones.index')); ?>" class="pt-nav-link pt-nav-notification <?php echo e(request()->routeIs('notificaciones.*') ? 'active' : ''); ?>">
                            Notificaciones
                            <?php if($notificacionesNoLeidas > 0): ?>
                                <span class="pt-nav-badge">
                                    <?php echo e($notificacionesNoLeidas > 9 ? '9+' : $notificacionesNoLeidas); ?>

                                </span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-user-menu" x-data="{ dropdownOpen: false }">
                <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="pt-user-btn">
                    <div class="pt-avatar">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>

                    <div class="pt-user-text">
                        <p><?php echo e(Auth::user()->name); ?></p>
                        <span><?php echo e(Auth::user()->rol === 'admin' ? 'Administrador' : 'Usuario'); ?></span>
                    </div>

                    <span class="pt-user-arrow">⌄</span>
                </button>

                <div x-show="dropdownOpen" x-transition class="pt-user-dropdown" style="display:none;">
                    <div class="pt-user-info">
                        <p><?php echo e(Auth::user()->name); ?></p>
                        <span><?php echo e(Auth::user()->email); ?></span>
                    </div>

                    <?php if(Route::has('profile.edit')): ?>
                        <a href="<?php echo e(route('profile.edit')); ?>">Mi perfil</a>
                    <?php else: ?>
                        <a href="#">Mi perfil</a>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit">Cerrar sesión</button>
                    </form>
                </div>
            </div>

            <button @click="open = !open" class="pt-mobile-btn">
                <span x-show="!open">☰</span>
                <span x-show="open" style="display:none;">×</span>
            </button>
        </div>
    </div>

    <div x-show="open" x-transition class="pt-mobile-menu" style="display:none;">
        <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            Dashboard
        </a>

        <?php if(auth()->user()->rol === 'admin'): ?>
            <a href="<?php echo e(route('plantas.index')); ?>">Plantas</a>
             <a href="<?php echo e(route('admin.usuarios.index')); ?>">Adopciones</a> 
            <a href="<?php echo e(route('ubicaciones.index')); ?>">Ubicaciones</a>
            <a href="<?php echo e(route('cuidados.index')); ?>">Cuidados</a>
            <a href="<?php echo e(route('planta-cuidados.index')); ?>">Asignar cuidados</a>
            <a href="<?php echo e(route('recomendaciones-cuidado.index')); ?>">Recomendaciones de cuidado</a>
            <a href="<?php echo e(route('recomendaciones-zona.index')); ?>">Recomendaciones de zona</a>
            <a href="<?php echo e(route('problemas.index')); ?>">Problemas</a>
            <a href="<?php echo e(route('tratamientos.index')); ?>">Tratamientos</a>
            <a href="<?php echo e(route('reporte-problemas.index')); ?>">Reportes de problemas</a>
            <a href="<?php echo e(route('admin.usuarios.index')); ?>">Usuarios</a>
        <?php else: ?>
            <a href="<?php echo e(route('catalogo.plantas')); ?>">Catálogo</a>
            <a href="<?php echo e(route('adopciones.index')); ?>">Mis adopciones</a>

            <?php
                $notificacionesNoLeidasMovil = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count();
            ?>

            <a href="<?php echo e(route('notificaciones.index')); ?>">
                Notificaciones
                <?php if($notificacionesNoLeidasMovil > 0): ?>
                    <span class="pt-nav-badge">
                        <?php echo e($notificacionesNoLeidasMovil > 9 ? '9+' : $notificacionesNoLeidasMovil); ?>

                    </span>
                <?php endif; ?>
            </a>
        <?php endif; ?>

        <div class="pt-mobile-user">
            <div class="pt-avatar">
                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

            </div>
            <div>
                <p><?php echo e(Auth::user()->name); ?></p>
                <span><?php echo e(Auth::user()->email); ?></span>
            </div>
        </div>

        <?php if(Route::has('profile.edit')): ?>
            <a href="<?php echo e(route('profile.edit')); ?>">Mi perfil</a>
        <?php else: ?>
            <a href="#">Mi perfil</a>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>

    <style>
        /* ============================================
           StarClass - Navbar (Morado / Fucsia)
           Coherente con la app móvil
           ============================================ */

        :root {
            --primary: #7C3AED;
            --primary-dark: #6D28D9;
            --primary-light: #A78BFA;
            --secondary: #D946EF;
            --background: #F8F4FF;
            --card-bg: #FFFFFF;
            --text-dark: #1E1B2E;
            --text-gray: #6B7280;
            --border: #E9E8F0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--background);
        }

        .pt-navbar {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary), var(--secondary));
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .pt-nav-container {
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .pt-nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 4rem;
        }

        /* Logo */
        .pt-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .pt-logo-icon {
            font-size: 1.5rem;
        }

        /* Desktop menu */
        .pt-desktop-menu {
            display: none;
            align-items: center;
            gap: 0.5rem;
            margin-left: 2rem;
        }

        @media (min-width: 768px) {
            .pt-desktop-menu {
                display: flex;
            }
        }

        .pt-nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .pt-nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .pt-nav-link.active {
            background-color: rgba(255, 255, 255, 0.25);
            font-weight: 600;
        }

        .pt-nav-notification {
            position: relative;
        }

        .pt-nav-badge {
            position: absolute;
            top: -0.25rem;
            right: -0.25rem;
            background-color: var(--warning);
            color: white;
            font-size: 0.7rem;
            font-weight: bold;
            padding: 0.1rem 0.4rem;
            border-radius: 9999px;
        }

        /* Dropdown admin */
        .pt-dropdown {
            position: relative;
        }

        .pt-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            cursor: pointer;
        }

        .pt-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            margin-top: 0.5rem;
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            min-width: 220px;
            z-index: 10;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .pt-dropdown-menu a {
            display: block;
            padding: 0.6rem 1rem;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 0.875rem;
            transition: background 0.2s;
        }

        .pt-dropdown-menu a:hover {
            background-color: var(--primary-light);
            color: white;
        }

        .pt-dropdown-menu hr {
            margin: 0.5rem 0;
            border-color: var(--border);
        }

        /* User menu */
        .pt-user-menu {
            position: relative;
            display: none;
        }

        @media (min-width: 768px) {
            .pt-user-menu {
                display: block;
            }
        }

        .pt-user-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: background 0.2s;
        }

        .pt-user-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .pt-avatar {
            width: 2rem;
            height: 2rem;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .pt-user-text {
            text-align: left;
            color: white;
        }

        .pt-user-text p {
            font-size: 0.875rem;
            font-weight: 600;
            margin: 0;
        }

        .pt-user-text span {
            font-size: 0.7rem;
            opacity: 0.8;
        }

        .pt-user-arrow {
            color: white;
            font-size: 0.8rem;
        }

        .pt-user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            min-width: 220px;
            z-index: 10;
            border: 1px solid var(--border);
        }

        .pt-user-info {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .pt-user-info p {
            font-weight: bold;
            color: var(--text-dark);
            margin: 0;
        }

        .pt-user-info span {
            font-size: 0.75rem;
            color: var(--text-gray);
        }

        .pt-user-dropdown a,
        .pt-user-dropdown button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 0.875rem;
            background: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .pt-user-dropdown a:hover,
        .pt-user-dropdown button:hover {
            background-color: var(--primary-light);
            color: white;
        }

        /* Mobile button */
        .pt-mobile-btn {
            display: block;
            background: none;
            border: none;
            font-size: 1.8rem;
            color: white;
            cursor: pointer;
        }

        @media (min-width: 768px) {
            .pt-mobile-btn {
                display: none;
            }
        }

        /* Mobile menu */
        .pt-mobile-menu {
            display: flex;
            flex-direction: column;
            background-color: white;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            gap: 0.5rem;
        }

        .pt-mobile-menu a,
        .pt-mobile-menu button {
            display: block;
            padding: 0.75rem;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: background 0.2s;
            text-align: left;
            background: none;
            border: none;
            width: 100%;
            cursor: pointer;
        }

        .pt-mobile-menu a.active {
            background-color: var(--primary-light);
            color: white;
            font-weight: 600;
        }

        .pt-mobile-menu a:hover,
        .pt-mobile-menu button:hover {
            background-color: var(--primary-light);
            color: white;
        }

        .pt-mobile-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-top: 1px solid var(--border);
            margin-top: 0.5rem;
        }

        .pt-mobile-user .pt-avatar {
            background-color: var(--primary);
            color: white;
        }

        .pt-mobile-user p {
            font-weight: bold;
            margin: 0;
        }

        .pt-mobile-user span {
            font-size: 0.7rem;
            color: var(--text-gray);
        }
    </style>
</nav><?php /**PATH C:\Users\Admin\Documents\8\Prog de backend\Laravel Herd\PlantaTec\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>