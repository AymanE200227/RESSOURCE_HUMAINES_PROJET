@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="text-lg font-semibold mb-4">Liste des publications</div>
        @can('create-post')
            <a href="{{ route('posts.create') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md mb-4"><i class="bi bi-plus-circle"></i> Ajouter une nouvelle publication</a>
        @endcan

        @forelse ($posts as $post)
            <div class="border-b border-gray-200 mb-4">
                <!-- Sujet -->
                <div class="font-semibold">{{ $post->sujet }}</div>
                <!-- Contenu -->
                <div class="text-gray-700 mb-2">{{ $post->content }}</div>
                <!-- Actions -->
                <div class="mt-2">
                    <a href="{{ route('posts.show', $post->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md"><i class="bi bi-eye"></i> Afficher</a>
                    @can('edit-post')
                        <a href="{{ route('posts.edit', $post->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md"><i class="bi bi-pencil-square"></i> Modifier</a>
                    @endcan
                    @can('delete-post')
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post" onsubmit="return confirm('Voulez-vous supprimer cette publication ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md"><i class="bi bi-trash"></i> Supprimer</button>
                        </form>
                    @endcan
                </div>
            </div>
        @empty
            <p class="text-red-500"><strong>Aucune publication trouvée !</strong></p>
        @endforelse
        
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
