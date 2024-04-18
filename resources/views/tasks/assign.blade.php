@extends('layouts.app')

@section('title', 'Assigner des tâches')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('tasks.assign', $task->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="text-sm">{{ __('Assigner à') }}</label>
                        <select name="user_id" id="user_id" class="form-select mt-1 block w-full" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Add a hidden input field to send the task ID -->
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <button type="submit" class="btn btn-primary">{{ __('Assigner la tâche') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
