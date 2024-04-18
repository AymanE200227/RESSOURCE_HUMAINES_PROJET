@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Projects</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Create Project</a>
                <a href="{{ route('tasks.index') }}" class="btn btn-success mb-3">Manage Tasks</a>
                @if ($projects->isEmpty())
                    <p>No projects found.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Other Details</th>
                                <th>Estimated Duration</th>
                                <th>Budget</th>
                                <th>Time Start</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>{{ $project->other_details }}</td>
                                    <td>{{ $project->estimated_duration }}</td>
                                    <td>{{ $project->budget }}</td>
                                    <td>{{ $project->time_start }}</td>
                                    <td>
                                        <a href="{{ route('projects.show', $project) }}" class="btn btn-info">View</a>
                                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
