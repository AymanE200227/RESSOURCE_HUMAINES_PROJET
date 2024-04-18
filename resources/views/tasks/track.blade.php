@extends('layouts.app')

@section('title', 'Track Task Status')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Track Task Status</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
