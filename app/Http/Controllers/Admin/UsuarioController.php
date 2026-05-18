<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Adopcion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::latest()->get();
        
        // Preparar datos para la tabla
        $tableUsuariosRows = $usuarios->map(function($usuario) {
            $rolClass = $usuario->rol === 'admin' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300' : 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300';
            $rolText = $usuario->rol === 'admin' ? 'Admin' : 'Usuario';
            $inicial = strtoupper(substr($usuario->name, 0, 1));
            return [
                '<div class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-bold text-sm">' . $inicial . '</div><span class="font-medium">' . $usuario->name . '</span></div>',
                $usuario->email,
                '<span class="inline-block px-3 py-1 rounded-full text-xs font-semibold ' . $rolClass . '">' . $rolText . '</span>',
                $usuario->created_at->format('d/m/Y'),
            ];
        })->toArray();
        
        $tableUsuariosActions = $usuarios->map(function($usuario) {
            $actions = [
                'view' => route('admin.usuarios.show', $usuario->id),
                'edit' => route('admin.usuarios.edit', $usuario->id),
            ];
            if (auth()->id() !== $usuario->id) {
                $actions['delete'] = route('admin.usuarios.destroy', $usuario->id);
            }
            return $actions;
        })->toArray();
        
        return view('admin.usuarios.index', compact('usuarios', 'tableUsuariosRows', 'tableUsuariosActions'));
    }

    /**
     * Mostrar formulario para crear nuevo usuario
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Guardar nuevo usuario en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'rol' => 'required|in:admin,usuario',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        $adopciones = Adopcion::where('id_usuario', $id)
            ->with('planta')
            ->latest()
            ->paginate(10);
        
        return view('admin.usuarios.show', compact('usuario', 'adopciones'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'rol' => 'required|in:admin,usuario',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}