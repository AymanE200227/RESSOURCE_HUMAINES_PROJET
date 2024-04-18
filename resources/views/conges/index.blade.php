@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-gray-200 px-4 py-2 rounded-t-lg">
                    {{ __('Leave Requests') }}
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
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Type</th>
                                <th class="px-4 py-2">Start Date</th>
                                <th class="px-4 py-2">End Date</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conges as $conge)
                                <tr class="{{ $conge->statut === 'approved' ? 'bg-green-200' : ($conge->statut === 'rejected' ? 'bg-red-200' : '') }}">
                                    <td class="px-4 py-2">{{ $conge->employee->name }}</td>
                                    <td class="px-4 py-2">{{ $conge->type_conge }}</td>
                                    <td class="px-4 py-2">{{ $conge->date_debut }}</td>
                                    <td class="px-4 py-2">{{ $conge->date_fin }}</td>
                                    <td class="px-4 py-2">{{ $conge->statut }}</td>
                                    <td class="px-4 py-2">
                                        @can('manage-leave')
                                            <form method="POST" action="{{ route('conges.update', $conge->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="statut" value="approved">
                                                <button type="submit" class="btn btn-success rounded w-20">Approve</button>
                                            </form>
                                            <form method="POST" action="{{ route('conges.update', $conge->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="statut" value="rejected">
                                                <button type="submit" class="btn btn-danger rounded w-20 mt-2">Reject</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
