@extends('layouts.app')

@section('title', 'Détails de la tâche')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-semibold">Détails de la tâche</h2>
    <div class="mt-5">
        <p class="mb-3"><strong>Nom :</strong> {{ $task->name }}</p>
        <p class="mb-3"><strong>Description :</strong> {{ $task->description }}</p>
        <p class="mb-3"><strong>Heure de début :</strong> {{ $task->start_time }}</p>
        <p class="mb-3"><strong>Heure de fin :</strong> {{ $task->end_time }}</p>
        <p class="mb-3"><strong>Statut :</strong> {{ $task->status }}</p>
        <p class="mb-3"><strong>Assigné à :</strong> 
            @if($task->assignedTo)
                {{ $task->assignedTo->name }}
            @else
                Pas encore assigné
            @endif
        </p>
        <a href="{{ route('tasks.index') }}" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Retour aux tâches</a>
    </div>
</div>
@endsection
