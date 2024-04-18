@extends('layouts.app')

@section('title', $project->name)

@section('content')
    <div class="container mx-auto">
        <a href="{{ route('projects.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3">Back to projects</a>
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <h5 class="text-lg font-semibold">{{ $project->name }}</h5>
            </div>
            <div>
                <p class="mb-2"><strong>Description:</strong> {{ $project->description }}</p>
                <p class="mb-2"><strong>Other Details:</strong> {{ $project->other_details }}</p>
                <p class="mb-2"><strong>Estimated Duration:</strong> {{ $project->estimated_duration }}</p>
                <p class="mb-2"><strong>Budget:</strong> {{ $project->budget }}</p>
                <p class="mb-2"><strong>Time Start:</strong> {{ $project->time_start }}</p>
                <a href="{{ route('projects.edit', $project) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
