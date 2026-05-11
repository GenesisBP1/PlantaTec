<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Editar: {{ $usuario->name }}</h2>
            <a href="{{ route('admin.usuarios.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-xl">Volver</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6">
                <form method="POST" action="{{ route('admin.usuarios.update', $usuario->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required class="w-full rounded-xl border p-2">
                        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required class="w-full rounded-xl border p-2">
                        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Rol</label>
                        <select name="rol" class="w-full rounded-xl border p-2">
                            <option value="usuario" {{ $usuario->rol === 'usuario' ? 'selected' : '' }}>Usuario</option>
                            <option value="admin" {{ $usuario->rol === 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Nueva contraseña (opcional)</label>
                        <input type="password" name="password" class="w-full rounded-xl border p-2">
                    </div>

                    <div class="mb-4">
                        <label>Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" class="w-full rounded-xl border p-2">
                    </div>

                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-xl">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>