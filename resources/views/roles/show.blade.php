@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-3/4 lg:w-1/2">

            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="text-lg font-semibold mb-4">{{ __('Informations sur le rôle') }}</div>

                <div class="mb-3 flex flex-col">
                    <label for="name" class="text-sm mb-1"><strong>{{ __('Nom :') }}</strong></label>
                    <div class="text-md">{{ $role->name }}</div>
                </div>

                <div class="mb-3 flex flex-col">
                    <label for="roles" class="text-sm mb-1"><strong>{{ __('Permissions :') }}</strong></label>
                    <div class="text-md">
                        @if ($role->name=='Super Admin')
                            <span class="badge bg-primary">{{ __('Toutes') }}</span>
                        @else
                            @forelse ($rolePermissions as $permission)
                                <span class="badge bg-primary">{{ $permission->name }}</span>
                            @empty
                                <span class="text-red-500">{{ __('Aucune permission trouvée !') }}</span>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>    
@endsection
