@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="row justify-center">
        <div class="col-md-8">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-gray-200 px-4 py-2 rounded-t-lg flex justify-between items-center">
                    <h5 class="text-lg font-semibold">Ajouter un nouveau post</h5>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm">&larr; Retour</a>
                </div>
                <div class="p-6">
                    <form action="{{ route('posts.store') }}" method="post">
                        @csrf

                        <div class="mb-4">
                            <label for="sujet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sujet :</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="sujet" name="sujet" value="{{ old('sujet') }}">
                            @error('sujet')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contenu :</label>
                            <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="content" name="content">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <input type="submit" class="btn btn-primary" value="Ajouter le post">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
