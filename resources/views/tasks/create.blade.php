@extends('layouts.app')

@section('title', 'Créer une tâche')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-semibold">Créer une tâche</h2>
    <form action="{{ route('tasks.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
            <input type="text" id="name" name="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-5">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea id="description" name="description" rows="3" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"></textarea>
        </div>
        <div class="mb-5 flex justify-between">
            <div class="w-5/12">
                <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heure de début</label>
                <input type="datetime-local" id="start_time" name="start_time" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            </div>
            <div class="w-5/12">
                <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heure de fin</label>
                <input type="datetime-local" id="end_time" name="end_time" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
            </div>
        </div>
        <div class="mb-5">
            <label for="project_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Projet</label>
            <select name="project_id" id="project_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Créer une tâche</button>
    </form>
</div>
@endsection
