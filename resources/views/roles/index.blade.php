@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="text-lg font-semibold mb-4">{{ __('Gérer les rôles') }}</div>

    @can('create-role')
        <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm my-2">
            <i class="bi bi-plus-circle"></i> {{ __('Ajouter un nouveau rôle') }}
        </a>
    @endcan

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">{{ __('N°') }}</th>
                <th class="px-4 py-2">{{ __('Nom') }}</th>
                <th class="px-4 py-2" style="width: 250px;">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $role->name }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex justify-start">
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning btn-sm mr-2">
                                <i class="bi bi-eye"></i> {{ __('Afficher') }}
                            </a>

                            @if ($role->name != 'Super Admin')
                                @can('edit-role')
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm mr-2">
                                        <i class="bi bi-pencil-square"></i> {{ __('Modifier') }}
                                    </a>   
                                @endcan

                                @can('delete-role')
                                    @if ($role->name != Auth::user()->hasRole($role->name))
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="post" onsubmit="return confirm('{{ __('Voulez-vous supprimer ce rôle ?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> {{ __('Supprimer') }}
                                            </button>
                                        </form>
                                    @endif
                                @endcan
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border px-4 py-2">
                        <span class="text-danger">
                            <strong>{{ __('Aucun rôle trouvé !') }}</strong>
                        </span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $roles->links() }}

</div>
@endsection
