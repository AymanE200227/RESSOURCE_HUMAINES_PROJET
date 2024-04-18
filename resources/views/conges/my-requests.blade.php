@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-gray-200 px-4 py-2 rounded-t-lg">
                    {{ __('Mes demandes de congé') }}
                </div>

                <div class="p-6">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Date de début') }}</th>
                                <th>{{ __('Date de fin') }}</th>
                                <th>{{ __('Statut') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($conges as $conge)
                                <tr>
                                    <td>{{ $conge->type_conge }}</td>
                                    <td>{{ $conge->date_debut }}</td>
                                    <td>{{ $conge->date_fin }}</td>
                                    <td class="{{ $conge->statut === 'approved' ? 'text-green bg-green-500 rounded w-20' : ($conge->statut === 'rejected' ? 'text-red bg-red-500 rounded w-20' : '') }}">{{ $conge->statut }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">{{ __('Aucune demande de congé trouvée.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
