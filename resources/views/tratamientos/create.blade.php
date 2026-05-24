<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Tratamientos</p>
                <h2 class="pt-header-title">Crear tratamiento</h2>
            </div>
        </div>
    </x-slot>

    <style>
        /* ========== ESTILOS ESPECÍFICOS DEL FORMULARIO DE TRATAMIENTOS ========== */
        /* (El layout base ya trae reset, navbar, colores, etc.) */
        .pt-form-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .pt-form-card {
            background: #ffffff;
            border-radius: 1.75rem;
            border: 1px solid #dbe7df;
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
            padding: 2rem;
        }
        .pt-form-intro {
            margin-bottom: 1.8rem;
        }
        .pt-form-title {
            font-size: 2rem;
            font-weight: 900;
            color: #1e3a2f;
            margin: 0.4rem 0;
        }
        .pt-form-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
        }
        .pt-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
        .pt-form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .pt-form-group.full {
            grid-column: 1 / -1;
        }
        .pt-form-group label {
            font-weight: 800;
            color: #374151;
            font-size: 0.92rem;
        }
        .pt-form-group select,
        .pt-form-group input,
        .pt-form-group textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 1rem;
            border: 1px solid #cde0d4;
            background: #ffffff;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            transition: 0.2s;
        }
        .pt-form-group select:focus,
        .pt-form-group input:focus,
        .pt-form-group textarea:focus {
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
        }
        .pt-input-inline {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .pt-input-inline input {
            width: 100px;
            flex-shrink: 0;
        }
        .pt-input-inline span {
            color: #6b7280;
            font-weight: 700;
        }
        .pt-form-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .pt-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1rem;
            border-radius: 0.9rem;
            font-size: 0.875rem;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .pt-btn-green { background: #16a34a; color: #ffffff; }
        .pt-btn-green:hover { background: #15803d; }
        .pt-btn-dark { background: #475569; color: white; }
        .pt-btn-dark:hover { background: #334155; }
        .pt-alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 1rem;
            border-radius: 1rem;
            margin: 1rem 0;
        }
        .pt-alert-error ul {
            margin: 0;
            padding-left: 1.2rem;
        }
        @media (max-width: 768px) {
            .pt-form-grid { grid-template-columns: 1fr; }
            .pt-form-card { padding: 1.25rem; }
            .pt-form-title { font-size: 1.6rem; }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo registro</p>
                    <h3 class="pt-form-title">Crear tratamiento</h3>
                    <p class="pt-form-subtitle">
                        Completa los datos para relacionar el problema con una planta, cuidado y frecuencia del tratamiento.
                    </p>
                </div>

                @if($errors->any())
                    <div class="pt-alert-error">
                        <strong>Revisa los campos del formulario:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tratamientos.store') }}" method="POST">
                    @csrf

                    <div class="pt-form-grid">
                        <div class="pt-form-group">
                            <label>Problema</label>
                            <select name="id_problema" required>
                                <option value="">Selecciona un problema</option>
                                @foreach($problemas as $problema)
                                    <option value="{{ $problema->id }}" {{ old('id_problema') == $problema->id ? 'selected' : '' }}>
                                        {{ $problema->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Planta</label>
                            <select name="id_planta">
                                <option value="" {{ old('id_planta') == null ? 'selected' : '' }}>Aplicable a cualquier planta</option>
                                @foreach($plantas as $planta)
                                    <option value="{{ $planta->id }}" {{ old('id_planta') == $planta->id ? 'selected' : '' }}>
                                        {{ $planta->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Cuidado que ayuda a resolver</label>
                            <select name="id_cuidado">
                                <option value="" {{ old('id_cuidado') == null ? 'selected' : '' }}>Sin cuidado específico</option>
                                @foreach($cuidados as $cuidado)
                                    <option value="{{ $cuidado->id }}" {{ old('id_cuidado') == $cuidado->id ? 'selected' : '' }}>
                                        {{ $cuidado->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-form-group">
                            <label>Frecuencia del tratamiento</label>
                            <div class="pt-input-inline">
                                <input type="number" name="frecuencia_dias" min="1" value="{{ old('frecuencia_dias', 1) }}" required>
                                <span>días</span>
                            </div>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Indicaciones</label>
                            <textarea name="indicaciones" rows="4">{{ old('indicaciones') }}</textarea>
                        </div>
                    </div>

                    <div class="pt-form-actions">
                        <button type="submit" class="pt-btn pt-btn-green">Guardar</button>
                        <a href="{{ route('tratamientos.index') }}" class="pt-btn pt-btn-dark">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>