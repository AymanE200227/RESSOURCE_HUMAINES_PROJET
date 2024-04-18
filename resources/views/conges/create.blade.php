@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-6">{{ __('Demande de congé') }}</h2>
            <form method="POST" action="{{ route('conges.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="type_conge" class="block text-sm font-medium text-gray-700">{{ __('Type de congé') }}</label>
                    <select id="type_conge" class="form-select mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 @error('type_conge') border-red-500 @enderror" name="type_conge" required>
                        <option value="Vacation">Vacances</option>
                        <option value="Sick Leave">Congé maladie</option>
                        <!-- Ajoutez plus de types de congés si nécessaire -->
                    </select>
                    @error('type_conge')
                        <span class="text-sm text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="date_debut" class="block text-sm font-medium text-gray-700">{{ __('Date de début') }}</label>
                    <input id="date_debut" type="date" class="form-input mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 @error('date_debut') border-red-500 @enderror" name="date_debut" required>
                    @error('date_debut')
                        <span class="text-sm text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="date_fin" class="block text-sm font-medium text-gray-700">{{ __('Date de fin') }}</label>
                    <input id="date_fin" type="date" class="form-input mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 @error('date_fin') border-red-500 @enderror" name="date_fin" required>
                    @error('date_fin')
                        <span class="text-sm text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Soumettre la demande') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
