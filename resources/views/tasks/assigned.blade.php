<!-- resources/views/tasks/assigned.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Assigned Tasks</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Project</th>
                                <th>Started</th>
                                <th>Finished</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignedTasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->project->name }}</td>
                                    <td>
                                        @if ($task->users()->where('user_id', Auth::id())->whereNotNull('start_time')->exists())
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>
                                        @if ($task->users()->where('user_id', Auth::id())->whereNotNull('end_time')->exists())
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('home') }}" class="btn btn-secondary">Back to home </a>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection