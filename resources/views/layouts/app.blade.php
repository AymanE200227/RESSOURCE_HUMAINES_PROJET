<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Gestion des ressources humaines') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('resources/css/app.css')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="bg-white shadow-sm">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-4">
                    <a class="text-xl font-bold" href="{{ url('/') }}">
                        RES_HUM
                    </a>
                    <button class="text-gray-600 focus:outline-none md:hidden">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="hidden md:flex md:items-center">
                        <!-- Right Side Of Navbar -->
                        <ul class="flex space-x-4">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li>
                                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li>
                                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('register') }}">{{ __('S\'inscrire') }}</a>
                                    </li>
                                @endif
                            @else
                                <li>
                                    <a class="text-gray-600 hover:text-gray-900" href="{{ route('home') }}">{{ __('Accueil') }}</a>
                                </li>
                                @canany(['create-role', 'edit-role', 'delete-role'])
                                    <li>
                                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('roles.index') }}">{{ __('Gérer les rôles') }}</a>
                                    </li>
                                @endcanany
                                @canany(['create-user', 'edit-user', 'delete-user'])
                                    <li>
                                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('users.index') }}">{{ __('Gérer les utilisateurs') }}</a>
                                    </li>
                                @endcanany
                                @canany(['create-post', 'edit-post', 'delete-post'])
                                    <li>
                                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('posts.index') }}">{{ __('Gérer les publications') }}</a>
                                    </li>
                                @endcanany
                                @canany(['create-projects', 'edit-projects', 'delete-projects'])
                                    <li>
                                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('projects.index') }}">{{ __('Gérer les projets') }}</a>
                                    </li>
                                @endcanany
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="flex items-center">
                                        @csrf
                                        <button type="submit" class="text-gray-600 hover:text-gray-900 focus:outline-none">{{ __('Déconnexion') }}</button>
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container mx-auto">
                <div class="text-center">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                    <h3 class="text-3xl font-semibold mt-3 mb-6">{{ __('Gestion des ressources humaines') }}</h3>
                </div>
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
