@extends('layouts.app')

@section('title', 'Tâches')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-semibold">Tâches</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-3">{{ __('Créer une tâche') }}</a>
    <div class="mt-5">
        @if ($tasks->isEmpty())
            <p class="text-gray-600">{{ __('Aucune tâche trouvée.') }}</p>
        @else
            <table class="table-auto w-full mt-5">
                <thead>
                    <tr>
                        <th class="px-4 py-2">{{ __('ID') }}</th>
                        <th class="px-4 py-2">{{ __('Nom') }}</th>
                        <th class="px-4 py-2">{{ __('Description') }}</th>
                        <th class="px-4 py-2">{{ __('Statut') }}</th>
                        <th class="px-4 py-2">{{ __('Actions') }}</th>
                        <th class="px-4 py-2">{{ __('Assigner') }}</th> <!-- New column for assigning task -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="px-4 py-2">{{ $task->id }}</td>
                            <td class="px-4 py-2">{{ $task->name }}</td>
                            <td class="px-4 py-2">{{ $task->description }}</td>
                            <td class="px-4 py-2">{{ $task->status }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">{{ __('Voir') }}</a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">{{ __('Modifier') }}</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('Supprimer') }}</button>
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('tasks.assign.page', $task->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">{{ __('Assigner') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
