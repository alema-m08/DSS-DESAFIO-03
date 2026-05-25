<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tareas()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
        ]);

        Auth::user()->tareas()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('dashboard')->with('success', '¡Tarea creada exitosamente!');
    }

    public function edit($id)
    {
        $task = Auth::user()->tareas()->findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Auth::user()->tareas()->findOrFail($id);

        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['required', 'in:pendiente,completada'],
        ]);

        $task->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('dashboard')->with('success', '¡Tarea actualizada exitosamente!');
    }

    public function destroy($id)
    {
        $task = Auth::user()->tareas()->findOrFail($id);
        $task->delete();

        return redirect()->route('dashboard')->with('success', '¡Tarea eliminada exitosamente!');
    }

    public function toggle(Request $request, $id)
    {
        $task = Auth::user()->tareas()->findOrFail($id);
        
        $newStatus = ($task->estado === 'pendiente') ? 'completada' : 'pendiente';
        $task->estado = $newStatus;
        $task->save();

        if ($request->wantsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'estado' => $newStatus,
                'message' => 'El estado de la tarea ha sido actualizado.'
            ]);
        }

        return redirect()->route('dashboard')->with('success', '¡Estado de tarea actualizado!');
    }
}
