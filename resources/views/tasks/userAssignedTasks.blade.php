<!-- resources/views/tasks/userAssignedTasks.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Assigned Tasks</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Project</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignedTasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->project->name }}</td>
                                    <td>
                                        @if ($task->status == 'assigned')
                                            <form action="{{ route('tasks.start', $task->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Start Task</button>
                                            </form>
                                        @elseif ($task->status == 'started')
                                            <form action="{{ route('tasks.finish', $task->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Finish Task</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection