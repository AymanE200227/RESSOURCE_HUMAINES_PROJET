<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::all(); // Fetch all projects
        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date',
            'project_id' => 'required|exists:projects,id',
        ]);

        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date',
        ]);

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function startTask(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->users()->updateExistingPivot(auth()->user()->id, [
            'started' => true,
            'start_time' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Task started successfully.');
    }
    
    public function finishTask(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->users()->updateExistingPivot(auth()->user()->id, [
            'finished' => true,
            'end_time' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Task finished successfully.');
    }

    public function assignPage(Task $task)
    {
        $users = User::all();
        return view('tasks.assign', compact('task', 'users'));
    }
    
    public function assign(Request $request)
    {
        $validatedData = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $task = Task::findOrFail($validatedData['task_id']);
        $task->assigned_to = $validatedData['user_id'];
        $task->status = 'assigned';
        $task->save();
        
        return redirect()->route('tasks.index')->with('success', 'Task assigned successfully.');
    }
    
    public function doTask()
    {
        $userId = Auth::id(); // Retrieve the currently authenticated user's ID
    
        $assignedTasks = Task::whereHas('assignedToUser', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->get();
    
        return view('tasks.assigned', compact('assignedTasks'));
    }
    
   
    
public function assignedTasks()
{
    $tasks = Task::where('assigned_to', auth()->user()->id)
                ->whereIn('status', ['assigned', 'started'])
                ->with('project')
                ->orderBy('status', 'asc')
                ->get();

    return view('tasks.assigned', compact('tasks'));
}

}
