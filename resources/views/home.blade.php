@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-gray-200
                 px-4 py-2 rounded-t-lg">
                    {{ __('Tableau de bord') }}
                </div>

                <div class="p-6">
                    @if (session('status'))
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{ __('Vous êtes connecté en tant que') }} <span class="font-bold text-blue-500">{{ Auth::user()->name }}</span>!</p>


                    <p class="mt-4">{{ __('Ceci est votre tableau de bord d\'application.') }}</p>

                    @canany(['create-role', 'edit-role', 'delete-role', 'manage-leave', 'request-leave', 'create-user', 'edit-user', 'delete-user', 'create-post', 'edit-post', 'delete-post', 'manage-evaluations', 'manage-presence', 'manage-projects', 'manage-tasks', 'do-tasks'])
                        <div class="mt-4">
                            @can('create-role', 'edit-role', 'delete-role')
                                <a href="{{ route('roles.index') }}" class="btn btn-primary mt-2">
                                    <i class="bi bi-person-fill-gear"></i> {{ __('Gérer les rôles') }}
                                </a>
                            @endcan
                            @can('manage-leave')
                                <a href="{{ route('conges.index') }}" class="btn btn-primary mt-2">
                                    <i class="bi bi-calendar-check"></i> {{ __('Gérer les congés') }}
                                </a>
                            @endcan
                            @can('request-leave')
                                <a href="{{ route('conges.my-requests') }}" class="btn btn-primary mt-2">
                                    <i class="bi bi-calendar-plus"></i> {{ __('Mes demandes de congé') }}
                                </a>
                            @endcan
                            @can('request-leave')
                                <a href="{{ route('conges.create') }}" class="btn btn-success mt-2">
                                    <i class="bi bi-calendar-event"></i> {{ __('Demander un congé') }}
                                </a>
                            @endcan
                            @can('create-user', 'edit-user', 'delete-user')
                                <a href="{{ route('users.index') }}" class="btn btn-success mt-2">
                                    <i class="bi bi-person-plus"></i> {{ __('Gérer les utilisateurs') }}
                                </a>
                            @endcan
                            @can('create-post', 'edit-post', 'delete-post')
                                <a href="{{ route('posts.index') }}" class="btn btn-warning mt-2">
                                    <i class="bi bi-file-earmark-text"></i> {{ __('Gérer les publications') }}
                                </a>
                            @endcan
                            @can('manage-evaluations')
                                <a href="{{ route('evaluations.index') }}" class="btn btn-info mt-2">
                                    <i class="bi bi-star"></i> {{ __('Gérer les évaluations') }}
                                </a>
                            @endcan
                            @can('manage-presence')
                                <a href="{{ route('presences.index') }}" class="btn btn-danger mt-2">
                                    <i class="bi bi-clock"></i> {{ __('Gérer la présence') }}
                                </a>
                            @endcan
                            @can('manage-presence')
                                <a href="{{ route('presences.create') }}" class="btn btn-danger mt-2">
                                    <i class="bi bi-clock"></i> {{ __('Soumettre la présence') }}
                                </a>
                            @endcan
                            @can('manage-projects')
                                <a href="{{ route('projects.index') }}" class="btn btn-success mt-2">
                                    <i class="bi bi-archive"></i> {{ __('Gérer les projets') }}
                                </a>
                            @endcan
                            @can('manage-tasks')
                                <a href="{{ route('tasks.index') }}" class="btn btn-success mt-2">
                                    <i class="bi bi-check-square"></i> {{ __('Gérer les tâches') }}
                                </a>
                            @endcan
                            @can('do-tasks')
                                <a href="{{ route('tasks.assigned') }}" class="btn btn-success mt-2">
                                    <i class="bi bi-calendar-check"></i> {{ __('Accéder à mes tâches') }}
                                </a>
                            @endcan
                        </div>
                    @endcanany

                    <p class="mt-4">&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
