@extends('layouts.app')

@section('title', 'Edit ' . $project->name)

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit {{ $project->name }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('projects.update', $project) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $project->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="other_details" class="form-label">Other Details</label>
                        <textarea class="form-control" id="other_details" name="other_details" rows="3">{{ $project->other_details }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="estimated_duration" class="form-label">Estimated Duration</label>
                        <input type="text" class="form-control" id="estimated_duration" name="estimated_duration" value="{{ $project->estimated_duration }}">
                    </div>
                    <div class="mb-3">
                        <label for="budget" class="form-label">Budget</label>
                        <input type="number" class="form-control" id="budget" name="budget" value="{{ $project->budget }}" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="time_start" class="form-label">Time Start</label>
                        <input type="datetime-local" class="form-control" id="time_start" name="time_start" value="{{ $project->time_start }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
