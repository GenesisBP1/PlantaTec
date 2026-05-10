<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar cuidado
        </h2>
    </x-slot>

    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 1rem;
        }
        .form-card {
            background: #ffffff;
            border-radius: 28px;
            box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
            overflow: hidden;
            border: 1px solid rgba(100, 140, 110, 0.2);
        }
        .form-header {
            background: linear-gradient(115deg, #e2f0e6, #eef5ea);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(75, 130, 90, 0.2);
        }
        .form-header h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e3a2f;
            margin: 0;
        }
        .form-body {
            padding: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            font-weight: 700;
            color: #1e3a2f;
            margin-bottom: 0.5rem;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 20px;
            border: 1.5px solid #cde0d4;
            background: #ffffff;
            font-family: inherit;
            transition: all 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2b7840;
            box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.15);
        }
        .btn-primary {
            background: linear-gradient(105deg, #2b7840, #3e8a5a);
            color: white;
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 60px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary:hover {
            transform: scale(0.97);
            box-shadow: 0 8px 18px rgba(43, 120, 64, 0.3);
        }
        .btn-secondary {
            background: #e2e8f0;
            color: #2d4a3b;
            padding: 0.8rem 1.8rem;
            border-radius: 60px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-block;
        }
        .btn-secondary:hover {
            background: #cbd5e1;
        }
        .flex {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }
    </style>

    <div class="py-8">
        <div class="form-container">
            <div class="form-card">
                <div class="form-header">
                    <h3>{{ $adopcion->planta->nombre }}</h3>
                </div>
                <div class="form-body">
                    <form action="{{ route('registro-cuidados.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_adopcion" value="{{ $adopcion->id }}">

                        <div class="form-group">
                            <label>Tipo de cuidado</label>
                            <select name="id_planta_cuidado" required>
                                <option value="">Selecciona un cuidado</option>
                                @foreach($cuidados as $cuidado)
                                    <option value="{{ $cuidado->id }}" {{ isset($selectedCuidadoId) && $selectedCuidadoId == $cuidado->id ? 'selected' : '' }}>
                                        {{ $cuidado->cuidado->nombre }} (cada {{ $cuidado->frecuencia }} días)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="datetime-local" name="fecha" value="{{ old('fecha', now()->format('Y-m-d\TH:i')) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Descripción (opcional)</label>
                            <textarea name="descripcion" rows="3" placeholder="Describe la actividad realizada..."></textarea>
                        </div>

                        <div class="form-group">
                            <label>Estado observado (opcional)</label>
                            <input type="text" name="estado_observado" placeholder="Ejemplo: hojas saludables, sin plagas">
                        </div>

                        <div class="form-group">
                            <label>Imagen (evidencia)</label>
                            <input type="file" name="imagen" accept="image/*">
                            <small class="text-gray-500">Formatos permitidos: JPG, PNG, WebP (max 2MB)</small>
                        </div>

                        <div class="flex">
                            <button type="submit" class="btn-primary">
                                Guardar registro
                            </button>
                            <a href="{{ route('adopciones.show', $adopcion) }}" class="btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>