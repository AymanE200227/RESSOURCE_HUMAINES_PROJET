@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-6">Records de présence</h2>
            <a href="{{ route('presences.create') }}" class="mb-4 block text-blue-600 hover:underline">Enregistrer une nouvelle présence</a>

            @if (count($presences) > 0)
                <ul class="list-none">
                    @foreach ($presences as $presence)
                        <li class="mb-3 py-2 px-4 border border-gray-200 rounded-lg">
                            <span class="font-semibold">{{ $presence->employee->name }}</span> - <span>{{ $presence->status }}</span> - <span>{{ $presence->heure_arrivee }}</span> - <span>{{ $presence->heure_depart }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4">
                    {{ $presences->links() }}
                </div>
            @else
                <p class="text-gray-600">Aucun enregistrement de présence trouvé.</p>
            @endif
        </div>
    </div>
</div>
@endsection
