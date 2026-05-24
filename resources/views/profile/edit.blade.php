<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Mi cuenta</p>
                <h2 class="pt-header-title">Perfil de usuario</h2>
                <p class="pt-header-subtitle">Administra tu información personal y seguridad</p>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container">
            <div class="pt-profile-grid">
                {{-- Tarjeta: Información del perfil --}}
                <div class="pt-profile-card">
                    @include('profile.partials.update-profile-information-form')
                </div>

                {{-- Tarjeta: Cambiar contraseña --}}
                <div class="pt-profile-card">
                    @include('profile.partials.update-password-form')
                </div>

                {{-- Tarjeta: Eliminar cuenta --}}
                <div class="pt-profile-card pt-profile-card-danger">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Estilos específicos para la página de perfil */
        .pt-profile-grid {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .pt-profile-card {
            background: #ffffff;
            border-radius: 1.75rem;
            border: 1px solid #eef2ee;
            box-shadow: 0 8px 20px rgba(0, 32, 0, 0.06);
            transition: all 0.2s ease;
            overflow: hidden;
        }

        .pt-profile-card:hover {
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.1);
            transform: translateY(-2px);
        }

        .pt-profile-card-danger {
            border-left: 4px solid #dc2626;
        }

        @media (max-width: 768px) {
            .pt-profile-grid {
                gap: 1.25rem;
            }
            .pt-profile-card {
                border-radius: 1.25rem;
            }
        }
    </style>
</x-app-layout>