@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-6">Enregistrer la présence</h2>
            <form method="POST" action="{{ route('presences.store') }}">
                @csrf

                <!-- Add fields for heure_arrivee and heure_depart -->
                <div class="mb-4">
                    <label for="heure_arrivee" class="block text-sm font-medium text-gray-700">Heure d'arrivée</label>
                    <input type="datetime-local" id="heure_arrivee" name="heure_arrivee" class="form-input mt-1 block w-full rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label for="heure_depart" class="block text-sm font-medium text-gray-700">Heure de départ</label>
                    <input type="datetime-local" id="heure_depart" name="heure_depart" class="form-input mt-1 block w-full rounded-lg">
                </div>

                <!-- Existing fields -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                    <select name="status" id="status" class="form-select mt-1 block w-full rounded-lg" required>
                        <option value="Present">Présent</option>
                        <option value="Absent">Absent</option>
                    </select>
                </div>

                <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg">Soumettre</button>
            </form>
        </div>
    </div>
</div>
@endsection
