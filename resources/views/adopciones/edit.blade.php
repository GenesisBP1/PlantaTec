<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar adopción</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; background: #f6f8f5; color: #1f2937; margin: 0; }
        .container { max-width: 900px; margin: 2rem auto; background: #fff; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 8px 24px rgba(0,0,0,0.06); }
        label { display:block; margin-top: 0.75rem; font-weight:700; }
        select, input[type="text"] { width:100%; padding:0.6rem; border-radius:0.5rem; border:1px solid #e5e7eb; }
        .btn { margin-top:1rem; padding:0.8rem 1rem; background:#16a34a; color:#fff; border:none; border-radius:0.6rem; font-weight:800; cursor:pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar adopción #{{ $adopcion->id }}</h2>

        <form method="POST" action="{{ route('adopciones.update', $adopcion->id) }}">
            @csrf
            @method('PUT')

            <label for="id_ubicacion">Ubicación</label>
            <select name="id_ubicacion" id="id_ubicacion">
                <option value="">-- Seleccionar ubicación --</option>
                @foreach($ubicaciones as $u)
                    <option value="{{ $u->id }}" {{ optional($adopcion->ubicacion)->id == $u->id ? 'selected' : '' }}>
                        {{ $u->nombre_lugar }} @if($u->es_publica) (Pública) @else (Privada) @endif
                    </option>
                @endforeach
            </select>

            <label for="estado_adopcion">Estado de la adopción</label>
            <select name="estado_adopcion" id="estado_adopcion" required>
                <option value="activa" {{ $adopcion->estado_adopcion === 'activa' ? 'selected' : '' }}>Activa</option>
                <option value="cancelada" {{ $adopcion->estado_adopcion === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                <option value="finalizada" {{ $adopcion->estado_adopcion === 'finalizada' ? 'selected' : '' }}>Finalizada</option>
            </select>

            <button class="btn" type="submit">Guardar cambios</button>
        </form>
    </div>
</body>
</html>
