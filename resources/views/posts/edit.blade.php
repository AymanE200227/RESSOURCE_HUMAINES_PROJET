@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="row justify-center">
        <div class="col-md-8">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-gray-200 px-4 py-2 rounded-t-lg flex justify-between items-center">
                    <h5 class="text-lg font-semibold">Modifier le post</h5>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm">&larr; Retour</a>
                </div>
                <div class="p-6">
                    <form action="{{ route('posts.update', $post->id) }}" method="post">
                        @csrf
                        @method("PUT")

                        <div class="mb-4">
                            <label for="sujet" class="block font-semibold">Sujet :</label>
                            <input type="text" class="form-input mt-1 block w-full @error('sujet') border-red-500 @enderror" id="sujet" name="sujet" value="{{ $post->sujet }}">
                            @error('sujet')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block font-semibold">Contenu :</label>
                            <textarea class="form-textarea mt-1 block w-full @error('content') border-red-500 @enderror" id="content" name="content">{{ $post->content }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <input type="submit" class="btn btn-primary" value="Mettre à jour">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
