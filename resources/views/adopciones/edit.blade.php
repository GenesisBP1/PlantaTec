<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StarClass · Editar adopción</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <style>
        /* ============================================
           StarClass Theme – Editar Adopción
           Paleta: morado #7C3AED, fucsia #D946EF
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
            --success: #10B981;
            --warning: #F59E0B;
            --error: #EF4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', 'Figtree', sans-serif;
            background: var(--background);
            color: var(--text-dark);
            padding: 2rem 1rem;
            min-height: 100vh;
        }

        .star-container {
            max-width: 700px;
            margin: 0 auto;
        }

        /* Tarjeta principal */
        .star-card {
            background: var(--card-bg);
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            border: 1px solid var(--border);
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        /* Cabecera con gradiente */
        .star-card-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary), var(--secondary));
            padding: 1.5rem 2rem;
            color: white;
        }

        .star-card-header h2 {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0;
        }

        .star-card-header p {
            font-size: 0.875rem;
            opacity: 0.85;
            margin-top: 0.25rem;
        }

        /* Cuerpo del formulario */
        .star-card-body {
            padding: 2rem;
        }

        /* Grupos de formulario */
        .star-form-group {
            margin-bottom: 1.5rem;
        }

        .star-form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .star-form-group select,
        .star-form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #F9F7FF;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            font-size: 0.9rem;
            color: var(--text-dark);
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .star-form-group select:focus,
        .star-form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        /* Botón */
        .star-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--primary);
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 0.75rem;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .star-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        }

        /* Mensajes de error */
        .star-error {
            background: #FEE2E2;
            border-left: 4px solid var(--error);
            color: #991B1B;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .star-error ul {
            margin: 0.5rem 0 0 1.5rem;
        }

        /* Responsive */
        @media (max-width: 640px) {
            body {
                padding: 1rem;
            }
            .star-card-header h2 {
                font-size: 1.5rem;
            }
            .star-card-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="star-container">
        <div class="star-card">
            <div class="star-card-header">
                <h2>Editar adopción</h2>
                <p>Actualiza la ubicación o el estado de la adopción</p>
            </div>

            <div class="star-card-body">
                @if($errors->any())
                    <div class="star-error">
                        <strong>Revisa los campos:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('adopciones.update', $adopcion->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="star-form-group">
                        <label for="id_ubicacion">Ubicación</label>
                        <select name="id_ubicacion" id="id_ubicacion">
                            <option value="">-- Seleccionar ubicación --</option>
                            @foreach($ubicaciones as $u)
                                <option value="{{ $u->id }}" {{ optional($adopcion->ubicacion)->id == $u->id ? 'selected' : '' }}>
                                    {{ $u->nombre_lugar }} @if($u->es_publica) (Pública) @else (Privada) @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="star-form-group">
                        <label for="estado_adopcion">Estado de la adopción</label>
                        <select name="estado_adopcion" id="estado_adopcion" required>
                            <option value="activa" {{ $adopcion->estado_adopcion === 'activa' ? 'selected' : '' }}>Activa</option>
                            <option value="cancelada" {{ $adopcion->estado_adopcion === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            <option value="finalizada" {{ $adopcion->estado_adopcion === 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                        </select>
                    </div>

                    <button type="submit" class="star-btn">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>