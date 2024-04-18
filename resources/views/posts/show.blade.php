@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="row justify-center">
        <div class="col-md-8">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-gray-200 px-4 py-2 rounded-t-lg flex justify-between items-center">
                    <h5 class="text-lg font-semibold">Informations sur le post</h5>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm">&larr; Retour</a>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <label for="sujet" class="block font-semibold">Sujet :</label>
                        <div class="mt-1">
                            {{ $post->sujet }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block font-semibold">Contenu :</label>
                        <div class="mt-1">
                            {{ $post->content }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
