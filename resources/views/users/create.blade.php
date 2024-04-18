@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-6">Ajouter un nouvel utilisateur</h2>
            <form action="{{ route('users.store') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                    <input type="email" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('password') border-red-500 @enderror" id="password" name="password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input type="password" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="mb-4">
                    <label for="roles" class="block text-sm font-medium text-gray-700">Rôles</label>
                    <select class="form-multiselect mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('roles') border-red-500 @enderror" multiple id="roles" name="roles[]">
                        @foreach ($roles as $role)
                            @if ($role != 'Super Admin' || Auth::user()->hasRole('Super Admin'))
                                <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('roles')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2 focus:outline-none focus:bg-blue-600">Ajouter l'utilisateur</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
