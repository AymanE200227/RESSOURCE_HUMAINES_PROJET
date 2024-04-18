@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-3/4 lg:w-1/2">

            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="text-lg font-semibold mb-4">{{ __('Ajouter un nouveau rôle') }}</div>

                <form action="{{ route('roles.store') }}" method="post">
                    @csrf

                    <div class="mb-3 flex flex-col">
                        <label for="name" class="text-sm mb-1">{{ __('Nom') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 flex flex-col">
                        <label for="permissions" class="text-sm mb-1">{{ __('Permissions') }}</label>
                        <select class="form-select @error('permissions') is-invalid @enderror" multiple aria-label="Permissions" id="permissions" name="permissions[]" style="height: 210px;">
                            @forelse ($permissions as $permission)
                                <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions') ?? []) ? 'selected' : '' }}>
                                    {{ $permission->name }}
                                </option>
                            @empty
                                <option disabled>{{ __('Aucune permission trouvée !') }}</option>
                            @endforelse
                        </select>
                        @error('permissions')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">{{ __('Ajouter un rôle') }}</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
    
@endsection
