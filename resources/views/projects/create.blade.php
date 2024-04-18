@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Create Project</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Project Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="other_details" class="form-label">Other Details</label>
                    <textarea class="form-control" id="other_details" name="other_details" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="estimated_duration" class="form-label">Estimated Duration</label>
                    <input type="text" class="form-control" id="estimated_duration" name="estimated_duration">
                </div>
                <div class="mb-3">
                    <label for="budget" class="form-label">Budget</label>
                    <input type="number" class="form-control" id="budget" name="budget" step="0.01">
                </div>
                <div class="mb-3">
                    <label for="time_start" class="form-label">Time Start</label>
                    <input type="datetime-local" class="form-control" id="time_start" name="time_start">
                </div>
                <button type="submit" class="btn btn-primary">Create Project</button>
            </form>
        </div>
    </div>
</div>
@endsection
