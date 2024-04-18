<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:projects|max:255',
            'description' => 'required',
            'other_details' => 'nullable',
            'estimated_duration' => 'nullable',
            'budget' => 'nullable|numeric',
            'time_start' => 'nullable|date',
        ]);
    
        $project = Project::create($validatedData);
    
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }
    

    public function show(Project $project)
    {
        $tasks = $project->tasks()->orderBy('created_at', 'asc')->get();
        return view('projects.show', compact('project', 'tasks'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:projects,name,' . $project->id . '|max:255',
            'description' => 'required',
            'other_details' => 'nullable',
            'estimated_duration' => 'nullable',
            'budget' => 'nullable|numeric',
            'time_start' => 'nullable|date',
        ]);
    
        $project->update($validatedData);
    
        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }
    

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function assignTask(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'user_id' => 'required|exists:users,id',
            // Add more validation rules as needed
        ]);

        $task = Task::find($validatedData['task_id']);
        $user = User::find($validatedData['user_id']);

        $user->tasks()->attach($task);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Task assigned successfully.');
    }

    public function evaluateUser(User $user)
    {
        // Calculate the user's work percentage and adherence to task duration
        // Logic to calculate performance metrics goes here

        // Return the evaluation view with the calculated metrics
        return view('projects.evaluate', compact('user', 'workPercentage', 'taskAdherence'));
    }
}
